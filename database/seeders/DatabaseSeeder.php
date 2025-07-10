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
            'name' => 'Renter User',
            'email' => 'renter@example.com',
            'password' => bcrypt('password123'),
            'role' => 'renter',
        ]);

        // Create Regular User
        User::create([
            'name' => 'محمد أحمد',
            'email' => 'user@example.com',
            'password' => bcrypt('password123'),
            'role' => 'user',
        ]);

        // Create Sample Properties
        \App\Models\Property::create([
            'title' => 'شقة فاخرة في الرياض',
            'price' => 120000,
            'location' => 'الرياض - حي الملك فهد',
            'type' => 'شقة',
            'listing_type' => 'إيجار',
            'rooms' => 3,
            'bathrooms' => 2,
            'size' => 150,
            'description' => 'شقة فاخرة بموقع مميز في قلب الرياض، تحتوي على 3 غرف نوم و 2 حمام، مطبخ مجهز بالكامل، صالة واسعة، وموقف سيارة. القريبة من جميع الخدمات والمرافق.',
            'contact_phone' => '0501234567',
            'images' => [],
            'status' => 'متاح',
        ]);

        \App\Models\Property::create([
            'title' => 'فيلا للبيع في جدة',
            'price' => 850000,
            'location' => 'جدة - حي الروضة',
            'type' => 'فيلا',
            'listing_type' => 'بيع',
            'rooms' => 5,
            'bathrooms' => 4,
            'size' => 400,
            'description' => 'فيلا راقية في حي الروضة بجدة، تتكون من 5 غرف نوم رئيسية، 4 حمامات، مجلس، صالة كبيرة، مطبخ واسع، وحديقة خاصة مع مسبح. تشطيب عالي الجودة.',
            'contact_phone' => '0509876543',
            'images' => [],
            'status' => 'متاح',
        ]);

        \App\Models\Property::create([
            'title' => 'منزل عائلي في الدمام',
            'price' => 95000,
            'location' => 'الدمام - حي الفردوس',
            'type' => 'منزل',
            'listing_type' => 'إيجار',
            'rooms' => 4,
            'bathrooms' => 3,
            'size' => 250,
            'description' => 'منزل عائلي مريح في حي الفردوس، يتكون من 4 غرف نوم، 3 حمامات، صالة، مطبخ، وحديقة صغيرة. مناسب للعائلات الكبيرة.',
            'contact_phone' => '0551122334',
            'images' => [],
            'status' => 'مؤجر',
        ]);
    }
}