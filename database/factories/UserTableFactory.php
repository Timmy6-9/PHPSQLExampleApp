<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserTable>
 */
class UserTableFactory extends Factory
{
    public function definition()
    {
        return [
            'id' => null,
            'Username' => 'nameExample',
            'Password' => Hash::make('password'), // password
            'EmailAddress' => 'faketest@gmail.com',
            'Organization' => 'testCo',
            'updated_at' => now(),
            'created_at' => now()
        ];
    }
}
