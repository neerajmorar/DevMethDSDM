<?php
//This is the header for which all pages of the website will use.
//$pageTitle allows the title of the page to be dynamically set.
?>
<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>AEMS - <?php echo $pageTitle ?></title>
        <link rel="stylesheet" type="text/css" href="CSS/theme.css" />
        <link href="CSS/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <script type="text/javascript">
            function clearForm() 
            {
                window.location.reload();
            }
        </script>
    </head>
    <body id="body" <?php $urlTest = explode('/', $_GET["url"]); if ($urlTest[1] == "manageEvent") { echo "onbeforeunload='return confirmRefresh()'"; } ?>>
        <header>
            <h1 id="heading">AEMS</h1>