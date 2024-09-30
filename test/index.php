<?php
require '../vendor/autoload.php';

use Emiherber\LambdasiLogs\Logger;
use Emiherber\LambdasiLogs\LogLevel;
use Symfony\Component\Dotenv\Dotenv;

define('__DR__', $_SERVER['DOCUMENT_ROOT'].'/');

$dotenv = new Dotenv();
$dotenv->load('.env');

try {
  test();
  echo 'log generado <br>';

} catch (\Throwable $th) {
  echo 'error al generar el log <br>';
  throw $th;
}

function test() {
  try {

    $valores = [
      'clave' => 'valor',
      'clave2' => 'valor2'
    ];

    throw new Exception('prueba2');

  } catch (\Throwable $th) {
    $log = new Logger();
    $log->log(LogLevel::DEBUG,'test', compact('th'));
    $log->log(LogLevel::ERROR,'test', ['th' => new Error('Error')]);
    $log->log(LogLevel::WARNING,$th->getMessage(), ['th' => new Exception('Exception')]);
    $log->alert($th->getMessage());
  }
}