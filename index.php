<?php
	require './database/connection.php';
	include './partials/header.php';
  
  $sql_peliculas = "SELECT p.nombre, p.descripcion, p.anio, p.calificacion, p.estado ,g.nombre as genero, d.nombre as nombre_director, d.apellido as apellido_director FROM peliculas as p INNER JOIN generos as g ON p.genero_id = g.id_genero INNER JOIN directores as d ON p.director_id = d.id_director WHERE p.estado = 1";
  try {
	  $peliculas_query = $pdo->query($sql_peliculas);
		$peliculas = $peliculas_query->fetchAll();
  } catch (PDOException $e){
		echo "Error al obtener datos: ".$e->getMessage();
  }
	?>
	
	<section class="my-5">
		<?php if(count($peliculas) == 0 ) : ?>
      <h3 class="text-center fs-4">Contenido no disponible por el momento</h3>
			<?php else: ?>
			<section class="container">
				<h1 class="text-center">Tendencias</h1>
				<div class="d-flex flex-wrap justify-content-md-start justify-content-center align-items-center mt-5 gap-5">
					<?php foreach ($peliculas as $pelicula): ?>
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
									<p>Director: <?php echo $pelicula['nombre_director'].' '.$pelicula['apellido_director'] ?></p>
								</div>
							</div>
					<?php endforeach; ?>
				</div>
			</section>
		<?php endif; ?>
	</section>
	
<?php include './partials/footer.php'  ?>