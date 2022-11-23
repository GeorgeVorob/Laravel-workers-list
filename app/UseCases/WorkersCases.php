<?php

namespace App\UseCases;

use App\Models\Worker;
use App\Models\Spec;
use Illuminate\Support\Facades\Storage;

// TODO: По-хорошему кейсы не должны зависеть от http запросов. Стоит передавать сюда только необходимые данные.
// Хотя валидация laravel привязана к объекту запроса.
use Illuminate\Http\Request;


class WorkersCases
{
    public static function GetWorkers()
    {
        return Worker::all();
    }

    public static function AddWorker(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'string|max:1024',
            'image' => 'image|mimes:jpg,png,jpeg',
            'spec_id' => 'numeric|required'
        ]);

        $worker = new Worker;
        if (array_key_exists('image', $validated)) {
            $path = $request->file('image')->store('images', 'public');
            $worker->image = $path;
        }

        $worker->name = $validated['name'];
        $worker->description = $validated['desc'];
        $worker->spec()->associate(Spec::find($validated['spec_id']));
        $worker->save();
    }

    public static function UpdateWorker(Request $request, Worker $worker)
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
    }

    public static function DeleteWorker(Worker $worker)
    {
        //TODO: вынести в delete() модели?
        if ($worker->image) {
            Storage::disk('public')->delete($worker->image);
        }
        $worker->delete();
    }
}
