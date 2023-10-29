<!DOCTYPE html>
<html>

<head>
    <title>Review</title>
</head>

<script>
    window.onload = function() {

    }

    function logout() {
        window.location.href = "/logout";
    }
</script>

<body>
    <div><?php echo $response ?></div>
    <br>
    <div id="item"><button onclick="logout();">{{ trans('messages.logout') }}</button></div>
</body>

</html>