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
	
	<div class="row mt-3">
		<div class="col-md-6 offset-md-3">
			<form action="./create_movie.php" method="POST" enctype="multipart/form-data">
				<div class="col mb-3">
					<label for="nombre" class="text-secondary mb-1">Nombre</label>
					<input type="text" name="nombre" id="nombre" class="form-inputs form-control focus-ring">
				</div>
				<div class="col mb-3">
					<label for="descripcion" class="text-secondary mb-1">Descripción</label>
					<textarea name="descripcion" id="descripcion" cols="30" rows="3" class="form-inputs form-control focus-ring"></textarea>
				</div>
				<div class="col mb-3">
					<label for="genero" class="text-secondary mb-1">Género</label>
					<select name="genero_id" id="genero" class="form-inputs form-select focus-ring select">
						<option value="" selected disabled>Selecione una opción</option>
            <?php foreach ($generos as $genero) : ?>
							<option value="<?php echo $genero['id_genero'] ?>">
                <?php echo $genero['nombre'] ?></option>
            <?php endforeach; ?>
					</select>
				</div>
				<div class="row mb-3">
					<div class="col col-md-6">
						<label for="anio" class="text-secondary mb-1">Año</label>
						<input name="anio" type="number" id="anio" min="0" minlength="4" class="form-inputs form-control focus-ring">
					</div>
					<div class="col col-md-6">
						<label for="calificacion" class="text-secondary mb-1">Calificación</label>
						<select name="calificacion" id="calificacion" class="form-inputs form-select focus-ring select">
							<option value="" selected disabled>Seleccione una opción</option>
              <?php for($i=1; $i<=5; $i++):?>
								<option value="<?php echo $i?>"><?php echo $i?></option>
              <?php endfor ?>
						</select>
					</div>
				</div>
				<div class="row align-items-center mb-5">
					<div class="col-md-6">
						<label for="director" class="text-secondary mb-1">Director</label>
						<select name="director_id" id="director" class="form-inputs form-select focus-ring select">
							<option value="" class="text-secondary" selected disabled>Seleccione una opción</option>
	            <?php foreach ($directores as $director) : ?>
								<option value="<?php echo $director['id_director']?>">
	                <?php echo $director['nombre'] . ' ' . $director['apellido'] ?></option>
	            <?php endforeach; ?>
						</select>
					</div>
					<div class="col-md-6">
						<label for="image" class="btn-imagen"><i class="fa-regular fa-image me-2"></i>Subir imágen</label>
						<input type="file" name="image" id="image" class="d-none" accept="image/jpg, image/jpeg, image/png, image/svg">
					</div>
				</div>
				<div id="imagePreview" class="col"></div>
				<input type="submit" value="Guardar" class="link_movie-add mb-5 border-0 w-100 justify-content-center">
			</form>
		</div>
	</div>
</section>


<?php include './partials/footer.php' ?>