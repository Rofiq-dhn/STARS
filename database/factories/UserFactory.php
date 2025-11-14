<?php

namespace Database\Factories;

use App\Models\User;                             // model User
use Illuminate\Database\Eloquent\Factories\Factory; // base Factory
use Illuminate\Support\Str;                      // helper string
use Illuminate\Support\Facades\Hash;             // helper hashing

class UserFactory extends Factory
{
    // hubungkan factory ini ke model User
    protected $model = User::class;

    // definisi atribut default untuk user
    public function definition()
    {
        return [
            'username'   => $this->faker->unique()->userName, // username unik
            'password'   => Hash::make('password'),           // password terenkripsi
            'level'      => $this->faker->randomElement(['siswa','admin']), // role
            'id_admin'   => null,                             // default null (opsional)
            'id_siswa'   => null,                             // default null (opsional)
            'remember_token' => Str::random(10),              // token remember
        ];
    }
}
