<?php
  $cookie_duration = 365 * 24 * 60 * 60;
  session_set_cookie_params($cookie_duration);
	session_start();
	if(isset($_SESSION['peliculas'])){
		$peliculas = $_SESSION['peliculas'];
	} else{
		$peliculas = [];
	}
  
  $allStatus =  array_column($peliculas, 'status');
  
  if(in_array(1,$allStatus)){
    $all_desactived = false;
  } else{
    $all_desactived = true;
  }
	
	include './partials/header.php';
	?>
	
	<section class="my-5">
		<?php if(count($peliculas) == 0 || $all_desactived) : ?>
      <h3 class="text-center fs-4">Contenido no disponible por el momento</h3>
			<?php else: ?>
			<section class="container">
				<h1 class="text-center">Tendencias</h1>
				<div class="d-flex flex-wrap justify-content-md-start justify-content-center align-items-center mt-5 gap-5">
					<?php foreach ($peliculas as $pelicula): ?>
						<?php if($pelicula['status'] == 1): ?>
					<!-- columna de cada card en la grilla-->
							<!-- Card de la pelicula -->
							<div class="card bg-card md-m-auto m-0 mb-5" style="width:18rem;">
								<img src="./assets/img/cinema.jpg" class="card-img-top" alt="imagen pelicula">
								<div class="card-body">
									<h5 class="card-title"><?php echo $pelicula['nombre'] ?></h5>
									<p class="card-text card-description"><?php echo  mb_substr($pelicula['descripcion'],0,65,'utf8'); echo strlen($pelicula['descripcion']) > 65 ? '...' : '' ?></p>
									<p class="card-text"><?php echo str_repeat('⭐', intval($pelicula['calificacion'])) ?> </p>
									<p class="card-text">Género: <?php echo $pelicula['genero']?></p>
									<p>Año: <?php echo $pelicula['anio']?></p>
									<p>Director: <?php echo $pelicula['director'] ?></p>
								</div>
							</div>
						<?php endif; ?>
					<?php endforeach; ?>
				</div>
			</section>
		<?php endif; ?>
	</section>
	
<?php include './partials/footer.php'  ?>