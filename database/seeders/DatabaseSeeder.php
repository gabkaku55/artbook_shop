<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'yanapampukha2006@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('qwerty1234'),
            'role' => 'admin',
            'phone' => '+38 (044) 123-45-67',
        ]);

        $categories = [
            ['name' => 'Аніме', 'slug' => 'anime'],
            ['name' => 'Відеоігри', 'slug' => 'video-games'],
            ['name' => 'Хорор', 'slug' => 'horror'],
            ['name' => 'Комікси', 'slug' => 'comics'],
            ['name' => 'Інші', 'slug' => 'others'],
        ];

        foreach ($categories as $cat) {
            \App\Models\Category::create($cat);
        }

        $products = [
            [
                'category_id' => 1,
                'name' => 'Мистецтво Віднесених привидами',
                'slug' => 'art-of-spirited-away',
                'author' => 'Хаяо Міядзакі',
                'description' => 'Прекрасна колекція концепт-артів з шедевра студії Ghibli.',
                'price' => 45.00,
                'stock' => 10,
                'is_new' => true,
                'is_popular' => true,
            ],
            [
                'category_id' => 2,
                'name' => 'Мистецтво Elden Ring',
                'slug' => 'art-of-elden-ring',
                'author' => 'FromSoftware',
                'description' => 'Офіційний артбук гри року.',
                'price' => 55.00,
                'stock' => 5,
                'is_new' => true,
                'is_popular' => true,
            ],
            [
                'category_id' => 3,
                'name' => 'Артбук Джюндзі Іто',
                'slug' => 'junji-ito-artbook',
                'author' => 'Джюндзі Іто',
                'description' => 'Моторошні ілюстрації від майстра хорору.',
                'price' => 40.00,
                'stock' => 0,
                'is_new' => false,
                'is_popular' => true,
            ],
        ];

        foreach ($products as $prod) {
            \App\Models\Product::create($prod);
        }
    }
}
