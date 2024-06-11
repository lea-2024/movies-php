<?php
  global $pdo;
  require './database/connection.php';
  
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $estado = intval($_POST['estado']);
    $id = intval($_POST['id']);
    
    try{
      $sql_update_estado = $pdo->prepare("UPDATE peliculas SET estado = :estado WHERE id_pelicula = :id");
      $sql_update_estado->bindParam('estado',$estado);
      $sql_update_estado->bindParam('id',$id);
      $sql_update_estado->execute();
    } catch (PDOException $e){
      echo "Error al actualizar el estado: ".$e->getMessage();
    }
  }