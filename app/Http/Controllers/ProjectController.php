<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Lead;
use App\Models\Service;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{

    public function index()
    {
        $projects = Project::with('lead','owner','manager')->orderBy('created_at','desc')->paginate(12);
        return view('projects.index', compact('projects'));
    }


    public function create(Request $request)
    {
        $lead = null;
        if($request->has('lead_id')){
        $lead = Lead::find($request->input('lead_id'));
        }
        $services = Service::where('active',true)->orderBy('name')->get();
        return view('projects.create', compact('lead','services'));
    }


    public function store(Request $request)
    {
        $data = $request->validate([
        'lead_id' => 'required|exists:leads,id',
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'service_ids' => 'nullable|array',
        'service_ids.*' => 'exists:services,id',
        'quantities' => 'nullable|array',
        ]);


        DB::transaction(function() use ($request, $data){
        $project = Project::create([
        'lead_id' => $data['lead_id'],
        'title' => $data['title'],
        'description' => $data['description'] ?? null,
        'owner_id' => $request->user()->id,
        'approval_status' => 'pending',
        ]);


        if(!empty($data['service_ids'])){
        foreach($data['service_ids'] as $index => $sid){
        $qty = $request->input('quantities')[$index] ?? 1;
        $service = Service::find($sid);
        $project->services()->attach($sid, [
        'quantity' => max(1, (int)$qty),
        'unit_price' => $service->price,
        ]);
        }
        }
        });


        return redirect()->route('projects.index')->with('success','Project created (pending manager approval).');
    }


    public function show(Project $project)
    {
        $project->load('lead','services','owner','manager');
        return view('projects.show', compact('project'));
    }


    public function edit(Project $project)
    {
        $services = Service::where('active',true)->orderBy('name')->get();
        $project->load('services');
        return view('projects.edit', compact('project','services'));
    }

    public function approve(Request $request, Project $project)
    {
        $user = $request->user();
        if(!$user->isManager() && $user->role !== 'admin'){
            abort(403);
        }

        $project->update([
            'approval_status' => 'approved',
            'manager_notes' => $request->input('manager_notes')
        ]);

        // Optionally convert project to subscriptions for the lead's contact (create user if needed)
        // Example: if the lead has an email we create a user/customer and attach subscriptions for each service
        $lead = $project->lead;
        if($lead && $lead->email){
            $userCustomer = \App\Models\User::firstOrCreate(
                ['email' => $lead->email],
                ['name' => $lead->name, 'password' => bcrypt(Str::random(12)), 'role' => 'user']
            );

            foreach($project->services as $service){
                \App\Models\Subscription::create([
                    'user_id' => $userCustomer->id,
                    'service_id' => $service->id,
                    'start_date' => now()->toDateString(),
                    'end_date' => now()->addYear()->toDateString(),
                    'status' => 'active',
                ]);
            }

            // mark lead converted
            $lead->update(['status' => 'converted']);
        }

        return redirect()->route('projects.show',$project)->with('success','Project approved and subscriptions created (if lead had email).');
    }
    public function reject(Request $request, Project $project)
    {
        $user = $request->user();
        if(!$user->isManager() && $user->role !== 'admin') abort(403);

        $project->update([
            'approval_status' => 'rejected',
            'manager_notes' => $request->input('manager_notes')
        ]);

        return redirect()->route('projects.show',$project)->with('success','Project rejected.');
    }


}
