<?php

namespace Database\Factories;

use App\Models\Products;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Products::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        'category_id' => $this->faker->numberBetween(1, Category::count()),
        'product_name' => $this->faker->unique()->words(2, true),
        'product_stock' => $this->faker->randomNumber(2),
        'product_price' => $this->faker->numberBetween(100, 1000),
        'created_by' => $this->faker->numberBetween(1, 3)
        ];
    }
}
