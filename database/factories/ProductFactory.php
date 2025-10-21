<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\groupProduct;
use App\Models\supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3,false),
            'slug' => $this->faker->unique()->slug,
            'summary' =>$this->faker->sentences(3,true),
            'discreption' =>$this->faker->paragraph(),
            'photo' =>$this->faker->imageUrl(100,100),
            //group_products_id
            'group_products_id' =>$this->faker->randomElement(groupProduct::pluck('id')->toArray()),
            'supplier_id' =>$this->faker->randomElement(supplier::pluck('id')->toArray()),
            'cat_id' =>$this->faker->randomElement(Category::where('is_parent',1)->pluck('id')->toArray()),
            'brand_id' =>$this->faker->randomElement(Brand::pluck('id')->toArray()),
            'child_cat_id' =>$this->faker->randomElement(Category::where('is_parent',0)->pluck('id')->toArray()),
            'status'=>$this->faker->randomElement(['active','inactive']),
            'conditaion'=>$this->faker->randomElement(['new','popular','winter']),
            'type'=>$this->faker->randomElement(['woman','kids','man']),
            'stok'=>$this->faker->randomNumber(2),
            'price'=>$this->faker->randomFloat(1,100,500),
            'offer_price'=>$this->faker->randomFloat(1,100,500),
            'discount'=>$this->faker->randomFloat(10,2,50),
            'Caturl'=>$this->faker->url(),
            'chk'=>$this->faker->boolean(),
        ];
    }
}
