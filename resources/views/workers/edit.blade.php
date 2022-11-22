<h1>Worker edit</h1>
<form method="POST" action="{{ route('workers.update', $worker) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <label>Имя</label>
    <input value="{{$worker->name}}" name="name">
    </br>
    <label>Описание</label>
    <textarea name="desc">{{$worker->description}}</textarea>
    </br>
    <label>Фото</label>
    <input type="file" name="image" />
    </br>
    <select name='spec_id'>
        @foreach ($specs as $spec)

        <option value="{{$spec->id}}"
@if ($spec->id == $worker->spec_id )
selected="selected"
@endif
        >{{$spec->name}}</option>

        @endforeach
    </select>
    <img src=" {{Storage::url($worker->image)}}" alt="nop" style="height: 100px;width: 100px;">
    <button type="submit">Save</button>
</form>