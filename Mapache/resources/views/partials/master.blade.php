<!DOCTYPE html>
<!--
* CoreUI - Free Bootstrap Admin Template
* @version v2.1.8
* @link https://coreui.io
* Copyright (c) 2018 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://coreui.io/license)
-->

<html lang="en">
<head>
  <base href="./">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>MapacheUDG</title>
  <!-- Icons-->
  <link rel="shortcut icon" href="{{ asset('img/mapache.ico') }}"/>
  <link rel="stylesheet" href="css/coreui.min.css">
  <link rel="stylesheet" href="css/all.css">
  <link href="css/simple-line-icons.css" rel="stylesheet">
  <script src="js/jquery.min.js"></script>
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style5.css" rel="stylesheet">
  <link href="css/load.css" rel="stylesheet">
  <link href="css/mycss.css" rel="stylesheet">
  <link href="css/vanillatoasts.css" rel="stylesheet">
  <!-- <link href="css/styles2.css" rel="stylesheet"> -->
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="css/buttons.dataTables.min.css">
  <link href="vendors/pace-progress/css/pace.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/bootstrap4-vibrant-sea.min.css"> 
  <link rel="stylesheet" href="css/imagehover.css">
  <script src="js/sweetalert.min.js"></script>
  <script src="js/myjs.js"></script>
  <script src="js/core.js"></script>
  <script src="js/charts.js"></script>
  <script src="js/forceDirected.js"></script>
  <script src="js/frozen.js"></script>
  

   <!-- API GOOGLE MAPS -->
   <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh3H25BZ7_XuywA9tBxRgAQoVC5bUOtTY" ></script>


  
 
  <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
  <link rel="icon" href="img/favicon.png" type="image/x-icon">
</head>

<script>
  $(document).ready(function() {
		// Animate loader off screen
		$(".se-pre-con").fadeOut("slow");;
	});
  </script>
<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show my-dark-bg">
  <div class="se-pre-con"></div>
@include('sweet::alert')

@include('partials\navbar')
<div class="app-body">
@include('partials\sidebar')
@yield('content')
</div>

@include('partials\includes')

<div class="fixed-bottom">
    <footer id="footer" class="container-fluid padding  footer-copyright my-limits-bg text-center my-crystal-bg py-3">
       <div > © 2019 Copyright: MapacheUDG </div>
      </footer>
    </div>
</body>
</html>
