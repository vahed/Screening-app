<?php

namespace App\Repositories;

use App\Interfaces\ScreeningRepositoryInterface;
use App\Models\Screening;

class ScreeningRepository implements ScreeningRepositoryInterface
{
    public function createScreening(array $createScreening)
    {
        return Screening::create($createScreening);
    }

}
