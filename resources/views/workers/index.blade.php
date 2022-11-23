<x-app-layout>

    <form method="POST" action="{{ route('workers.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <div class="mb-2">
                <label class="form-label">Имя</label>
                <input name="name" placeholder="Имя работника" class="form-control" required>
            </div>
            <div class="mb-2">
                <label class="form-label">Описание</label>
                <textarea name="desc" class="form-control"></textarea>
            </div>
            <div class="mb-2">
                <label class="form-label">Фото</label>
                <input type="file" name="image" />
            </div>
            <div class="mb-2">
                <label class="form-label">Специализация</label>
                <select name='spec_id' class="form-select mb-2">
                    @foreach ($specs as $spec)
                    <option value="{{$spec->id}}">{{$spec->name}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Create worker</button>
        </div>
    </form>
    <hr>

    @foreach ($workers as $worker)
    <div>
        <img src=" {{Storage::url($worker->image)}}" alt="nop" style="height: 100px;width: 100px;">
        <h2>Имя: {{$worker->name}}</h2>
        <h2>Описание: {{$worker->description}}</h2>
        <h2>Специализация: {{$worker->spec->name}}</h2>
        <a href="{{route('workers.edit', $worker)}}">
            Edit
        </a>
        <form method="POST" action="{{ route('workers.destroy', $worker) }}">
            @csrf
            @method('delete')
            <button type="submit">Delete</button>
        </form>
    </div>
    <hr>
    @endforeach
</x-app-layout>