<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Service;
use Illuminate\Http\Request;
use \App\Http\Middleware\Authenticate;

class SubscriptionController extends Controller
    {

    public function index(User $user)
    {
    $subscriptions = $user->subscriptions()->with('service')->get();
    return view('subscriptions.index', compact('user', 'subscriptions'));
    }


    public function create(User $user)
    {
    $services = Service::all();
    return view('subscriptions.create', compact('user', 'services'));
    }


    public function store(Request $request, User $user)
    {
    $request->validate([
    'service_id' => 'required|exists:services,id',
    ]);


    $user->subscriptions()->create([
    'service_id' => $request->service_id,
    ]);


    return redirect()->route('subscriptions.index', $user)
    ->with('success', 'Service subscribed successfully');
    }


    public function destroy(User $user, $subscriptionId)
    {
    $user->subscriptions()->where('id', $subscriptionId)->delete();


    return redirect()->route('subscriptions.index', $user)
    ->with('success', 'Subscription removed');
    }
}
