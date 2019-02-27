<style>
.wrap {
    padding: 25px 0;
    font-family: Arial, Helvetica, sans-serif;
}
.h1 {
    margin-bottom: 15px;
}
</style>
<div class="wrap">
    <h1 class="h1">Добро пожаловать, {{ $name . ' ' . $lastname }}</h1>
    <div>
        <b>Ваш логин:</b> {{ $login }}
    </div>
    <div>
        <b>Ваш пароль:</b> {{ $password }}
    </div>
    <div style="text-align: center;">
        <a href="{{ route('login') }}" style="color: #fff; display: inline-block; padding: 15px; background-color: #007bff; text-decoration: none; font-size: 17px; border-radius: 3px;">
            Войти
        </button>
    </div>
</div>