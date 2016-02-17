<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Role",
 *      required={},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="role",
 *          description="role",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="pay_rate",
 *          description="pay_rate",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class Role extends Model
{
    use SoftDeletes;

	public $table = "roles";
	
	protected $dates = ['deleted_at'];

	public $fillable = [
	    "id",
		"role",
		"pay_rate",
		"created_at",
		"updated_at",
		"deleted_at"
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
}
