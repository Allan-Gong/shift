<?php

namespace App\Repositories;

use App\Models\Shift;
use InfyOm\Generator\Common\BaseRepository;

class ShiftRepository extends BaseRepository
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
        return Shift::class;
    }
}
