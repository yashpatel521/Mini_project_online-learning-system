<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>canecel payment</h1>
    <?php
    
$currentUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URL]";
$returnUrl = str_replace("billing.php","profile.php",$currentUrl);

echo $currentUrl;
    ?>
</body>
</html>