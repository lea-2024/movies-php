<?php
  require './database/connection.php';
  if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['_method'] == 'DELETE'){
    $id = $_POST['id'];
    
    // consulta para obtener la imágen asociada para eliminarla al borrar un registro
    $sql_get = "SELECT imagen FROM peliculas WHERE id_pelicula = :id";
    $query_get = $pdo->prepare($sql_get);
    $query_get->bindParam('id', $id);
    
    try{
      $query_get->execute();
      $imagen_pelicula = $query_get->fetch();
    } catch (PDOException $e){
      echo "Error al obtener datos de la imágen: ".$e->getMessage();
    }
    
    // Borramos la imágen asociada
    unlink('./uploads/image/'.$imagen_pelicula['imagen']);
    
    //eliminamos la pelicula según su ID
    $sql_del = "DELETE FROM peliculas WHERE id_pelicula = :id";
    $query_del = $pdo->prepare($sql_del);
    $query_del->bindParam('id', $id);
    try {
      $query_del->execute();
      // Retornamos a la vista de administración con un mensaje
      session_start();
      $_SESSION['message'] = 'Se eliminó la pelicula';
      header('Location:administracion.php');
    } catch (PDOException $e){
      echo "Error al obtener la pelicula: ".$e->getMessage();
    }
  }

