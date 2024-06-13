
<!-- Modal - Vista previa de card-->
<div class="modal fade modal-preview" id="pelicula<?php echo $pelicula['id_pelicula'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-dark">
      <div class="modal-header text-pink" style="background-color: #a94455;">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Vista Previa</h1>
        <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body m-auto">
        <!-- Card de la pelicula -->
        <div class="card bg-card" style="width:18rem;border:2px solid #9f3647;">
          <img src="./assets/img/cinema.jpg" class="card-img-top" alt="imagen pelicula">
          <div class="card-body">
            <h5 class="card-title"><?php echo $pelicula['nombre'] ?></h5>
            <p class="card-text"><?php echo $pelicula['descripcion'] ?></p>
            <p class="card-text"><?php echo str_repeat('⭐', intval($pelicula['calificacion'])) ?> </p>
            <p class="card-text">Género: <?php echo $pelicula['genero']?></p>
            <p>Año: <?php echo $pelicula['anio']?></p>
            <p>Director: <?php echo $pelicula['nombre_director'].' '.$pelicula['apellido_director']?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
