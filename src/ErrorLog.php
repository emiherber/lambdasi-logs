<?php

namespace Emiherber\LambdasiLogs;
use Error;
use Exception;
use Throwable;

abstract class ErrorLog
{
  /**
   * Registra un mensaje de error junto con valores opcionales y detalles de la excepción en un archivo.
   *
   * @param string $nombreArchivo El nombre del archivo de registro.
   * @param string $texto El mensaje de error que se va a registrar.
   * @param array $valores Array opcional de valores que se van a registrar.
   * @param Throwable|null $throwable Objeto de excepción opcional que se va a registrar.
   * @throws None
   * @return void
   */
  static function log(string $nombreArchivo, string $texto, array $valores = [], Throwable $throwable = null)
  {
    // var_dump(is_dir(__DR__ . "lamlogs"));
    // die(__DR__ . "lamlogs");
    if (!is_dir(__DR__ . "lamlogs")) {
      mkdir(__DR__ . "lamlogs");
    }

    $file = fopen(__DR__ . "lamlogs/" . $nombreArchivo . date("YmdHis") . ".log", "a");

    //Contenido del archivo
    fputs($file, "Error: ");
    fputs($file, $texto . "\r\n");
    fputs($file, "Fecha y hora:" . date('d/m/Y H:i:s') . "\r\n");

    //Opcionales
    if (is_array($valores) && count($valores) > 0) {
      ob_start();
      var_dump($valores);
      fputs($file, "\r\nValores:" . ob_get_contents() . "\r\n");
      ob_end_clean();
    }

    if ($throwable instanceof Exception) {
      fputs($file, "\r\nException: (" . $throwable->getCode() . ") " . $throwable->getMessage() . "\r\ntrace:\r\n" . $throwable->getTraceAsString() . "\r\n");
    }

    if ($throwable instanceof Error) {
      fputs($file, "\r\nError: (" . $throwable->getCode() . ") " . $throwable->getMessage() . "\r\ntrace:\r\n" . $throwable->getTraceAsString() . "\r\n");
    }

    fclose($file);
  }
}
