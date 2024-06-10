<?php
  session_start();
  
  if(isset($_SESSION['peliculas'])){
    $peliculas = $_SESSION['peliculas'];
  }
  
  $i =  $_GET['i'];
  
  $pelicula = $peliculas[$i];
  
//  print_r($pelicula);
  include './partials/header.php';
  ?>

<section>
  <div class="d-flex align-items-center justify-content-between">
    <h2>Editar Pelicula</h2>
    <a href="./administracion.php" class="link_movie-add"><i class="fa-solid fa-caret-left"></i>Volver</a>
  </div>
  
  <div class="row mt-5">
    <div class="col-md-6 offset-md-3">
      <form action="./update_movie.php" method="POST">
        <div class="col mb-4">
          <input type="text" name="nombre" placeholder="Nombre" class="form-inputs form-control focus-ring" value="<?php echo $pelicula['nombre']?>">
        </div>
        <div class="col mb-4">
          <textarea name="descripcion" cols="30" rows="3" placeholder="Descripción" class="form-inputs form-control focus-ring"><?php echo $pelicula['descripcion']?></textarea>
        </div>
        <div class="col mb-4">
          <input name="genero" type="text" placeholder="Género" class="form-inputs form-control focus-ring" value="<?php echo $pelicula['genero']?>">
        </div>
        <div class="row mb-4">
          <div class="col col-md-6">
            <input name="anio" type="number" placeholder="Año de estreno" min="0" minlength="4" class="form-inputs form-control focus-ring" value="<?php echo $pelicula['anio']?>">
          </div>
          <div class="col col-md-6">
            <input name="calificacion" type="number" min="1" max="5" placeholder="Calificación (1 al 5)" class="form-inputs form-control focus-ring" value="<?php echo $pelicula['calificacion']?>">
          </div>
        </div>
        <div class="col mb-4">
          <input name="director" type="text" placeholder="Director" class="form-inputs form-control focus-ring" value="<?php echo $pelicula['director']?>">
        </div>
	      <input type="hidden" name="indice" value="<?php echo $i ?>">
	      <input type="hidden" name="status" value="<?php echo $pelicula['status']?>">
        <input type="submit" value="Actualizar" class="link_movie-add mb-5 border-0 w-100 justify-content-center">
      </form>
    </div>
  </div>
</section>
  
<?php include './partials/footer.php'?>