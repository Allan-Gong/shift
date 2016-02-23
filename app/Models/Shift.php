<?php

namespace App\Models;

use Eloquent as Model;
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
        return $this->hasOne('App\Models\Shift_meta');
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

    public function get_all_shifts_between($start_date, $end_date)
    {
        $dt_start_date = new DateTime($start_date);
        $dt_end_date   = new DateTime($end_date);

        $shift_type_standalone = $this->findWhere(['type' => 'standalone'])->first();
        $shift_type_repstandalone_id = $shift_type_standalone->id;

        $shift_type_repeat = $this->findWhere(['type' => 'repeating'])->first();
        $shift_type_repeat_id = $shift_type_repeat->id;

        $standalone_shifts = DB::table('shifts')
            ->where('shift_type_id', '$shift_type_repstandalone_id')
            ->whereBetween('date', [$start_date, $end_date])
            ->orderBy('date')
            ->get()
        ;

        $repeating_shifts = [];

        $daterange = new DatePeriod($dt_start_date, new DateInterval('P1D'), $dt_end_date); // P1D stands for period of one day

        foreach($daterange as $date){

            $result = DB::table('shifts')
                ->join('shift_metas', 'shifts.id', '=', 'shift_metas.shift_id')
                ->whereRaw('shift_metas.repeat_end <= CURRENT_DATE()')
                ->whereRaw("( ( {$date->getTimestamp()} - UNIX_TIMESTAMP(shift_metas.repeat_start) ) % shift_metas.repeat_interval = 0 )")
                ->get()
                ->first()
            ;

            if ($result) {
                $result->date = $date->format('Y-m-d');
                array_push($repeating_shifts, $result)
            }

        }

        return {
            'standalone' => $standalone_shifts,
            'repeating'  => $repeating_shifts,
        }

    }
}
