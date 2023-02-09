<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use App\Models\Seller;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('password123'),
            'remember_token' => Str::random(10),
            'verified' => $verified = $this->faker->randomElement([User::VERIFIED_USER, User::UNVERIFIED_USER]),
            'verification_token' => $verified = User::VERIFIED_USER ? null : User::generateVerificationCode(),
            'admin' => $verified = $this->faker->randomElement([User::ADMIN_USER, User::REGULAR_USER]),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}

class CategoryFactory extends Factory
{
     /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return[
            'name' => $this->faker->word(),
            'description' => $this->faker->paragraph(1),
        ];
    }
}

class ProductFactory extends Factory
{
     /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return[
            'name' => $this->faker->word(),
            'description' => $this->faker->paragraph(1),
            'quantity' => $this->faker->numberBetween(1, 10),
            'status' => $this->faker->randomElement([Product::AVAILABLE_PRODUCT, Product::UNAVAILABLE_PRODUCT]),
            'image' => $this->faker->randomElement(['1.jpg','2.jpg','3.jpg']),
            'seller_id' => User::all()->pluck('id')->random(),
        ];
    }
}

class TransactionFactory extends Factory
{
     /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $seller = Seller::has('products')->get()->random();
        $buyer = User::all()->except($seller->id)->random();
        return[
            'quantity' => $this->faker->numberBetween(1, 3),
            'buyer_id' => $buyer->id,
            'product_id' => $seller->products->pluck('id')->random(),
        ];
    }
}
