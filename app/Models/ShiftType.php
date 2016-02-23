<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShiftType extends Model
{
    // use SoftDeletes;

    public $table = "shift_types";

    // protected $dates = ['deleted_at'];

    public $fillable = [];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [];

    public function shifts()
    {
        return $this->hasMany('App\Models\Shift');
    }
}