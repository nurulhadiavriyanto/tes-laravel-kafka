<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ClubServices;
use Illuminate\Http\Request;

class ClubController extends Controller
{
    private $clubServices;

    public function __construct()
    {
        $this->clubServices = new ClubServices;
    }

    public function get(Request $request)
    {
        return $this->clubServices->get($request);
    }
}
