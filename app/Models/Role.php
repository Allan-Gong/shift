<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    // use SoftDeletes;

	public $table = "roles";

	protected $dates = ['deleted_at'];

	public $fillable = [
	    // "id",
		"role",
		"pay_rate",
		// "created_at",
		// "updated_at",
		// "deleted_at"
	];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        "id" => "integer",
		"role" => "string",
		"pay_rate" => "string"
    ];

    /**
     * Validation rules
     *
     * @var array
     */
	public static $rules = [

	];

    public function shifts()
    {
        return $this->hasMany('App\Models\Shift');
    }
}
