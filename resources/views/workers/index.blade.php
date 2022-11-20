    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
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
            <button type="submit">Create worker</button>
        </form>
    </div>