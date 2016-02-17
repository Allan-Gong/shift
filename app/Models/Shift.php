<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Shift",
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
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="assignee",
 *          description="assignee",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="venue",
 *          description="venue",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="status",
 *          description="status",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="notes",
 *          description="notes",
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
*      @SWG\Property(
 *          property="date",
 *          description="date",
 *          type="string",
 *          format="date"
 *      )
 * )
 */
class Shift extends Model
{
    use SoftDeletes;

	public $table = "shifts";

	protected $dates = ['deleted_at'];

	public $fillable = [
	    // "id",
		"role",
		"assignee",
		"venue",
        "date",
		"start_time",
		"finish_time",
		"clock_on",
		"clock_off",
		"status",
		"notes",
		// "created_at",
		// "updated_at"
	];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        "id" => "integer",
		"role" => "integer",
		"assignee" => "integer",
		"venue" => "integer",
		"status" => "string",
		"notes" => "string"
    ];

    /**
     * Validation rules
     *
     * @var array
     */
	public static $rules = [

	];
}
