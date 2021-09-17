<?php

namespace Database\Factories;

use App\Models\Pelanggaran;
use Illuminate\Database\Eloquent\Factories\Factory;

class PelanggaranFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pelanggaran::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama' => $this->faker->name(),
            'poin' => rand(10, 50),
            'keterangan' => $this->faker->name(),
        ];
    }
}
