<?php

namespace App\Http\Controllers;
use App\User;
use App\Manager;
use App\Vacation;
use JWTAuth;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Config;

class VacationController extends Controller
{
    public function createVacation(Request $request) {
       
        $user = Auth::user();
        $manager= Manager::where('id' , $user->manager_id)->first();
        $vacation = new Vacation();
        $vacation->fromDate = Carbon::parse($request->fromDate);
        $vacation->endDate = Carbon::parse($request->endDate);
        $vacation->NoOfDays = $request->NoOfDays;
        $vacation->vacationType = $request->vacationType;
        $vacation->status = 'pending';
        $vacation->user_id = $user->id;
        $vacation->manager_id = $user->manager_id;
        $vacation->save();
        $user->vacations()->save($vacation);
        $manager->vacations()->save($vacation);
        return response()->json(['message' => 'message submitted successfully']);
    }
}
