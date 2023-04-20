<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sorteio extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status_codigo',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function pessoas()
    {
        return $this->hasMany(Pessoa::class);
    }

    public function status()
    {
        return $this->belongsTo(SorteioStatus::class, 'status_codigo', 'codigo');
    }
}
