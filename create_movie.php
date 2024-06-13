<?php
  require './database/connection.php';
  
  if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    // Obtener la fecha y hora a traves del navegador
    $zona = date_default_timezone_get();
    date_default_timezone_set($zona);
//    ************************************
    
    
//    var_dump($_FILES['image']['name']);
    if(!empty($_FILES['image']['name'])){
      $pathImage = pathinfo($_FILES['image']['name']);
      $pathThemp = $_FILES['image']['tmp_name'];
      $image_name = time().'.'.$pathImage['extension'];
      $path_upload_image = './uploads/image/'.$image_name;
    }
    
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $genero_id = $_POST['genero_id'];
    $anio = $_POST['anio'];
    $calificacion = $_POST['calificacion'];
    $director_id = $_POST['director_id'];
    $created_at = date('Y-m-d H:i:s', time());
    $updated_at = date('Y-m-d H:i:s', time());
    $estado = 1;
    
    $sql ="INSERT INTO peliculas (nombre, descripcion, genero_id, anio, calificacion, director_id, imagen, estado, created_at, updated_at)
          VALUES (:nombre, :descripcion, :genero_id, :anio, :calificacion, :director_id, :imagen, :estado, :created_at, :updated_at);";
    $sqlPrepare = $pdo->prepare($sql);
    $sqlPrepare->bindParam('nombre', $nombre);
    $sqlPrepare->bindParam('descripcion', $descripcion);
    $sqlPrepare->bindParam('genero_id', $genero_id);
    $sqlPrepare->bindParam('anio', $anio);
    $sqlPrepare->bindParam('calificacion', $calificacion);
    $sqlPrepare->bindParam('director_id', $director_id);
    $sqlPrepare->bindParam('imagen', $image_name);
    $sqlPrepare->bindParam('estado', $estado);
    $sqlPrepare->bindParam('created_at', $created_at);
    $sqlPrepare->bindParam('updated_at', $updated_at);
    try {
      $sqlPrepare->execute();
      move_uploaded_file($pathThemp, $path_upload_image);
      session_start();
      $_SESSION['message'] = 'Película creada correctamente';
      header('Location:administracion.php');
    } catch (PDOException $e){
      echo $e->getCode();
      echo "Error al guardar los datos en la base de datos: ". $e->getMessage();
    }
  }
