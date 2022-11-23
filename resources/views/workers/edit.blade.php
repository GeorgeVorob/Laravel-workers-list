<x-app-layout>
    <form method="POST" action="{{ route('workers.update', $worker) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <div class="mb-2">
                <label class="form-label">Имя</label>
                <input name="name" placeholder="Иванов Иван" class="form-control" required value="{{$worker->name}}">
            </div>
            <div class="mb-2">
                <label class="form-label">Описание</label>
                <textarea name="desc" class="form-control">{{$worker->description}}</textarea>
            </div>
            <div class="row mb-2">
                <div class="col-6">
                    <label class="form-label">Фото</label>
                    <input type="file" name="image" />
                </div>
                <div class="col-6">
                    Старое фото:
                    <img src="{{Storage::url($worker->image)}}" alt="nop" style="height: 100px;width: 100px;">
                </div>
            </div>
            <div class="mb-2">
                <label class="form-label">Специализация</label>
                <select name='spec_id' class="form-select mb-2">

                    @foreach ($specs as $spec)
                    <option value="{{$spec->id}}" @if ($spec->id == $worker->spec_id )
                        selected="selected"
                        @endif
                        >{{$spec->name}}</option>
                    @endforeach

                </select>
            </div>
            <button type="submit" class="btn btn-primary">Изменить данные.</button>
        </div>
    </form>
</x-app-layout>