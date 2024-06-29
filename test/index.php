<?php

use Emiherber\LambdasiLogs\ErrorLog;
require '../vendor/autoload.php';

define('__DR__', $_SERVER['DOCUMENT_ROOT'].'/');

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
    ErrorLog::log('Throwable', $th->getMessage(), $valores, $th);
    ErrorLog::log('Exception', $th->getMessage(), $valores, new Exception('Exception'));
    ErrorLog::log('Error', $th->getMessage(), $valores, new Error('Error'));
  }
}