<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            ['Product_Name' => 'Headphone', 'Price' => 49.99, 'Description' => 'Wireless Headphones'],
            ['Product_Name' => 'TV', 'Price' => 399.99, 'Description' => 'Smart TV'],
            ['Product_Name' => 'Hp', 'Price' => 299.99, 'Description' => 'Smartphone'],
            ['Product_Name' => 'Router', 'Price' => 79.99, 'Description' => 'WiFi Router'],
            ['Product_Name' => 'Ps', 'Price' => 299.99, 'Description' => 'Gaming Console'],
            ['Product_Name' => 'Kamera', 'Price' => 199.99, 'Description' => 'Digital Camera'],
            ['Product_Name' => 'Drone', 'Price' => 499.99, 'Description' => 'Aerial Drone'],
            ['Product_Name' => 'Smartwatch', 'Price' => 129.99, 'Description' => 'Fitness Smartwatch'],
            ['Product_Name' => 'Speaker', 'Price' => 79.99, 'Description' => 'Bluetooth Speaker'],
            ['Product_Name' => 'Laptop', 'Price' => 899.99, 'Description' => 'Laptop Computer']
        ];

        DB::table('Product')->insert($products);
    }
}

