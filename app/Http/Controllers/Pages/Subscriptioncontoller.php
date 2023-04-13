<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Subscriptioncontoller extends Controller
{
    public function update($subscription){
        $user = Auth::user();

        $user->subscription($subscription)->cancel();
        return redirect()->route('membership')->with('success', 'You successfully cancelled you subscription!');
    }

    public function destroy($subcription){
        return $subcription;
    }
}
