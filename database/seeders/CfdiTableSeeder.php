<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cfdi;

class CfdiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nombre' => 'Adquisición de Mercancías',
                'estatus' => 1
            ],
            [
                'nombre' => 'Aportaciones Voluntarias al SAR',
                'estatus' => 1
            ],
            [
                'nombre' => 'Comunicaciones Satelitales',
                'estatus' => 1
            ],
            [
                'nombre' => 'Comunicaciones Telefónicas',
                'estatus' => 1
            ],
            [
                'nombre' => 'Construcciones',
                'estatus' => 1
            ],
            [
                'nombre' => 'Dados, troqueles, moldes, matrices y herramientas',
                'estatus' => 1
            ],
            [
                'nombre' => 'Depósitos en cuentas para el ahorro, primas que tengan como base planes de pensiones',
                'estatus' => 1
            ],
            [
                'nombre' => 'Devoluciones, descuentos o bonificaciones',
                'estatus' => 1
            ],
            [
                'nombre' => 'Donativos',
                'estatus' => 1
            ],
            [
                'nombre' => 'Equipo de cómputo y accesorios',
                'estatus' => 1
            ],
            [
                'nombre' => 'Equipo de transporte',
                'estatus' => 1
            ],
            [
                'nombre' => 'Gastos de transportación escolar obligatoria',
                'estatus' => 1
            ],
            [
                'nombre' => 'Gastos en general',
                'estatus' => 1
            ],
            [
                'nombre' => 'Gastos funerales',
                'estatus' => 1
            ],
            [
                'nombre' => 'Gastos médicos por incapacidad o discapacidad',
                'estatus' => 1
            ],
            [
                'nombre' => 'Honorarios médicos, dentales y gastos hospitalarios',
                'estatus' => 1
            ],
            [
                'nombre' => 'Intereses reales efectivamente pagados por créditos hipotecarios (casa habitación)',
                'estatus' => 1
            ],
            [
                'nombre' => 'Mobiliario y equipo de oficina por inversiones',
                'estatus' => 1
            ],
            [
                'nombre' => 'Nomina',
                'estatus' => 1
            ],
            [
                'nombre' => 'Otra maquinaria y equipo',
                'estatus' => 1
            ],
            [
                'nombre' => 'Pagos',
                'estatus' => 1
            ],
            [
                'nombre' => 'Pagos por servicios educativos (colegiaturas)',
                'estatus' => 1
            ],
            [
                'nombre' => 'Primas por seguros de gastos médicos',
                'estatus' => 1
            ],
            [
                'nombre' => 'Sin efectos fiscales',
                'estatus' => 1
            ]
        ];

        foreach($data as $item)
        {
            Cfdi::create([
                'nombre' => $item['nombre'],
                'estatus' => $item['estatus']
            ]);
        }
    }
}
