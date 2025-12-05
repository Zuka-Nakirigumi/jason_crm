<?php


namespace App\Http\Controllers;


use App\Models\Service;
use Illuminate\Http\Request;


class ServiceController extends Controller
{

    public function index()
    {
        $services = Service::orderBy('name')->paginate(12);
        return view('services.index', compact('services'));
    }


    public function create()
    {
        return view('services.create');
    }


    public function store(Request $request)
    {
        $data = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'nullable|numeric|min:0',
        'active' => 'nullable|boolean',
        ]);


        $data['active'] = $request->has('active');


        Service::create($data);


        return redirect()->route('services.index')->with('success','Service created.');
    }


    public function show(Service $service)
    {
        return view('services.show', compact('service'));
    }


    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }


    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'nullable|numeric|min:0',
        'active' => 'nullable|boolean',
        ]);


        $data['active'] = $request->has('active');


        $service->update($data);


        return redirect()->route('services.index')->with('success','Service updated.');
    }


    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index')->with('success','Service deleted.');
    }
}