<form action="{{route('form.handle')}}" method="post">
    @csrf

    <label for="name">Введите имя</label>
    <div>
        <input type="text" id="name" name="name" required autofocus />
    </div>
    <button>Сохранить</button>
</form>
