<?php
  $title = 'Ingreso';
  include './partials/header.php';
	require './database/connection.php';
 
//	Traemos los generos disponibles en la DB para mostrar en el select
  try {
	  $sql_generos = "SELECT * FROM generos";
		$sql_query = $pdo->query($sql_generos);
		$generos = $sql_query->fetchAll();
  } catch (PDOException $e){
		echo "Error al obtener los generos: ". $e->getMessage();
  }
	// Traemos todos los directores disponibles en la DB para mostrar en directores
  try {
	  $sql_directores = "SELECT id_director, nombre, apellido FROM directores";
		$sql_query_directores = $pdo->query($sql_directores);
		$directores = $sql_query_directores->fetchAll();
  } catch (PDOException $e){
		echo "Error al obtener los directores: ".$e->getMessage();
  }
?>
<section>
	<div class="d-flex align-items-center justify-content-between">
	  <h2>Nueva Pelicula</h2>
		<a href="./administracion.php" class="link_movie-add"><i class="fa-solid fa-caret-left"></i>Volver</a>
	</div>
	
	<div class="row mt-5">
		<div class="col-md-6 offset-md-3">
			<form action="./create_movie.php" method="POST">
				<div class="col mb-4">
					<input type="text" name="nombre" placeholder="Nombre" class="form-inputs form-control focus-ring">
				</div>
				<div class="col mb-4">
					<textarea name="descripcion" cols="30" rows="3" placeholder="Descripción" class="form-inputs form-control focus-ring"></textarea>
				</div>
				<div class="col mb-4">
					<select name="genero_id" class="form-inputs form-select focus-ring select">
						<option value="" selected disabled>Genéro</option>
						<?php foreach ($generos as $genero): ?>
							<option value="<?php echo $genero['id_genero']?>"><?php echo $genero['nombre']?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="row mb-4">
					<div class="col col-md-6">
						<input name="anio" type="number" placeholder="Año de estreno" min="0" minlength="4" class="form-inputs form-control focus-ring">
					</div>
					<div class="col col-md-6">
						<select name="calificacion" class="form-inputs form-select focus-ring select">
							<option value="" selected disabled>Calificación</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
						</select>
					</div>
				</div>
				<div class="col mb-4">
					<select name="director_id" class="form-inputs form-select focus-ring select">
						<option value="" selected disabled>Director</option>
						<?php foreach ($directores as $director):?>
							<option value="<?php echo $director['id_director']?>"><?php echo $director['nombre'].' '.$director['apellido'] ?></option>
						<?php endforeach;?>
					</select>
				</div>
				<input type="submit" value="Guardar" class="link_movie-add mb-5 border-0 w-100 justify-content-center">
			</form>
		</div>
	</div>
</section>


<?php include './partials/footer.php' ?>