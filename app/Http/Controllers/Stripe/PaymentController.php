<?php

namespace App\Http\Controllers\Stripe;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Psy\debug;

class PaymentController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('stripe.payments.index', [
            'intent' => $user->createSetupIntent(),
        ]);
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        dd($request['payment-method']);

        try {
            $paymentMethod = $request->input('payment-method');


            $user->update([
                'line1' => $request->line1,
                'line2' => $request->line2,
                'city' => $request->city,
                'state' => $request->state,
                'country' => $request->country,
                'postal_code'  => $request->postal_code
            ]);

            $plan = Plan::where('stripe_name', $request->plan)->first();
            dd($paymentMethod);

            $user->newSubscription($plan->stripe_name, $plan->stripe_price_id)->create($paymentMethod);

            return redirect()->route('billing')->with('success', 'Thank you for subscribing');
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
}
