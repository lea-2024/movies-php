<?php
	require './database/connection.php';
	
	$sql_peliculas = "SELECT p.id_pelicula, p.imagen, p.nombre, p.descripcion, p.anio, p.calificacion, p.estado ,g.nombre as genero, d.nombre as nombre_director, d.apellido as apellido_director FROM peliculas as p INNER JOIN generos as g ON p.genero_id = g.id_genero INNER JOIN directores as d ON p.director_id = d.id_director";
	
  try {
		$peliculas_query = $pdo->query($sql_peliculas);
		$peliculas = $peliculas_query->fetchAll();
  } catch (PDOException $e){
		echo "Error al obtener las peliculas: ".$e->getMessage();
  }
  
	session_start();
  
	if(isset($_SESSION['message'])){
		$active = 'true';
		$message = $_SESSION['message'];
	} else{
    $active = 'false';
	}
	
  unset($_SESSION['message']);
	
	$title = 'Admin';
	include './partials/header.php'; //Incluir header
?>

<!-- Contenido principal de administracion / Tabla con datos ingresados-->
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
					<table class="table table-dark table-hover table-bordered my-4" id="myTable">
						<thead>
							<tr class="text-center">
								<th style="background-color:#00000025">COD</th>
								<th style="background-color:#00000025">Imágen</th>
								<th style="background-color:#00000025">Nombre</th>
								<th style="background-color:#00000025">Descripción</th>
								<th style="background-color:#00000025">Género</th>
								<th style="background-color:#00000025">Calificación</th>
								<th style="background-color:#00000025">Año</th>
								<th style="background-color:#00000025">Director</th>
								<th style="background-color:#00000025">Activo</th>
								<th style="background-color:#00000025">Acciones</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($peliculas as $pelicula) : ?>
						<tr>
							<td class="text-center align-middle"><?php echo $pelicula['id_pelicula'] ?></td>
							<td class="text-center align-middle table-image"><img data-bs-toggle="modal" data-bs-target="#imagen<?php echo $pelicula['id_pelicula']?>" src="<?php echo isset($pelicula['imagen']) && file_exists('./uploads/image/'.$pelicula['imagen']) ? './uploads/image/'.$pelicula['imagen'] : './assets/img/no-disponible.jpg';?>" alt="<?php echo $pelicula['nombre']?>" class="table-image"></td>
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
									<a href="./update_form.php?id=<?php echo $pelicula['id_pelicula']?>"><i class="fa-regular fa-pen-to-square text-pink text-hover" title="Editar"></i></a>
									<form action="./delete_movie.php" method="POST" id="formDelete<?php echo $pelicula['id_pelicula']?>">
										<input type="hidden" name="id" value="<?php echo $pelicula['id_pelicula']?>">
										<input type="hidden" name="_method" value="DELETE">
										<button type="button" onclick="confirmDelete(<?php echo $pelicula['id_pelicula']?>)" class="link-delete text-hover"><i class="fa-regular fa-trash-can text-danger text-hover" title="Eliminar"></i></button>
									</form>
								</div>
							</td>
						</tr>
							
							<!-- archivo para mostrar el modal de imágen ampliada -->
							<?php include 'modal_image_preview.php'?>
							
						<!-- archivo para mostrar el modal de vista previa-->
						<?php  include './modal-preview.php'?>
							
						<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		
		<div id="message" data-active="<?php echo $active?>" data-message="<?php echo $message?>"></div>
		
	<?php endif ?>
	</section>
</section>

<!--	Incluir footer-->
<?php include './partials/footer.php'; ?>



