<?php

namespace App\Repositories;

use App\Models\ShiftMeta;
use InfyOm\Generator\Common\BaseRepository;

class ShiftMetaRepository extends BaseRepository
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
        return ShiftMeta::class;
    }
}
