<?php

namespace App\Repositories;

use App\Models\ShiftStatus;
use InfyOm\Generator\Common\BaseRepository;

class ShiftStatusRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [

    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ShiftStatus::class;
    }
}
