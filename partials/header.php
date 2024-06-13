<?php
$ruta_actual = strtok($_SERVER['REQUEST_URI'], '?');
$ruta_raiz = '/';
?>


<!doctype html>
<html lang="en" data-bs-theme="dark">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<!--  Bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<title>CAC Movies | <?php echo (isset($title)) ? $title : 'Inicio' ?></title>
	<!--	Font Awesome-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />


	<!--	JQuery -->
	<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

	<!--	links datatables -->
	<!--	Estilos-->
<!--	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">-->
	<link rel="stylesheet" href="../css/datatables_2.css">
<!--	<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">-->
	<link rel="stylesheet" href="../css/datatables.css">
	<!--	script-->
	<script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js" defer></script>
	<script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.min.js" defer></script>

<!--	Animated CSS-->
	<link
			rel="stylesheet"
			href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
	/>
	
<!--	Sweet alert-->
	<<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@5/dark.css" />
	
	<!-- Custom CSS	-->
	<link rel="stylesheet" href="./css/styles.css">

	<!--Custom javascript - Manejo de actualizacion de estado (Activo/Inactivo)-->
	<script src="../js/main.js" defer></script>
	<script src="../js/change_status.js" defer></script>
</head>

<body>
	<header class="d-flex align-items-center position-fixed w-100 top-0 z-3">
		<nav class="d-flex justify-content-between align-items-center w-100 px-4">
			<a class="header_link fs-4" href="./">CAC - Movies</a>

			<?php if ($ruta_actual == $ruta_raiz || $ruta_actual == '/index.php') : ?>
				<a class="header_link" href="./administracion.php">Administrar</a>
			<?php else : ?>
				<a class="header_link" href="./">Peliculas</a>
			<?php endif; ?>
		</nav>
	</header>
	<main class="container text-white mb-5">