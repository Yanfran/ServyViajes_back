<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TaxRegimes;

class TaxRegimesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nombre' => 'Actividades Agrícolas, Ganadera, Silvícolas y Pesqueras',
                'estatus' => 1
            ],
            [
                'nombre' => 'Arrendamiento',
                'estatus' => 1
            ],
            [
                'nombre' => 'Coordinados',
                'estatus' => 1
            ],
            [
                'nombre' => 'Demás Ingresos',
                'estatus' => 1
            ],
            [
                'nombre' => 'General de Ley Personas Morales',
                'estatus' => 1
            ],
            [
                'nombre' => 'Incorporación Fiscal',
                'estatus' => 1
            ],
            [
                'nombre' => 'Ingreso por Dividendo (socios y accionistas)',
                'estatus' => 1
            ],
            [
                'nombre' => 'Ingreso por Intereses',
                'estatus' => 1
            ],
            [
                'nombre' => 'Opcional para Grupos de Sociedades',
                'estatus' => 1
            ],
            [
                'nombre' => 'Personas Físicas con Actividades Empresariales y Profesionales',
                'estatus' => 1
            ],
            [
                'nombre' => 'Personas Morales con Fines no Lucrativos',
                'estatus' => 1
            ],
            [
                'nombre' => 'Régimen de Enajenación o Adquisición de Bienes',
                'estatus' => 1
            ],
            [
                'nombre' => 'Régimen de las Actividades Empresariales con ingresos a través de las Plataformas Tecnológicas',
                'estatus' => 1
            ],
            [
                'nombre' => 'Régimen de los ingresos por obtención de premios',
                'estatus' => 1
            ],
            [
                'nombre' => 'Régimen Simplificado de Confianza',
                'estatus' => 1
            ],
            [
                'nombre' => 'Residentes en el Extranjero sin Establecimiento Permanente en México',
                'estatus' => 1
            ],
            [
                'nombre' => 'Sin obligaciones fiscales',
                'estatus' => 1
            ],
            [
                'nombre' => 'Sociedades Cooperativas de Producción que Optan por diferir sus ingresos',
                'estatus' => 1
            ],
            [
                'nombre' => 'Sueldos y Salarios e Ingresos Asimilados a Salarios',
                'estatus' => 1
            ],
        ];

        foreach($data as $item)
        {
            TaxRegimes::create([
                'nombre' => $item['nombre'],
                'estatus' => $item['estatus']
            ]);
        }
        
    }
}
