<!DOCTYPE html>
<html>

<head>
    <title>Create User</title>
</head>

<script>
    window.onload = function() {

    }



    function submitForm() {
        const array_needed = ['title', 'org_no'];

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
</script>

<body>
    <form action="/create_org/submit" method="get">
        @csrf
        <label for="title">{{ trans('messages.org_name') }}({{ trans('messages.needed') }}) : </label>
        <input type="text" class="blank" name="title" placeholder="{{ trans('messages.org_name') }}">
        <br>
        <label for="org_no">{{ trans('messages.org_no') }}({{ trans('messages.needed') }}) : </label>
        <input type="text" class="blank" name="org_no" placeholder="{{ trans('messages.org_no') }}">
        <br>
        <button type="button" onclick="submitForm();">{{ trans('messages.submit') }}</button>
    </form>
</body>

</html>