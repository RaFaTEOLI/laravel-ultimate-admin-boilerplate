<?php

namespace App\Repositories\RosterRepository;

use App\Models\Roster;
use App\Repositories\AbstractRepository\AbstractRepository;

class RosterRepository extends AbstractRepository
{
    protected $model = Roster::class;
}
