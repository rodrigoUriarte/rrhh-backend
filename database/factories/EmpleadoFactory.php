<?php

namespace Database\Factories;

use App\Models\Empleado;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmpleadoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Empleado::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $gender = $this->faker->randomElement(['male', 'female']);
        $civilState = $this->faker->randomElement(['casado', 'soltero']);

        return [
            'legajo' => $this->faker->numberBetween(0,10000),
            'apellido' => $this->faker->lastName,
            'nombre' => $this->faker->name($gender),
            'dni' => $this->faker->numberBetween(0,99999999),
            'fecha_nacimiento' => $this->faker->date,
            'domicilio' => $this->faker->address,
            'email' => $this->faker->email,
            'telefono' => $this->faker->phoneNumber,
            'foto_perfil' => $this->faker->image,
            'sexo' => $gender,
            'fecha_ingreso' => $this->faker->date,
            'telefono_emergencia' => $this->faker->phoneNumber,
            'documentacion' => $this->faker->text,
            'estado_civil' => $civilState
        ];
    }
}
