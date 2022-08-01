<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Domain;

class DomainFactory extends Factory

{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Domain::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            [
                'name' => 'TIPOS DE USUARIOS',
                'id_father' => null,
                'created_at' => date('Y-m-d H:i'),
                'updated_at' => date('Y-m-d H:i')
            ],
            [
                'name' => 'Administrador',
                'id_father' => 1,
                'created_at' => date('Y-m-d H:i'),
                'updated_at' => date('Y-m-d H:i')
            ],
            [
                'name' => 'Empleado',
                'id_father' => 1,
                'created_at' => date('Y-m-d H:i'),
                'updated_at' => date('Y-m-d H:i')
            ],
            [
                'name' => 'TIPOS DE CARGOS',
                'id_father' => null,
                'created_at' => date('Y-m-d H:i'),
                'updated_at' => date('Y-m-d H:i')
            ],
            [
                'name' => 'Desarrollador',
                'id_father' => 4,
                'created_at' => date('Y-m-d H:i'),
                'updated_at' => date('Y-m-d H:i')
            ],
            [
                'name' => 'Analista',
                'id_father' => 4,
                'created_at' => date('Y-m-d H:i'),
                'updated_at' => date('Y-m-d H:i')
            ],
            [
                'name' => 'Arquitecto de BD',
                'id_father' => 4,
                'created_at' => date('Y-m-d H:i'),
                'updated_at' => date('Y-m-d H:i')
            ],
            [
                'name' => 'Gestión de QA',
                'id_father' => 4,
                'created_at' => date('Y-m-d H:i'),
                'updated_at' => date('Y-m-d H:i')
            ]
        ];
    }
}
