<?php
$myfile = fopen("newfile.php", "w") or die("Unable to open file!");
$txt = 
"<html>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <meta http-equiv='X-UA-Compatible' content='ie=edge'>
        <meta http-equiv='Cache-control' content='public'>
        <script>window.location.href='./index.php'</script>
    </head>
</html>";
fwrite($myfile, $txt);
fclose($myfile);
?>