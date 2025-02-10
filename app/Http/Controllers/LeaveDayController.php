<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;

// class LeaveDayController extends Controller
// {
//     //
// }
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeaveDay;
use Carbon\Carbon;

class LeaveDayController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $leaveDays = $user->leaveDays;
        return view('dashboard', compact('user', 'leaveDays'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $user = auth()->user();
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);
        $days = $endDate->diffInDays($startDate) + 1;

        if ($days > $user->remaining_leave_days) {
            return redirect()->back()->with('error', 'You do not have enough leave days remaining.');
        }

        $user->remaining_leave_days -= $days;
        $user->save();

        LeaveDay::create([
            'user_id' => $user->id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return redirect()->route('dashboard')->with('success', 'Leave application submitted successfully.');
    }
}
