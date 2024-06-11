<?php
  require './vendor/autoload.php';
  
  use Dotenv\Dotenv;
  $dotenv = Dotenv::createImmutable('./');
  $dotenv->load();
  
  $dbHost = $_ENV['DB_HOST'];
  $dbUsername = $_ENV['DB_USERNAME'];
  $dbPassword = $_ENV['DB_PASSWORD'];
  $dbPort = $_ENV['DB_PORT'];
  $dbName = $_ENV['DB_DBNAME'];
  
  $dsn = "mysql:host=$dbHost;dbname=$dbName;port=$dbPort;charset=utf8mb4";
  $options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
  ];
  
  // Conexión a base de datos
  try {
    $pdo = new PDO($dsn, $dbUsername, $dbPassword, $options);
  } catch (PDOException $e){
    echo "Error en la conexión a la base de datos: ". $e->getMessage();
  }
  
