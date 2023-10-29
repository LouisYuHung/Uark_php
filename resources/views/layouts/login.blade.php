<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
</head>

<body>
    <form action="/verify" method="post">
        @csrf
        <label for="username">{{ trans('messages.account') }}: </label>
        <input type="text" name="username" placeholder="{{ trans('messages.account') }}">
        <br>
        <label for="password">{{ trans('messages.password') }}: </label>
        <input type="password" name="password" placeholder="{{ trans('messages.password') }}">
        <br>
        <br>
        <button type="submit">{{ trans('messages.login') }}</button>
    </form>
</body>

</html>