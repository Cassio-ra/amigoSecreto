<?php

namespace Database\Seeders;

use App\Models\SorteioStatus;
use Illuminate\Database\Seeder;

class SorteioStatusSeeder extends Seeder
{
    public function run()
    {
        SorteioStatus::firstOrCreate([
            'codigo' => SorteioStatus::AGUARDANDO_SORTEIO,
        ],
        [
            'desc' => 'Aguardando Sorteio'
        ]);

        SorteioStatus::firstOrCreate([
            'codigo' => SorteioStatus::SORTEADO,
        ],
        [
            'desc' => 'Sorteio Realizado'
        ]);
    }
}
