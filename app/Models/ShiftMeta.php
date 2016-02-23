<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShiftMeta extends Model
{
    // use SoftDeletes;

    public $table = "shift_metas";

    // protected $dates = ['deleted_at'];

    public $fillable = [
        // "id",
        "shift_id",
        "repeat_start",
        "repeat_end",
        "repeat_interval",
        "repeat_year",
        "repeat_month",
        "repeat_week",
        "repeat_weekday",
        "repeat_day",
        // "created_at",
        // "updated_at"
    ];

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

    public function shift()
    {
        return $this->belongsTo('App\Models\Shift');
    }
}