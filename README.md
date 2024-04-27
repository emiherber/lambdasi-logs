# lambdasi-logs
Permite generar archivos logs de nuestra aplicación

## Instalación
```bash
composer require emiherber/lambdasi-logs
```

## Requerimientos
- PHP >= 7.0
- Se debe declara la siguiente constante **\_\_DR__** que indica donde se creara la carpeta **lamlogs**.

## Uso
ErrorLog::log($nombreArchivo, $texto, $valores, $exception);

- $nombreArchivo: 
  - Obligatorio
  - Indica con que nombre se guardara el log. A este nombre se le adhiere como sufijo la fecha y hora.
- $texto:
  - Obligatorio
  - Descripción adicional referencia al archivo o función donde se genero.
- $valores:
  - Opcional
  - Se puede pasar un array con los parametros que generaron el log.
- $exception:
  - Opcional
  - Se puede pasar una excepción con la se genero el log.

```PHP
require __DIR__.'/vendor/autoload.php';
use Emiherber\LambdasiLogs\ErrorLog;

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

```

### Ubicación Log
Los logs se guardan en la carpeta **lamlogs**.
```bash
├── proyecto
│   ├── lamlogs
```

### Licencia:

Esta librería se distribuye bajo la licencia The Unlicense. Puedes encontrar el texto completo de la licencia en el archivo LICENSE.

### Autores
[Emiliano Herber](https://github.com/emiherber)