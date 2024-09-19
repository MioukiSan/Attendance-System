<?php

namespace Database\Factories;

use App\Models\Visitor;
use Illuminate\Database\Eloquent\Factories\Factory;

class VisitorFactory extends Factory
{
    protected $model = Visitor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $barangays = [
            'BALOGO', 'SAN RAMON', 'TOBOG', 'MAPORONG', 'SAN AGUSTIN',
            'BAGUMBAYAN', 'BAGSA', 'MATAMBO', 'MARAMBA', 'CAGMANABA',
            'BADIAN', 'NAGAS', 'TAPEL', 'SAN ANTONIO', 'BOGTONG',
            'CADAWAG', 'TOBGON', 'CAMAGONG', 'CALPI', 'PISTOLA',
            'GUMABAO', 'BANGIAWON', 'CALAGUIMIT', 'RAMAY', 'SAN VICENTE',
            'SAN PASCUAL', 'SAN MIGUEL', 'DEL ROSARIO', 'TABLON', 'TALISAY',
            'COLIAT', 'SAN JOSE', 'BADBAD', 'CASINAGAN', 'MAYAG',
            'BANAO', 'MOROPONROS', 'ILAOR SUR', 'MANGA', 'BUSAC',
            'BONGORAN', 'IRAYA NORTE', 'MAYAO', 'SABAN', 'ILAOR NORTE',
            'OBALIW-RINAS', 'SAN JUAN', 'SAN ISIDRO', 'TALONGOG', 'CALZADA',
            'RIZAL', 'IRAYA SUR', 'CENTRO', 'POBLACION'
        ];

        return [
            'name' => $this->faker->name(),
            'gender' => $this->faker->randomElement(['Male', 'Female']),
            'barangay' => $this->faker->randomElement($barangays),
            'purpose' => $this->faker->randomElement(['Medical', 'Education', 'Burial', 'Others']),
            'purok' => $this->faker->numberBetween(1, 12),
        ];
    }
}