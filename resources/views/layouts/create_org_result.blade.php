<!DOCTYPE html>
<html>

<head>
    <title>Create Organization Result</title>
</head>

<script>
    window.onload = function() {
        document.getElementById("item").innerHTML = `<div><span id="second">10</span>` + "{{ trans('messages.seconds_after') }}" + "{{ trans('messages.will_return_to') }}" + "{{ trans('messages.account') }}" + "{{ trans('messages.create') }}" + "{{ trans('messages.page') }}" + `</div>`;

        var second = 10;

        setTimeout(function() {
            var i = setInterval(function() {
                second--;
                document.getElementById("second").innerHTML = second;

                if (second == 0) {
                    clearInterval(i);
                    window.location.href = "/create_user";
                }
            }, 1000);
        }, 100);
    }
</script>

<body>
    <div><?php echo $response ?></div>
    <br>
    <div id="item"></div>
</body>

</html>