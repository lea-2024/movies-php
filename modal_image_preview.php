<!-- Modal - Vista previa de card-->
<div class="modal fade modal-preview" id="imagen<?php echo $pelicula['id_pelicula'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content bg-dark">
      <div class="modal-header text-pink" style="background-color: #a94455;">
<!--        <h1 class="modal-title fs-5" id="exampleModalLabel">Vista Previa</h1>-->
        <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0 object-fit-cover">
        <!-- Card de la pelicula -->
        <img src="<?php echo $pelicula['imagen'] ? './uploads/image/'.$pelicula['imagen'] : './assets/img/no-disponible.jpg' ?>" alt="<?php echo $pelicula['nombre']?>" class="object-fit-cover w-100">
      </div>
    </div>
  </div>
</div>