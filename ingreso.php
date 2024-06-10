<?php
  $title = 'Ingreso';
  include './partials/header.php';
	
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
					<input name="genero" type="text" placeholder="Género" class="form-inputs form-control focus-ring">
				</div>
				<div class="row mb-4">
					<div class="col col-md-6">
						<input name="anio" type="number" placeholder="Año de estreno" min="0" minlength="4" class="form-inputs form-control focus-ring">
					</div>
					<div class="col col-md-6">
						<input name="calificacion" type="number" min="1" max="5" placeholder="Calificación (1 al 5)" class="form-inputs form-control focus-ring">
					</div>
				</div>
				<div class="col mb-4">
					<input name="director" type="text" placeholder="Director" class="form-inputs form-control focus-ring">
				</div>
				<input type="submit" value="Guardar" class="link_movie-add mb-5 border-0 w-100 justify-content-center">
			</form>
		</div>
	</div>
</section>


<?php include './partials/footer.php' ?>