<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if (isset($title)) {
                echo $title;
            } else {
                echo "FIT";
            } ?></title>
    <!-- Jquery CDN -->
    <script src="<?php echo base_url('jquery/jquery-3.6.0.min.js'); ?>"></script>
    <!-- Bootstrap CDN -->
    <link href="<?php echo base_url('bootstrap5/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <script src="<?php echo base_url('bootstrap5/js/bootstrap.bundle.min.js'); ?>"></script>
    <!-- Font Awesome-->
    <script src="https://kit.fontawesome.com/eeb684813e.js" crossorigin="anonymous"></script>
    <!-- SweetAlert For windows -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="icon" type="image/x-icon" href="<?php echo base_url('images/app.ico'); ?>">
    <!-- Quill -->
    <!-- Main Quill library -->
    <script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>

    <!-- Theme included stylesheets -->
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">

    <!-- Core build with no theme, formatting, non-essential modules -->
    <!-- <link href="//cdn.quilljs.com/1.3.6/quill.core.css" rel="stylesheet">
    <script src="//cdn.quilljs.com/1.3.6/quill.core.js"></script> -->
    <!-- <script src="<?php //echo base_url('dark/darkreader.min.js'); ?>"></script> -->
</head>

<body>
