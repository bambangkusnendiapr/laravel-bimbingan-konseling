<?php

namespace Database\Factories;

use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Teacher::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 2,
            'nama' => $this->faker->name(),
            'jk' => 'Laki-laki',
            'alamat' => 'Jl. Alamat',
            'keterangan' => '-',
        ];
    }
}
