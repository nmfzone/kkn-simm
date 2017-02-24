<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Resident;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ResidentsApiController extends Controller
{
    /**
     * Fetch the available residents.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $residents = collect();

        if (is_null($request->term)) {
            $residents = Resident::take(10)->get();
        } else {
            $residents = Resident::where(function ($query) use ($request) {
                $query->where('name', 'LIKE', '%'.$request->term.'%')
                      ->orWhere('nik', 'LIKE', '%'.$request->term.'%');
            })->take(10)->get();
        }

        return response()->json($residents);
    }
}
