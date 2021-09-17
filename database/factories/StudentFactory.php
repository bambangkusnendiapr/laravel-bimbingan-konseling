<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 3,
            'nama' => $this->faker->name(),
            'poin' => 300,
            'jk' => 'Laki-laki',
            'alamat' => 'Jl. Alamat',
            'keterangan' => '-',
        ];
    }
}
