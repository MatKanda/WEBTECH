
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" type="text/javascript"></script>
</head>
<body>
<div id="loginstatus">Pleas enter the code from your google auth app</div>
<div id="loginform">
    Code: <input type="text" id="googlecode" />
    <input type="submit" id="submit-googlecode" value="Submit" />
</div>
<?php
echo "<div id='submitLogin'>
    <form action=../index.php method=post>
        <input style='display: none' type='text' name='2fa' value='true'>
        <input style='display: none' type=text name=verified value='true'><br>
        <button>Go to your profile</button>
    </div>"

?>

<script>
    $('#submitLogin').hide();
    $('input#submit-googlecode').on('click', function() {
        var googlecode = $('input#googlecode').val();
        if ($.trim(googlecode) != '') {
            $.post('check.php', {code: googlecode}, function(data) {
                $('div#loginstatus').text(data);
                if (data == 1) {
                    $('div#loginstatus').text('Logged in');
                    $('div#loginform').hide();
                    $('#submitLogin').show();
                }
            });
        }
    });
</script>



</body>
</html>