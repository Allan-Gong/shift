<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Shift;
use App\Http\Requests;
use App\Http\Requests\CreateShiftRequest;
use App\Http\Requests\UpdateShiftRequest;
use App\Repositories\UserRepository;
use App\Repositories\ShiftRepository;
use App\Repositories\ShiftMetaRepository;
use App\Repositories\ShiftTypeRepository;
use App\Repositories\ShiftStatusRepository;
use App\Repositories\RoleRepository;
use App\Repositories\VenueRepository;
use Illuminate\Http\Request;
use Flash;
use InfyOm\Generator\Controller\AppBaseController;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\ShiftMeta;
use Illuminate\Support\Facades\Input;

class ShiftController extends AppBaseController
{
	/** @var  ShiftRepository */
	private $shiftRepository;
	private $roleRepository;
	private $venueRepository;
	private $userRepository;
	private $shiftMetaRepository;
	private $shiftTypeRepository;
	private $shiftStatusRepository;

	function __construct(
		ShiftRepository $shiftRepo,
		ShiftTypeRepository $shiftTypeRepo,
		ShiftMetaRepository $shiftMetaRepo,
		ShiftStatusRepository $shiftStatusRepo,
		RoleRepository $roleRepo,
		VenueRepository $venueRepo,
		UserRepository $userRepo
	)
	{
		$this->shiftRepository = $shiftRepo;
		$this->roleRepository  = $roleRepo;
		$this->venueRepository = $venueRepo;
		$this->userRepository  = $userRepo;

		$this->shiftMetaRepository = $shiftMetaRepo;
		$this->shiftTypeRepository = $shiftTypeRepo;

		$this->ShiftStatusRepository = $shiftStatusRepo;
	}

	protected function is_repeating_shift($shift_type_id)
	{
		$shift_type_repeat = $this->shiftTypeRepository->findWhere(['type' => 'repeating'])->first();

        if ( $shift_type_repeat && $shift_type_id ) {
           return ( $shift_type_id == $shift_type_repeat->id );
        }

        return false;
	}

	protected function create_repeating_shifts($shift)
	{
		$shift->repeating = date("Y-m-d H:i:s");
		$shift->save();

		$shift_date = $shift->date;

		$repeat_creation_count = config('shift.repeat_creation_count');

		foreach (range(1, $repeat_creation_count) as $num) {

            $next_shift_date = strtotime("{$shift_date} +{$num} weeks");

    		$replicated_shift = $shift->replicate();

    		$replicated_shift->date = date('Y-m-d', $next_shift_date);

			$replicated_shift->save();
		}
	}

	protected function get_week_number_by_date($str_date)
	{
		$date = new \DateTime($str_date);
		$week = $date->format("W");

		$today = new \DateTime();
		$week_today = $today->format("W");

		return $week - $week_today;
	}

	protected function display_shift($id, $form_disabled = false) {
		$shift = $this->shiftRepository->findWithoutFail($id);

		$roles  = $this->roleRepository->all();
		$venues = $this->venueRepository->all();
		$users  = $this->userRepository->all();

		$shift_types  = $this->shiftTypeRepository->all();
		$shift_status = $this->ShiftStatusRepository->all();

		if (empty($shift)) {
			Flash::error('Shift not found');

			return redirect(route('shifts.index'));
		}

		return view('shifts.edit')
			->with(array(
				'roles'              => $roles,
				'venues'             => $venues,
				'users'              => $users,
				'shift_types'        => $shift_types,
				'shift_status'       => $shift_status,
				'shift'              => $shift,
				'form_disabled'      => $form_disabled,
				'is_repeating_shift' => $this->is_repeating_shift($shift->shift_type_id),
				'week'               => $this->get_week_number_by_date($shift->date),
			))
		;
	}

	/**
	 * Display all Shifts.
	 *
     * @param Request $request
	 * @return Response
	 */
    public function index(Request $request)
	{
        $this->shiftRepository->pushCriteria(new RequestCriteria($request));

		$inputs = $request->all();

		$week_num = 0;
		if ( array_key_exists('week', $inputs) ) {
			$week_num = $inputs['week'];
		}

		$monday_num = $week_num - 1;
        $monday = date( 'Y-m-d', strtotime( "monday +{$monday_num} week" ) );
        $sunday = date( 'Y-m-d', strtotime( "sunday +{$week_num} week" ) );

        $shifts = Shift::get_weekly_shifts($monday, $sunday);

		return view('shifts.index')
			->with(array(
				'shifts' => $shifts,
				'week'   => $week_num,
				'monday' => $monday,
				'sunday' => $sunday,
			))
		;
	}

	/**
	 * Display a listing of the confirmed Shifts.
	 *
     * @param Request $request
	 * @return Response
	 */
    public function roster(Request $request)
	{
        $this->shiftRepository->pushCriteria(new RequestCriteria($request));

		$inputs = $request->all();

		$week_num = 0;
		if ( array_key_exists('week', $inputs) ) {
			$week_num = $inputs['week'];
		}

		$monday_num = $week_num - 1;
        $monday = date( 'Y-m-d', strtotime( "monday +{$monday_num} week" ) );
        $sunday = date( 'Y-m-d', strtotime( "sunday +{$week_num} week" ) );

        $shifts = Shift::get_confirmed_weekly_shifts($monday, $sunday);

		return view('shifts.roster')
			->with(array(
				'shifts' => $shifts,
				'week'   => $week_num,
				'monday' => $monday,
				'sunday' => $sunday,
			))
		;
	}

	/**
	 * Display a listing of the pending/available Shifts.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function notice_board(Request $request)
	{
		$this->shiftRepository->pushCriteria(new RequestCriteria($request));

		$inputs = $request->all();

		$week_num = 0;
		if ( array_key_exists('week', $inputs) ) {
			$week_num = $inputs['week'];
		}

		$monday_num = $week_num - 1;
		$monday = date( 'Y-m-d', strtotime( "monday +{$monday_num} week" ) );
		$sunday = date( 'Y-m-d', strtotime( "sunday +{$week_num} week" ) );

		$shifts = Shift::get_available_weekly_shifts($monday, $sunday);

		return view('shifts.notice_board')
			->with(array(
				'shifts' => $shifts,
				'week'   => $week_num,
				'monday' => $monday,
				'sunday' => $sunday,
			))
			;
	}


	/**
	 * Show the form for creating a new Shift.
	 *
	 * @return Response
	 */
	public function create(Request $request)
	{
		$inputs = $request->all();

		$week = $inputs['week'];

		$roles  = $this->roleRepository->all();
		$venues = $this->venueRepository->all();
		$users  = $this->userRepository->all();

		$shift_types  = $this->shiftTypeRepository->all();
		$shift_status = $this->ShiftStatusRepository->all();

		return view('shifts.create')
			->with(array(
				'roles'              => $roles,
				'venues'             => $venues,
				'users'              => $users,
				'shift_types'        => $shift_types,
				'shift_status'       => $shift_status,
				'form_disabled'      => false,
				'is_repeating_shift' => false,
				'week'               => $week,
			))
		;
	}

	/**
	 * Store a newly created Shift in storage.
	 *
	 * @param CreateShiftRequest $request
	 *
	 * @return Response
	 */
	public function store(CreateShiftRequest $request)
	{
		$inputs = $request->all();

		if ( $inputs['user_id'] == 'NULL' ) {
			unset($inputs['user_id']);
		}

		$shift = $this->shiftRepository->create($inputs);

		if ( $this->is_repeating_shift($shift->shift_type_id) ) {
			$this->create_repeating_shifts($shift);
		}

		Flash::success("Shift saved successfully.");

		return redirect(route('shifts.index'));
	}

	/**
	 * Display the specified Shift.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		return $this->display_shift($id, true);
	}

	/**
	 * Show the form for editing the specified Shift.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function edit($id)
	{
		return $this->display_shift($id, false);
	}

	/**
	 * Update the specified Shift in storage.
	 *
	 * @param  int              $id
	 * @param UpdateShiftRequest $request
	 *
	 * @return Response
	 */
	public function update($id, UpdateShiftRequest $request)
	{
		$shift = $this->shiftRepository->findWithoutFail($id);

		$week = $this->get_week_number_by_date($shift->date);

		if (empty($shift)) {
			Flash::error('Shift not found');
			return redirect(route('shifts.index') . "?week={$week}");
		}

		$inputs = $request->all();

		if ( $inputs['user_id'] == 'NULL' ) {
			unset($inputs['user_id']);
		}

		$shift_type_id = $inputs['shift_type_id'];

		if ( !$shift_type_id ) {
			Flash::error('Error updating shift. Please try again.');
			return $this->display_shift($id, false);
		}

		$is_repeating_shift = $this->is_repeating_shift($shift_type_id);

		if ( $is_repeating_shift ) {
			$shift_save_option = $inputs['shift_save_option'];

			if ( !$shift_save_option ) {
				Flash::error('Error updating shift. Please try again.');
				return $this->display_shift($id, false);
			}

			if ( $shift_save_option == 1 ) {
				// Updating only this shift
				$shift = $this->shiftRepository->update($inputs, $id);
				Flash::success('Shift updated successfully.');
				return redirect(route('shifts.index') . "?week={$week}");
			}
			else if ( $shift_save_option == 2 ) {

                // Update current shift and its following instance identified by the 'repeating' property

                DB::transaction(function() use ($shift, $inputs) {
                    // 1 . First delete the current shift and its following instances
                    DB::table('shifts')
                        ->where('repeating', $shift->repeating)
                        ->where('date', '>=', $inputs['date'])
                        ->delete()
                    ;

                    $updated_shift = $this->shiftRepository->create($inputs);

                    // 2. Re-create this repeating shift with the updated inputs
                    $this->create_repeating_shifts($updated_shift);
                });

				Flash::success('This shift and all its following(future) shifts in the series are updated successfully.');
				return redirect(route('shifts.index') . "?week={$week}");
			}
			else {
				Flash::error('Error updating shift. Please try again.');
				return $this->display_shift($id, false);
			}
		}
		else {
			// standalone shift update
			$shift = $this->shiftRepository->update($inputs, $id);
			Flash::success('Shift updated successfully.');
			return redirect(route('shifts.index') . "?week={$week}");
		}
	}

	/**
	 * Remove the specified Shift from storage.
	 *
	 * @param  int $id
	 * @param  Request  $request
	 *
	 * @return Response
	 */
	public function destroy($id, Request $request)
	{
		$shift = $this->shiftRepository->findWithoutFail($id);

		if ( empty($shift) ) {
			Flash::error('Shift for deletion not found');

			return redirect(route('shifts.index'));
		}

		$inputs = $request->all();

		$week = $this->get_week_number_by_date($shift->date);

		if ( $shift->is_repeating() )
		{
			if ( !array_key_exists('shift_delete_option', $inputs) )
			{
				Flash::error("Error deleting shift: {$id}. Please try again.");
				return redirect(route('shifts.index') . "?week={$week}");
			}

			$shift_delete_option = $inputs['shift_delete_option'];

			if ( $shift_delete_option == 1 )
			{
				// delete current shift only
				$this->shiftRepository->delete($id);
				Flash::success('Shift deleted successfully.');

				return redirect(route('shifts.index') . "?week={$week}");
			}
			else if ( $shift_delete_option == 2 )
			{

				// delete current shift and its following instance identified by the 'repeating' property
				DB::table('shifts')
					->where('repeating', $shift->repeating)
					->where('date', '>=', $shift->date)
				    ->delete()
				;

				Flash::success('This shift and all its following(future) shifts in the series are deleted successfully.');
				return redirect(route('shifts.index') . "?week={$week}");
			}
			else
			{
				Flash::error("Error deleting shift: {$id}. Please try again.");
				return redirect(route('shifts.index') . "?week={$week}");
			}
		}
		else
		{
			// Deleting a standalone shift
			$this->shiftRepository->delete($id);
			Flash::success('Shift deleted successfully.');
			return redirect(route('shifts.index') . "?week={$week}");
		}

	}

    /**
     * Remove the specified Shift from storage.
     *
     * @param  Request  $request
     *
     * @return Response
     */
    public function purge(Request $request)
    {
        DB::table('shifts')->delete();
        Flash::success('All Shifts deleted successfully.');
        return redirect(route('shifts.index'));

    }
}
