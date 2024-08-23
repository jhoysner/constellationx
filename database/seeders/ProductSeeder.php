<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use GuzzleHttp\Client;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $client = new Client();
        $response = $client->get('https://fakestoreapi.com/products');
        $products = json_decode($response->getBody()->getContents(), true);

        foreach ($products as $productData) {
            Product::create([
                'name' => $productData['title'],
                'description' => $productData['description'],
                'price' => $productData['price'],
                'image' => $productData['image']
            ]);
        }
    }
}
