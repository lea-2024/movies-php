<?php
	$ruta_actual = strtok($_SERVER['REQUEST_URI'],'?');
	$ruta_raiz = '/';
?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
<!--  Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <title>CAC Movies | <?php echo (isset($title)) ? $title : 'Inicio' ?></title>
<!--	Font Awesome-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	
<!-- Custom CSS	-->
	<link rel="stylesheet" href="./css/styles.css">
</head>

<body>
  <header class="d-flex align-items-center position-fixed w-100 top-0 z-3">
	  <nav class="d-flex justify-content-between align-items-center w-100 px-4">
      <a class="header_link fs-4" href="./">CAC - Movies</a>
		  
		  <?php if($ruta_actual == $ruta_raiz || $ruta_actual == '/index.php'): ?>
      <a class="header_link" href="./administracion.php">Administrar</a>
		  <?php else : ?>
      <a class="header_link" href="./">Peliculas</a>
		  <?php endif; ?>
	  </nav>
  </header>
  <main class="container text-white">
  
