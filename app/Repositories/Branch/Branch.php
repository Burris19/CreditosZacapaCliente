<?php

namespace App\Repositories\Branch;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = 'branch';

    protected $fillable = [
        'idHost',
        'nombre',
        'area',
        'fecha'
    ];

    public $relations = [
        'host'
    ];

    public function relations()
    {
        return $this->hasOne('App\Repositories\Host\Host', 'id','idHost');
    }
}
