<?php
  session_start();
  if(isset($_SESSION['peliculas'])){
    $peliculas = $_SESSION['peliculas'];
  }
  
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $genero = $_POST['genero'];
    $calificacion = $_POST['calificacion'];
    $anio = $_POST['anio'];
    $director = $_POST['director'];
    $indice = $_POST['indice'];
    $status = $_POST['status'];

    $pelicula_updated = [
      'nombre' => $nombre,
      'descripcion' => $descripcion,
      'genero' => $genero,
      'calificacion' => $calificacion,
      'anio' => $anio,
      'director' => $director,
      'status' => $status
    ];
    
    $peliculas[$indice] = $pelicula_updated;
    $_SESSION['peliculas'] = $peliculas;
    header('Location:administracion.php');
  }
