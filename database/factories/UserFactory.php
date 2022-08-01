<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class UserFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => 'Oscar',
            'last_name' => 'Cortina',
            'identification' => '123456789',
            'address' => 'Oscar',
            'phone' => 'Oscar',
            'password' => MD5('12345'),
            'id_domain_user_type' => 2,
            'created_at' => date('Y-m-d H:i'),
            'updated_at' => date('Y-m-d H:i')
        ];
    }
}
