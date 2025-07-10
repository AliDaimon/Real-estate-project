<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::truncate();
        \App\Models\Property::truncate();

        // Create Admin User
        User::create([
            'name' => 'المدير',
            'email' => 'admin@example.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);

        // Create Renter User
        User::create([
            'name' => 'صاحب العقار',
            'email' => 'renter@example.com',
            'password' => bcrypt('password123'),
            'role' => 'renter',
        ]);

        // Create Regular User
        User::create([
            'name' => 'المستخدم',
            'email' => 'user@example.com',
            'password' => bcrypt('password123'),
            'role' => 'user',
        ]);

        // Create Sample Properties
        \App\Models\Property::create([
            'title' => 'شقة فاخرة في الخرطوم',
            'price' => 120000,
            'location' => 'الخرطوم - حي الرياض',
            'type' => 'شقة',
            'listing_type' => 'إيجار',
            'rooms' => 3,
            'bathrooms' => 2,
            'size' => 150,
            'description' => 'شقة فاخرة بموقع مميز في قلب الخرطوم، تحتوي على 3 غرف نوم و 2 حمام، مطبخ مجهز بالكامل، صالة واسعة، وموقف سيارة. القريبة من جميع الخدمات والمرافق.',
            'contact_phone' => '0912345678',
            'images' => [],
            'status' => 'متاح',
        ]);

        \App\Models\Property::create([
            'title' => 'فيلا للبيع في بحري',
            'price' => 850000,
            'location' => 'بحري - حي المزاد',
            'type' => 'فيلا',
            'listing_type' => 'بيع',
            'rooms' => 5,
            'bathrooms' => 4,
            'size' => 400,
            'description' => 'فيلا راقية في حي المزاد ببحري، تتكون من 5 غرف نوم رئيسية، 4 حمامات، مجلس، صالة كبيرة، مطبخ واسع، وحديقة خاصة مع مسبح. تشطيب عالي الجودة.',
            'contact_phone' => '0998765432',
            'images' => [],
            'status' => 'متاح',
        ]);

        \App\Models\Property::create([
            'title' => 'منزل عائلي في أم درمان',
            'price' => 95000,
            'location' => 'أم درمان - حي الثورة',
            'type' => 'منزل',
            'listing_type' => 'إيجار',
            'rooms' => 4,
            'bathrooms' => 3,
            'size' => 250,
            'description' => 'منزل عائلي مريح في حي الثورة بأم درمان، يتكون من 4 غرف نوم، 3 حمامات، صالة، مطبخ، وحديقة صغيرة. مناسب للعائلات الكبيرة.',
            'contact_phone' => '0961122334',
            'images' => [],
            'status' => 'مؤجر',
        ]);
    }
}