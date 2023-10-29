<!DOCTYPE html>
<html>

<head>
    <title>Create User</title>
</head>

<script>
    window.onload = function() {

    }

    function createOrg() {
        window.location.href = "/create_org";
    }

    function submitForm() {
        const array_needed = ['name', 'email', 'account', 'password', 'file_path'];

        var items = document.getElementsByClassName("blank");

        for (var i = 0; i < items.length; i++) {
            if (array_needed.includes(items[i].name)) {
                if (items[i].value == null || items[i].value == '') {
                    alert(items[i].placeholder + "{{ trans('messages.is') }}" + "{{ trans('messages.needed') }}");
                    return;
                }
            }
        }

        document.getElementsByTagName("form")[0].submit();
    }

    function returnToLogin() {
        window.location.href = "/login";
    }
</script>

<body>
    <?php

    use Illuminate\Support\Facades\Session; ?>
    <form action="/create_user/submit" method="get">
        @csrf
        <label for="org_no">{{ trans('messages.choose') }}{{ trans('messages.org') }}</label>
        <select name="org">
            <?php foreach ($orgs as $org) { ?>
                <option value="<?php echo $org->org_no ?>"><?php echo $org->title ?></option>
            <?php } ?>
        </select>
        <br>
        <button type="button" onclick="createOrg();">{{ trans('messages.if_org_not_exist') }}{{ trans('messages.please_click_here') }}</button>
        <br>
        <label for="name">{{ trans('messages.name') }}({{ trans('messages.needed') }}) : </label>
        <input type="text" class="blank" name="name" placeholder="{{ trans('messages.name') }}">
        <br>
        <label for="birthday">{{ trans('messages.birthday') }}({{ trans('messages.optional') }}) : </label>
        <input type="text" class="blank" name="birthday" placeholder="{{ trans('messages.birthday') }}">
        <br>
        <label for="email">{{ trans('messages.email') }}({{ trans('messages.needed') }}) : </label>
        <input type="text" class="blank" name="email" placeholder="{{ trans('messages.email') }}">
        <br>
        <label for="account">{{ trans('messages.account') }}({{ trans('messages.needed') }}) : </label>
        <input type="text" class="blank" name="account" placeholder="{{ trans('messages.account') }}" value="<?php echo Session::get('account') ?>">
        <br>
        <label for="password">{{ trans('messages.password') }}({{ trans('messages.needed') }}) : </label>
        <input type="text" class="blank" name="password" placeholder="{{ trans('messages.password') }}">
        <br>
        <label for="file_path">{{ trans('messages.file_path') }}({{ trans('messages.needed') }}) : </label>
        <input type="text" class="blank" name="file_path" placeholder="{{ trans('messages.file_path') }}">
        <br>
        <button type="button" onclick="submitForm();">{{ trans('messages.submit') }}</button>
        <br>
        <button type="button" onclick="returnToLogin();">{{ trans('messages.cancel') }}</button>
    </form>
</body>

</html>