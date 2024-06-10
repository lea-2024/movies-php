<?php
  session_start();
  if(isset($_SESSION['peliculas'])){
    $peliculas = $_SESSION['peliculas'];
  }

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $indice = $_POST['indice'];
  
  // Eliminamos la pelicula según su indice
  unset($peliculas[$indice]);
  
  $_SESSION['peliculas'] = $peliculas; // Guardamos en la sesion el array de peliculas sin la pelicula eliminada
  
  if(count($peliculas) == 0){
    unset($_SESSION['peliculas']);
    setcookie(session_name(),'', time() - 4200, '/');
    session_destroy();
  }
  header('Location:administracion.php');
}
