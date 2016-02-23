<?php

namespace App\Http\Controllers;

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

	protected function is_repeating_shift($shift_type_id) {
		$shift_type_repeat = $this->shiftTypeRepository->findWhere(['type' => 'repeating'])->first();

        if ( $shift_type_repeat && $shift_type_id ) {
           return ( $shift_type_id == $shift_type_repeat->id );
        }

        return false;
	}

	protected function get_repeating_shift_type_id() {
		$shift_type_repeat = $this->shiftTypeRepository->findWhere(['type' => 'repeating'])->first();
		return $shift_type_repeat->id;
	}

	protected function get_standalone_shift_type_id() {
		$shift_type_repeat = $this->shiftTypeRepository->findWhere(['type' => 'standalone'])->first();
		return $shift_type_repeat->id;
	}

	protected function set_repeating($shift) {
		$repeat_interval = config('shift.repeat_interval');

		$this->shiftMetaRepository->create([
			'shift_id'        => $shift->id,
			'repeat_start'    => $shift->date,
			'repeat_interval' => $repeat_interval,
		]);
	}

	protected function save_repeating_shift($shift)
	{
		$shift->date = null;
		$shift->save();
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
			))
		;
	}

	/**
	 * Display a listing of the Shift.
	 *
     * @param Request $request
	 * @return Response
	 */
    public function index(Request $request)
	{
        $this->shiftRepository->pushCriteria(new RequestCriteria($request));
		$shifts = $this->shiftRepository->all();

		// $roles = $this->roleRepository->all();
		// $venues = $this->venueRepository->all();

		return view('shifts.index')
			->with(array(
				'shifts' => $shifts,
			))
		;
	}

	/**
	 * Show the form for creating a new Shift.
	 *
	 * @return Response
	 */
	public function create()
	{
		$roles  = $this->roleRepository->all();
		$venues = $this->venueRepository->all();
		$users  = $this->userRepository->all();

		$shift_types  = $this->shiftTypeRepository->all();
		$shift_status = $this->shiftTypeRepository->all();

		return view('shifts.create')
			->with(array(
				'roles'              => $roles,
				'venues'             => $venues,
				'users'              => $users,
				'shift_types'        => $shift_types,
				'shift_status'       => $shift_status,
				'form_disabled'      => false,
				'is_repeating_shift' => false,
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
		$input = $request->all();

		$shift = $this->shiftRepository->create($input);

		if ( $this->is_repeating_shift($shift->shift_type_id) ) {
			$this->set_repeating($shift);
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

		if (empty($shift)) {
			Flash::error('Shift not found');
			return redirect(route('shifts.index'));
		}

		$is_repeating_shift_before = $this->is_repeating_shift($shift->shift_type_id);

		$inputs = $request->all();

		// echo '<pre>';
		// print_r($inputs);
		// echo '</pre>';
		// exit;

		$shift_type_id = $inputs['shift_type_id'];

		if ( !$shift_type_id ) {
			Flash::error('Error updating shift. Please try again.');
			return $this->display_shift($id, false);
		}

		$is_repeating_shift_after = $this->is_repeating_shift($shift_type_id);

		if ( $is_repeating_shift_before == false && $is_repeating_shift_after == true ) {
			// Change from standalone to repeating, just need to add shift meta data
			$shift = $this->shiftRepository->update($inputs, $id);
			$this->set_repeating($shift);
		}
		else if ( $is_repeating_shift_before == true && $is_repeating_shift_after == true ) {
			// Change from repeating to repeating

			$shift_save_option = $inputs['shift_save_option'];

			if ( !$shift_save_option ) {
				Flash::error('Error updating shift. Please try again.');
				return $this->display_shift($id, false);
			}

			if ( $shift_save_option == 1 ) {
				// User choose to only update the current shift instance
				// Perform the following:

				$shift_date              = $shift->date;
				$shift_repeat_start_date = $shift->shift_meta->repeat_start;

				$dt_shift_date         = new DateTime($shift_date);
				$dt_shift_repeat_start = new DateTime($shift_repeat_start_date);
				$dt_today              = new DateTime(date("Y-m-d"));

				$dt_yesterday = new DateTime();
				$dt_yesterday->add(DateInterval::createFromDateString('yesterday'));

				// 1. Create a standalone shift out of the current instance of the repeating shift
				$shift_standalone = $shift->replicate();
				$shift_standalone->shift_type_id = $this->get_standalone_shift_type_id();
				$shift_standalone->date = $shift_repeat_start_date;
				$shift_standalone->saveOrFail();

				// 2. If the current repeating shift is created in the past (not the first instance),
				//    create a repeating shift based on the current repeating shift but ended yesterday
				if ( $dt_shift_repeat_start != $dt_shift_date && $dt_shift_date < $dt_today ) {
					$shift_repeating_past = $shift->replicate();

					$shift_repeating_past->date = $shift_repeat_start_date;

					$repeat_interval = config('shift.repeat_interval');

					$this->shiftMetaRepository->create([
						'shift_id'        => $shift_repeating_past->id,
						'repeat_start'    => $shift_repeating_past->date,
						'repeat_end'      => $dt_yesterday->format('Y-m-d'),
						'repeat_interval' => $repeat_interval,
					]);

					$this->save_repeating_shift($shift_repeating_past);
				}

				// 3. Copy the current shift in action into a new repeating one,
				//    set its start date to the next instance
			}
			else if ( $shift_save_option == 2 ) {
				// User choose to update current and future shift instances
				// Perform the following:

				// 1. If the current repeating shift is created in the past (not the first instance),
				//    create a repeating shift based on the current repeating shift but ended yesterday

				// 2. Update the shift in action, set its start date to the current instance's date if it is not the
				//    first instance. Otherwise, just update the shift in action.
			}
			else {
				Flash::error('Error updating shift. Please try again.');
				return $this->display_shift($id, false);
			}

		}
		else if ( $is_repeating_shift_before == true && $is_repeating_shift_after == false ) {
			// Change from repeating to standlone, enforced to be impossible
			Flash::error('Error updating shift. Please try again.');
			return $this->display_shift($id, false);
		}
		else {
			// standalone shift update
			$shift = $this->shiftRepository->update($inputs, $id);
			Flash::success('Shift updated successfully.');
			return redirect(route('shifts.index'));
		}
	}

	/**
	 * Remove the specified Shift from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$shift = $this->shiftRepository->findWithoutFail($id);

		if (empty($shift)) {
			Flash::error('Shift not found');

			return redirect(route('shifts.index'));
		}

		$this->shiftRepository->delete($id);

		Flash::success('Shift deleted successfully.');

		return redirect(route('shifts.index'));
	}
}
