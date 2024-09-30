<?php

namespace Emiherber\LambdasiLogs;

use InvalidArgumentException;
use ReflectionClass;

class Logger extends AbstractLogger
{
  /**
   * Logs with an arbitrary level.
   *
   * @param string $level
   * @param string $message
   * @param array $context
   * @return void
   */
  function log(string $level, string $message, array $context = [])
  {
    $object = new ReflectionClass(LogLevel::class);

    if (!in_array($level, $object->getConstants())) {
      throw new InvalidArgumentException('Level no valido', 500);
    }

    if (!is_dir(__DR__ . "lamlogs")) {
      mkdir(__DR__ . "lamlogs");
    }

    $file = fopen(__DR__ . "lamlogs/" . $level .'-'. date("Ymd") . ".log", "a");

    //Contenido del archivo
    fputs($file, $message . "\r\n");
    fputs($file, "Fecha y hora:" . date('d/m/Y H:i:s') . "\r\n");

    if (count($context) > 0) {
      ob_start();
      var_dump($context);
      fputs($file, "Context:" . ob_get_contents() . "\r\n");
      ob_end_clean();
    }

    fclose($file);
  }
}
