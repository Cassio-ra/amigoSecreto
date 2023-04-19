<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'sorteio_id'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function sorteio()
    {
        return $this->belongsTo(Sorteio::class, 'sorteio_id');
    }
}
