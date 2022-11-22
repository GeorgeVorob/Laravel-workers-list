<x-app-layout>

    <form method="POST" action="{{ route('workers.store') }}" enctype="multipart/form-data">
        @csrf
        <label>Имя</label>
        <input name="name">
        </br>
        <label>Описание</label>
        <textarea name="desc"></textarea>
        </br>
        <label>Фото</label>
        <input type="file" name="image" />
        </br>
        <select name='spec_id'>
            @foreach ($specs as $spec)
            <option value="{{$spec->id}}">{{$spec->name}}</option>
            @endforeach
        </select>
        <button type="submit">Create worker</button>
    </form>

    @foreach ($workers as $worker)
    <hr>
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
    @endforeach
</x-app-layout>