<?php

global $pdo;
$id =  $_GET['id'];

include './partials/header.php';

require './database/connection.php';

// Traemos el dato de la pelicula a modificar
try {
	$sql_pelicula = "SELECT * from peliculas WHERE id_pelicula = :id";
	$query_pelicula = $pdo->prepare($sql_pelicula);
	$query_pelicula->bindParam('id', $id);
	$query_pelicula->execute();
	$pelicula = $query_pelicula->fetch();
} catch (PDOException $e) {
	echo "Error al obtener datos de la pelicula: " . $e->getMessage();
}

//Traemos todos los generos de la DB
try {
	$sql_genero = "SELECT * FROM generos";
	$query_genero = $pdo->query($sql_genero);
	$generos = $query_genero->fetchAll();
} catch (PDOException $e) {
	echo "Error al obtener los generos: " . $e->getMessage();
}

//Traemos los directores de la DB
try {
	$sql_directores = "SELECT * FROM directores";
	$query_directores = $pdo->query($sql_directores);
	$query_directores->execute();
	$directores = $query_directores->fetchAll();
} catch (PDOException $e){
	echo "Error al obtener los directores: " . $e->getMessage();
}
?>

<section>
	<div class="d-flex align-items-center justify-content-between">
		<h2>Editar Pelicula</h2>
		<a href="./administracion.php" class="link_movie-add"><i class="fa-solid fa-caret-left"></i>Volver</a>
	</div>
	<div class="row mt-3">
		<div class="col-md-6 offset-md-3">
			<form action="./update_movie.php" method="POST" enctype="multipart/form-data">
				<div class="col mb-3">
					<label for="nombre" class="text-secondary mb-1">Nombre</label>
					<input type="text" name="nombre" id="nombre" class="form-inputs form-control focus-ring" value="<?php echo $pelicula['nombre'] ?>">
				</div>
				<div class="col mb-3">
					<label for="descripcion" class="text-secondary mb-1">Descripción</label>
					<textarea name="descripcion" id="descripcion" cols="30" rows="3" class="form-inputs form-control focus-ring"><?php echo $pelicula['descripcion'] ?></textarea>
				</div>
				<div class="col mb-3">
					<label for="genero" class="text-secondary mb-1">Género</label>
					<select name="genero_id" id="genero" class="form-inputs form-select focus-ring select">
						<option value="" selected disabled>Seleccione una opción</option>
						<?php foreach ($generos as $genero) : ?>
							<option value="<?php echo $genero['id_genero'] ?>" <?php echo $pelicula['genero_id'] == $genero['id_genero'] ? 'selected' : '' ?>>
								<?php echo $genero['nombre'] ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="row mb-3">
					<div class="col col-md-6">
						<label for="anio" class="text-secondary mb-1">Año</label>
						<input name="anio" type="number" id="anio" min="0" minlength="4" class="form-inputs form-control focus-ring" value="<?php echo $pelicula['anio']?>">
					</div>
					<div class="col col-md-6">
						<label for="calificacion" class="text-secondary mb-1">Calificación</label>
						<select name="calificacion" id="calificacion" class="form-inputs form-select focus-ring select">
							<option value="" disabled>Seleccione una opción</option>
							<?php for($i=1; $i<=5; $i++):?>
							<option value="<?php echo $i?>" <?php echo $pelicula['calificacion'] == $i ? 'selected': ''?>><?php echo $i?></option>
							<?php endfor ?>
						</select>
					</div>
				</div>
				<div class="row align-items-center mb-5">
					<div class="col-md-6">
						<label for="director" class="text-secondary mb-1">Director</label>
						<select name="director_id" id="director" class="form-inputs form-select focus-ring select">
							<option value="" disabled>Seleccione una opción</option>
							<?php foreach ($directores as $director) : ?>
								<option value="<?php echo $director['id_director']?>" <?php echo $pelicula['director_id'] == $director['id_director'] ? 'selected' : ''?>>
									<?php echo $director['nombre'] . ' ' . $director['apellido'] ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="col-md-6">
						<label for="image" class="btn-imagen"><i class="fa-regular fa-image me-2"></i>Subir imágen</label>
						<input type="file" name="image" id="image" class="d-none" accept="image/jpg, image/jpeg, image/png, image/svg">
					</div>
				</div>
				<div id="imagePreview" class="col">
					<?php if(isset($pelicula['imagen']) && file_exists('./uploads/image/'.$pelicula['imagen'])): ?>
					<img src="<?php echo './uploads/image/'.$pelicula['imagen']?>" alt="<?php echo $pelicula['nombre']?>" class="image-preview">
					<?php endif; ?>
				</div>
				<input type="hidden" name="id" value="<?php echo $pelicula['id_pelicula'] ?>">
				<input type="hidden" name="_method" value="PUT">
				<input type="submit" value="Actualizar" class="link_movie-add mb-5 border-0 w-100 justify-content-center">
			</form>
		</div>
	</div>
</section>

<?php include './partials/footer.php' ?>