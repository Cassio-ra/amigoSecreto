<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SorteioStatus extends Model
{
    use HasFactory;

    protected $table = 'sorteio_status';
    protected $primaryKey = 'codigo';

    const AGUARDANDO_SORTEIO = 01;
    const SORTEADO = 02;

    public $timestamps = false;

    protected $fillable = [
        'codigo',
        'desc',
    ];
}
