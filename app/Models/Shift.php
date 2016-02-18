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
 *          property="role_id",
 *          description="role id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="user_id",
 *          description="user id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="venue_id",
 *          description="venue id",
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
		"role_id",
		"user_id",
		"venue_id",
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
		"role_id" => "integer",
		"user_id" => "integer",
		"venue_id" => "integer",
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

    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function venue()
    {
        return $this->belongsTo('App\Models\Venue');
    }

    // public function get_role()
    // {
    //     $role = $this->role()->get()->first();

    //     $result = $role ? $role->role : null;

    //     return $result;
    // }

    // public function get_assignee()
    // {
    //     $assignee = $this->assignee()->get()->first();

    //     $result = $assignee ? $assignee->name() : null;

    //     return $result;
    // }

    // public function get_venue()
    // {
    //     $venue = $this->venue()->get()->first();

    //     $result = $venue ? $venue->venue : null;

    //     return $result;
    // }
}
