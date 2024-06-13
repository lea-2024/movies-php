<?php
require './database/connection.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['_method'] == 'PUT') {
  
  $nombre = $_POST['nombre'];
  $descripcion = $_POST['descripcion'];
  $genero_id = $_POST['genero_id'];
  $calificacion = $_POST['calificacion'];
  $anio = $_POST['anio'];
  $director_id = $_POST['director_id'];
  $id = $_POST['id'];
  $updated_at = date('Y-m-d H:i:s', time());

  // Tramos los datos de la pelicula a actualizar
  try {
    $sql_get = "SELECT * FROM peliculas WHERE id_pelicula = :id";
    $query_get = $pdo->prepare($sql_get);
    $query_get->bindParam('id', $id);
    $query_get->execute();
    $pelicula = $query_get->fetch();
  } catch (PDOException $e) {
    echo "Error al obtener datos de pelicula: " . $e->getMessage();
  }
  if (!empty($_FILES['image']['name'])){
    $pathTemporal = $_FILES['image']['tmp_name'];
    $image = pathinfo($_FILES['image']['name']);
    $extension = $image['extension'];
    $image_name = time().'.'.$extension;
    $pathImage = './uploads/image/'.$image_name;
    if(isset($pelicula['imagen']) && file_exists('./uploads/image/'.$pelicula['imagen'])){
      unlink('./uploads/image/'.$pelicula['imagen']);
    }
  } else{
    $image_name = $pelicula['imagen'];
  }
  
  // Actualizar datos en la DB
    $sql_update = "UPDATE peliculas SET nombre = :nombre ,descripcion = :descripcion, genero_id = :genero_id, anio = :anio,
                     calificacion = :calificacion, director_id = :director_id, imagen = :imagen, estado = :estado, created_at = :created_at,
                     updated_at = :updated_at WHERE id_pelicula = :id";
    $query_update = $pdo->prepare($sql_update);
    $query_update->bindParam('id', $id);
    $query_update->bindParam('nombre', $nombre);
    $query_update->bindParam('descripcion', $descripcion);
    $query_update->bindParam('genero_id', $genero_id);
    $query_update->bindParam('anio', $anio);
    $query_update->bindParam('calificacion', $calificacion);
    $query_update->bindParam('director_id', $director_id);
    $query_update->bindParam('imagen', $image_name);
    $query_update->bindParam('estado', $pelicula['estado']);
    $query_update->bindParam('created_at', $pelicula['created_at']);
    $query_update->bindParam('updated_at', $updated_at);
  try {
    $query_update->execute();
    move_uploaded_file($pathTemporal, $pathImage);
    session_start();
    $_SESSION['message'] = 'Película actualizada correctamente';
    header('Location:administracion.php');
  } catch (PDOException $e){
    echo "Error al actualizar los datos: " . $e->getMessage();
  }
}