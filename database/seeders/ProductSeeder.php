<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['name' => 'Apel Merah', 'price' => 35000, 'stock' => 30, 'image' => 'https://images.unsplash.com/photo-1560806887-1e4cd0b6cbd6?w=800', 'description' => 'Apel merah segar, manis dan renyah.'],
            ['name' => 'Pisang Cavendish', 'price' => 22000, 'stock' => 40, 'image' => 'https://images.unsplash.com/photo-1571771894821-ce9b6c11b08e?w=800', 'description' => 'Pisang matang dengan tekstur lembut.'],
            ['name' => 'Jeruk Mandarin', 'price' => 28000, 'stock' => 25, 'image' => 'https://images.unsplash.com/photo-1547514701-42782101795e?w=800', 'description' => 'Jeruk segar dengan rasa manis dan sedikit asam.'],
            ['name' => 'Stroberi', 'price' => 45000, 'stock' => 20, 'image' => 'https://images.unsplash.com/photo-1464965911861-746a04b4bca6?w=800', 'description' => 'Stroberi pilihan yang segar.'],
            ['name' => 'Semangka', 'price' => 18000, 'stock' => 18, 'image' => 'https://images.unsplash.com/photo-1563114773-84221bd62daa?w=800', 'description' => 'Semangka merah yang menyegarkan.'],
            ['name' => 'Anggur Ungu', 'price' => 52000, 'stock' => 15, 'image' => 'https://images.unsplash.com/photo-1537640538966-79f369143f8f?w=800', 'description' => 'Anggur ungu manis dan berair.'],
        ];

        foreach ($products as $item) {
            Product::updateOrCreate(
                ['slug' => Str::slug($item['name'])],
                $item + ['slug' => Str::slug($item['name']), 'is_active' => true]
            );
        }
    }
}
