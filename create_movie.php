<?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $cookie_duration = 365 * 24 * 60 * 60;
    session_set_cookie_params($cookie_duration);
    session_start();
    if(isset($_SESSION['peliculas'])){
      $peliculas = $_SESSION['peliculas'];
    } else{
      $peliculas = [];
    }
    
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $genero = $_POST['genero'];
    $anio = $_POST['anio'];
    $calificacion = $_POST['calificacion'];
    $director = $_POST['director'];
    
    $pelicula = [
      "nombre" => $nombre,
      "descripcion" => $descripcion,
      "genero" => $genero,
      "anio" => $anio,
      "calificacion" => $calificacion,
      "director" => $director,
      "status" => 1,
    ];
    
    array_push($peliculas, $pelicula);
//    session_start();
    $_SESSION['peliculas'] = $peliculas;
    header('Location:administracion.php');
  }
