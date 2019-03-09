<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KioskStudent extends Model
{    
    protected $table = 'logs';
    public $timestamps = true;
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
}
