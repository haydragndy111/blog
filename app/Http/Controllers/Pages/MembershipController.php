<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $plans = Plan::get();
        // $plans = Plan::first()->get();
        // dd($plans);

        return view('pages.membership.index', compact('plans'));
    }
}
