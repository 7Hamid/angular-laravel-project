<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    protected $model=Product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id'=>$this->faker->text(),
            'image'=>$this->faker->imageUrl(),
            'name'=>$this->faker->text(),
            'category'=>$this->faker->text(),
            'description'=>$this->faker->text(),
            'brand'=>$this->faker->text(),
            'price'=>$this->faker->text(),
        ];
    }
}
