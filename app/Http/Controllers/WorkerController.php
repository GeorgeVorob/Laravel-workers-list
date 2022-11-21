<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use App\Models\Spec;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('workers.index', [
            'workers' => Worker::all(),
            'specs' => Spec::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'string|max:1024',
            'image' => 'required|image|mimes:jpg,png,jpeg',
            'spec_id' => 'numeric|required'
        ]);

        $path = $request->file('image')->store('images', 'public');

        $worker = new Worker;
        $worker->name = $validated['name'];
        $worker->description = $validated['desc'];
        $worker->spec()->associate(Spec::find($validated['spec_id']));
        $worker->image = $path;
        $worker->save();

        return redirect(route('workers.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function show(Worker $worker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function edit(Worker $worker)
    {
        return view('workers.edit', [
            'worker' => $worker,
            'specs' => Spec::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Worker $worker)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'string|max:1024',
            'image' => 'image|mimes:jpg,png,jpeg',
            'spec_id' => 'numeric|required'
        ]);

        $path = null;
        if (array_key_exists('image', $validated)) {
            // delete old image
            if ($worker->image) {
                Storage::disk('public')->delete($worker->image);
            }

            $path = $request->file('image')->store('images', 'public');
            $validated['image'] = $path;
        }

        // desc -> description
        if (array_key_exists('desc', $validated)) {
            $validated['description'] = $validated['desc'];
        }
        $worker->update($validated);

        return redirect(route('workers.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function destroy(Worker $worker)
    {
        //
    }
}
