<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>SIAP MAGANG</title>
    <link id="pagestyle" href="/assets/css/material-dashboard.css?v=3.0.5" rel="stylesheet" />
    <style>
        /* body {
            padding-top: 5rem;
        } */
    </style>
    <?= $this->renderSection('pageStyles') ?>
</head>

<body>

    <?= '' // view('App\Views\Auth\_navbar') 
    ?>

    <?= $this->renderSection('main') ?>

    <script src="/assets/js/jquery-3.6.3.min.js"></script>
    <script src="/assets/js/material-dashboard.min.js?v=3.0.5"></script>
    <?= $this->renderSection('pageScripts') ?>
</body>

</html>