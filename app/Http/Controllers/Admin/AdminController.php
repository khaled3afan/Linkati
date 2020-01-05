<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::count();
        $verified = User::whereNotNull('email_verified_at')->count();
        $profiles = Profile::all()->count();
        $views = Profile::all()->sum('views');

        $analytics = [
            'users' => User::where('created_at', '>=', now()->subDays(30))
                           ->select(DB::raw('count(id) as count'), 'created_at')
                           ->orderBy('created_at')
                           ->groupBy(DB::raw('day(created_at)'))
                           ->get()
                           ->mapWithKeys(function ($value) {
                               return [$value->created_at->format('d-m-Y') => $value->count];
                           }),
            'profiles' => Profile::where('created_at', '>=', now()->subDays(30))
                                 ->select(DB::raw('count(id) as count'), 'created_at')
                                 ->orderBy('created_at')
                                 ->groupBy(DB::raw('day(created_at)'))
                                 ->get()
                                 ->mapWithKeys(function ($value) {
                                     return [$value->created_at->format('d-m-Y') => $value->count];
                                 }),
        ];

        return view('admin.index',
            compact('users', 'verified', 'profiles', 'views', 'analytics'));
    }
}
