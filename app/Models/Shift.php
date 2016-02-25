<?php

namespace App\Models;

use Eloquent as Model;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;

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
		"shift_status_id",
		"notes",
        "shift_type_id",
        "repeating",
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

    public function shift_type()
    {
        return $this->belongsTo('App\Models\ShiftType');
    }

    public function shift_status()
    {
        return $this->belongsTo('App\Models\ShiftStatus');
    }

    public function shift_meta()
    {
        return $this->hasOne('App\Models\ShiftMeta');
    }

    public function get_status_string()
    {
        if ( !$this->shift_status ) { return null; }

        return $this->shift_status->status;
    }

    public function get_role_string()
    {
        if ( !$this->role ) { return null; }

        return $this->role->role;
    }

    public function get_user_string()
    {
        if ( !$this->user ) { return null; }

        return $this->user->name();
    }

    public function get_venue_string()
    {
        if ( !$this->venue ) { return null; }

        return $this->venue->venue;
    }

    public function is_repeating()
    {
        return empty($this->repeating) ? false : true;
    }

    public static function get_weekly_shifts($week_num = 0)
    {
        $monday_num = $week_num - 1;
        $monday = date( 'Y-m-d', strtotime( "monday +{$monday_num} week" ) );
        $sunday = date( 'Y-m-d', strtotime( "sunday +{$week_num} week" ) );

        $shifts = Shift::whereBetween('date', [$monday, $sunday])
            ->orderBy('date')
            ->orderBy('start_time')
            ->get()
        ;

        return $shifts;

    }
}
