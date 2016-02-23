<?php

namespace App\Repositories;

use App\Models\ShiftType;
use InfyOm\Generator\Common\BaseRepository;

class ShiftTypeRepository extends BaseRepository
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
        return ShiftType::class;
    }
}
