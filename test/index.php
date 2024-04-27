<?php

use Emiherber\LambdasiLogs\ErrorLog;
require '../vendor/autoload.php';

define('__DR__', $_SERVER['DOCUMENT_ROOT'].'/lambdasi-logs/');

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
  
    throw new Exception('prueba');
  
  } catch (\Throwable $th) {
    ErrorLog::log('prueba', $th->getMessage(), $valores, new Exception('prueba'));
  }
}