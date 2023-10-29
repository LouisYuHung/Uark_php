<!DOCTYPE html>
<html>

<head>
    <title>Review</title>
</head>

<script>
    window.onload = function() {
        document.getElementById("item").innerHTML = `<div><span id="second">10</span>` + "{{ trans('messages.seconds_after') }}" + "{{ trans('messages.will_return_to_login') }}" + `</div>`;

        var second = 10;

        setTimeout(function() {
            var i = setInterval(function() {
                second--;
                document.getElementById("second").innerHTML = second;

                if (second == 0) {
                    clearInterval(i);
                    window.location.href = "/login";
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