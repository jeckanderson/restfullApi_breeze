<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'name' => 'Jeck',
            'email' => 'jeckclaver@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        Product::create([
            'id_category' => 1,
            'nama_product' => 'Baju 01',
            'harga_product' => 120000,
            'berat_product' => 5,
            'stok' => 5,
            'foto' => 'pakaian.jpg',
        ]);

        Category::create([
            'nama_category' => 'Pakaian',
        ]);
    }
}
