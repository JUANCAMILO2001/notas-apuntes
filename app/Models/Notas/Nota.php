<?php

namespace App\Models\Notas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;


class Nota extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'notas';
    protected $primaryKey = 'id';
    protected $fillable= [
        'nombre',
        'descripcion',
        'estado',
        //'archivo',
    ];
    protected $dates = ['deleted_at'];
}
