<x-app-layout>

    <form method="POST" action="{{ route('workers.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <div class="mb-2">
                <label class="form-label">Имя</label>
                <input name="name" placeholder="Иванов Иван" class="form-control" required>
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
            <button type="submit" class="btn btn-primary">Добавить сотрудника</button>
        </div>
    </form>
    <hr>

    @foreach ($workers as $worker)
    <div class="card mb-3 worker-card">
        <div class="row g-0">
            <div class="col-md-3">
                <img src="{{Storage::url($worker->image)}}" class="img-fluid rounded-start worker-card-image" alt="Нет изображения">
            </div>
            <div class="col-md-9">
                <div class="card-body worker-card-body">
                    <h5 class="card-title">{{$worker->name}} <small class="text-muted">{{$worker->spec->name}}</small></h5>
                    <p class="card-text worker-card-desc"> {{$worker->description}}</p>
                    <a class="btn btn-primary worker-card-button" href="{{route('workers.edit', $worker)}}">
                        Изменить
                    </a>
                    <form class="worker-card-button" method="POST" action="{{ route('workers.destroy', $worker) }}">
                        @csrf
                        @method('delete')
                        <button class="btn btn-primary" type="submit">Удалить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <hr>
    @endforeach
</x-app-layout>