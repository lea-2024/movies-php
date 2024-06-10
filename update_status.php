<?php
  $cookie_duration = 365 * 24 * 60 * 60;
  session_set_cookie_params($cookie_duration);
  session_start();
  if(isset($_SESSION['peliculas'])){
    $peliculas = $_SESSION['peliculas'];
  }
  
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $status = $_POST['status'];
    $indice = $_POST['indice'];
    
    $peliculas[$indice]['status'] = intval($status);
    
    $_SESSION['peliculas'] = $peliculas;
  }