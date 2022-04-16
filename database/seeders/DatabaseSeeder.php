<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\User::factory(20)->create();
         \App\Models\Address::factory(20)->create();
         \App\Models\Category::factory(20)->create();
         \App\Models\Subcategory::factory(20)->create();
         \App\Models\Brand::factory(20)->create();
         \App\Models\Product::factory(20)->create();
         \App\Models\Variation::factory(10)->create();
         \App\Models\VariationOption::factory(20)->create();
         \App\Models\ProductVariation::factory(20)->create();
         \App\Models\ProductPriceQuantity::factory(20)->create();
         \App\Models\PaymentMethod::factory(20)->create();
         \App\Models\OrderStatus::factory(3)->create();
         \App\Models\Order::factory(20)->create();
         \App\Models\OrderItem::factory(20)->create();
         \App\Models\InvoiceStatus::factory(3)->create();
         \App\Models\Invoice::factory(20)->create();
         \App\Models\Payment::factory(10)->create();
         \App\Models\Shipment::factory(10)->create();
         //\App\Models\ShipmentItem::factory(8)->create();
        $this->call([
            UserSeeder::class,
        ]);
    }
}
