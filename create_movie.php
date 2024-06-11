<?php
  require './database/connection.php';
  
  if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    // Obtener la fecha y hora a traves del navegador
    $zona = date_default_timezone_get();
    date_default_timezone_set($zona);
//    ************************************
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $genero_id = $_POST['genero_id'];
    $anio = $_POST['anio'];
    $calificacion = $_POST['calificacion'];
    $director_id = $_POST['director_id'];
    $created_at = date('Y-m-d H:i:s', time());
    $updated_at = date('Y-m-d H:i:s', time());
    $estado = 1;
    
    $sql ="INSERT INTO peliculas (nombre, descripcion, genero_id, anio, calificacion, director_id, estado, created_at, updated_at)
          VALUES (:nombre, :descripcion, :genero_id, :anio, :calificacion, :director_id, :estado, :created_at, :updated_at);";
    $sqlPrepare = $pdo->prepare($sql);
    $sqlPrepare->bindParam('nombre', $nombre);
    $sqlPrepare->bindParam('descripcion', $descripcion);
    $sqlPrepare->bindParam('genero_id', $genero_id);
    $sqlPrepare->bindParam('anio', $anio);
    $sqlPrepare->bindParam('calificacion', $calificacion);
    $sqlPrepare->bindParam('director_id', $director_id);
    $sqlPrepare->bindParam('estado', $estado);
    $sqlPrepare->bindParam('created_at', $created_at);
    $sqlPrepare->bindParam('updated_at', $updated_at);
    
    try {
      $sqlPrepare->execute();
      header('Location:administracion.php');
    } catch (PDOException $e){
      echo $e->getCode();
      echo "Error al guardar los datos en la base de datos: ". $e->getMessage();
    }
  }
