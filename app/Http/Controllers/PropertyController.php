<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use Illuminate\Support\Facades\Auth;

class PropertyController extends Controller
{
    public function index()
    {
        // Admin sees all, renter sees only their own
        if (Auth::check() && Auth::user()->role === 'renter') {
            $properties = Property::where('user_id', Auth::id())->latest()->paginate(12);
        } else {
            $properties = Property::latest()->paginate(12);
        }
        return view('properties.index', compact('properties'));
    }

    public function create()
    {
        if (!Auth::check() || !in_array(Auth::user()->role, ['admin', 'renter'])) {
            abort(403);
        }
        return view('properties.create');
    }

    public function store(Request $request)
    {
        if (!Auth::check() || !in_array(Auth::user()->role, ['admin', 'renter'])) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'location' => 'required|string|max:255',
            'type' => 'required|in:شقة,منزل,فيلا,محل',
            'listing_type' => 'required|in:إيجار,بيع',
            'rooms' => 'required|integer|min:1',
            'bathrooms' => 'required|integer|min:1',
            'size' => 'required|integer|min:1',
            'description' => 'required|string',
            'contact_phone' => 'required|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/properties'), $imageName);
                $images[] = 'images/properties/' . $imageName;
            }
        }

        Property::create([
            'title' => $request->title,
            'price' => $request->price,
            'location' => $request->location,
            'type' => $request->type,
            'listing_type' => $request->listing_type,
            'rooms' => $request->rooms,
            'bathrooms' => $request->bathrooms,
            'size' => $request->size,
            'description' => $request->description,
            'contact_phone' => $request->contact_phone,
            'images' => $images,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('properties.index')->with('success', 'تم إضافة العقار بنجاح');
    }

    public function show($id)
    {
        $property = Property::findOrFail($id);
        return view('properties.show', compact('property'));
    }

    public function edit($id)
    {
        $property = Property::findOrFail($id);

        if (!Auth::check() || (
            Auth::user()->role === 'renter' && $property->user_id !== Auth::id()
        ) || !in_array(Auth::user()->role, ['admin', 'renter'])) {
            abort(403);
        }
        return view('properties.edit', compact('property'));
    }

    public function update(Request $request, $id)
    {
        $property = Property::findOrFail($id);

        if (!Auth::check() || (
            Auth::user()->role === 'renter' && $property->user_id !== Auth::id()
        ) || !in_array(Auth::user()->role, ['admin', 'renter'])) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'location' => 'required|string|max:255',
            'type' => 'required|in:شقة,منزل,فيلا,محل',
            'listing_type' => 'required|in:إيجار,بيع',
            'rooms' => 'required|integer|min:1',
            'bathrooms' => 'required|integer|min:1',
            'size' => 'required|integer|min:1',
            'description' => 'required|string',
            'contact_phone' => 'required|string',
            'status' => 'required|in:متاح,مؤجر,مباع',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Handle image updates
        $currentImages = $property->images ?? [];
        
        // Remove selected images
        if ($request->has('remove_images')) {
            $removeIndices = $request->remove_images;
            foreach ($removeIndices as $index) {
                if (isset($currentImages[$index])) {
                    // Delete physical file
                    $imagePath = public_path($currentImages[$index]);
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                    // Remove from array
                    unset($currentImages[$index]);
                }
            }
            // Re-index the array
            $currentImages = array_values($currentImages);
        }

        // Add new images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/properties'), $imageName);
                $currentImages[] = 'images/properties/' . $imageName;
            }
        }

        // Update property data including images
        $property->update([
            'title' => $request->title,
            'price' => $request->price,
            'location' => $request->location,
            'type' => $request->type,
            'listing_type' => $request->listing_type,
            'rooms' => $request->rooms,
            'bathrooms' => $request->bathrooms,
            'size' => $request->size,
            'description' => $request->description,
            'contact_phone' => $request->contact_phone,
            'status' => $request->status,
            'images' => $currentImages
        ]);

        return redirect()->route('properties.show', $property->id)->with('success', 'تم تحديث العقار بنجاح');
    }

    public function destroy($id)
    {
        $property = Property::findOrFail($id);

        if (!Auth::check() || (
            Auth::user()->role === 'renter' && $property->user_id !== Auth::id()
        ) || !in_array(Auth::user()->role, ['admin', 'renter'])) {
            abort(403);
        }
        
        $property->delete();
        
        return redirect()->route('properties.index')->with('success', 'تم حذف العقار بنجاح');
    }

    public function confirm($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $property = Property::findOrFail($id);
        
        if ($property->listing_type === 'إيجار') {
            $property->status = 'مؤجر';
        } else {
            $property->status = 'مباع';
        }
        
        $property->save();
        return redirect()->back()->with('success', 'تم تأكيد المعاملة بنجاح');
    }
}