<?php

namespace App\Http\Controllers;

use App\Repositories\RosterRepository\RosterRepository;
use App\Traits\ApiResponser;
use Exception;
use Illuminate\Http\Request;

class RosterController extends Controller
{
    use ApiResponser;
    private $rosterRepository;

    public function __construct()
    {
        $this->middleware(["auth", "verified"]);
        $this->rosterRepository = new RosterRepository();
    }

    public function index(Request $request)
    {

        $rosterReport = $request->only(['roster_report']);

        return $this->success($rosterReport, 200);
    }

    public function store(Request $request)
    {
        try {
            $rosterReport = $request->only(['roster_report']);

            $this->rosterRepository->store($rosterReport);

            return $this->success([
                'message' => 'Roster succesfully saved',
            ]);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }
}
