<?php
	require './database/connection.php';
	
	$sql_peliculas = "SELECT p.id_pelicula, p.nombre, p.descripcion, p.anio, p.calificacion, p.estado ,g.nombre as genero, d.nombre as nombre_director, d.apellido as apellido_director FROM peliculas as p INNER JOIN generos as g ON p.genero_id = g.id_genero INNER JOIN directores as d ON p.director_id = d.id_director";
	
  try {
		$peliculas_query = $pdo->query($sql_peliculas);
		$peliculas = $peliculas_query->fetchAll();
  } catch (PDOException $e){
		echo "Error al obtener las peliculas: ".$e->getMessage();
  }
	
	$title = 'Admin';
	include './partials/header.php'; //Incluir header
?>

<script>
    const changeStatus = (id) => {
        let inputCheck = document.getElementById(`estado${id}`);
        let index = inputCheck.getAttribute('data-index');
        let estado = inputCheck.checked ? 1 : 0;
        const params = new URLSearchParams();
        params.append('estado', estado);
        params.append('id', id);

        fetch('update_status.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: params.toString(),
        })
            .then(result => result.text())
            .then(data => console.log(data))
            .catch(error => console.log('Error al actualizar estado: ', error));
    };
</script>


<section>
	<div class="d-flex align-items-center justify-content-between">
		<h2>Administración de peliculas</h2>
		<a href="./ingreso.php" class="link_movie-add"><i class="fa-regular fa-file"></i>Agregar</a>
	</div>
	<section class="mt-5">
	<?php if(count($peliculas) == 0) : ?>
		<h3 class="fs-5 text-center">No hay ninguna pelicula en el sistema</h3>
		<?php else: ?>
		<div class="row">
			<div class="col">
				<div class="table-responsive">
					<table class="table table-dark table-hover table-bordered">
						<thead>
							<tr class="text-center">
								<th style="background-color:#a94455">COD</th>
								<th style="background-color:#a94455">Nombre</th>
								<th style="background-color:#a94455">Descripción</th>
								<th style="background-color:#a94455">Género</th>
								<th style="background-color:#a94455">Calificación</th>
								<th style="background-color:#a94455">Año</th>
								<th style="background-color:#a94455">Director</th>
								<th style="background-color:#a94455">Activo</th>
								<th style="background-color:#a94455">Acciones</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($peliculas as $pelicula) : ?>
						<tr>
							<td class="text-center align-middle min-h-100" style="height:3rem"><?php echo $pelicula['id_pelicula'] ?></td>
							<td class="align-middle"><?php echo $pelicula['nombre'] ?></td>
							<td class="align-middle"><?php echo $pelicula['descripcion'] ?></td>
							<td class="align-middle"><?php echo $pelicula['genero']?></td>
							<td class="text-center align-middle"><?php echo $pelicula['calificacion']?></td>
							<td class="text-center align-middle"><?php echo $pelicula['anio']?></td>
							<td class="align-middle"><?php echo $pelicula['nombre_director'].' '.$pelicula['apellido_director']?></td>
							<td class="text-center align-middle"><input type="checkbox" id="estado<?php echo $pelicula['id_pelicula']?>" onchange="changeStatus(<?php echo $pelicula['id_pelicula']?>)" name="estado" <?php echo $pelicula['estado'] == 1 ? 'checked' : '' ?> class="input-check"></td>
							<td class="align-middle">
								<div class="d-flex justify-content-center align-items-center gap-3">
									<a role="button" data-bs-toggle="modal" data-bs-target="#pelicula<?php echo $pelicula['id_pelicula'] ?>"><i class="fa-regular fa-eye bg-none text-light text-hover" title="Vista Previa"></i></a>
									<a href="./update_form.php?i=<?php echo $indice?>"><i class="fa-regular fa-pen-to-square text-pink text-hover" title="Editar"></i></a>
									<form action="./delete_movie.php" method="POST">
										<input type="hidden" name="indice" value="<?php echo $indice?>">
										<button type="submit" class="link-delete text-hover"><i class="fa-regular fa-trash-can text-danger text-hover" title="Eliminar"></i></button>
									</form>
								</div>
							</td>
						</tr>
							
							
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
							
						<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		
		<!-- Cargar script para manipular el estado 		-->
<!--		<script src="./main.js"></script>-->
		
	<?php endif ?>
	</section>
</section>

<!--	Incluir footer-->
<?php include './partials/footer.php'; ?>



