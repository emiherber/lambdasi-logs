# lambdasi-logs
Permite generar archivos logs de nuestra aplicación.

## Instalación
```bash
composer require emiherber/lambdasi-logs
```

## Requerimientos
- PHP >= 8.2
- Se debe declara la siguiente constante **\_\_DR__** que indica donde se creara la carpeta **lamlogs**.

## Uso
$log = new Logger();
$log->log(string $level, string $message, array $context = []);

- $level:
  - Obligatorio
  - Indica indica el nivel de log que debe generar.
- $message:
  - Obligatorio
  - Descripción adicional referencia al archivo o función donde se genero.
- $context:
  - Opcional
  - Se puede pasar un array con los datos que produjo el log.

- Variable de entorno: para usar la función alert y notificar a un chat de telegram. Es necesario crear lo siguiente:
  - TOKEN: Token del bot con el cual se va a enviar la notificación.
  - CHATID: Este puede ser el id de un usuario, grupo o canal.
  - TITULOSISTEMA: Aplicación desde donde se genera la notificación. Ideal si el mismo bot se usa para varias aplicaciones.
En caso que no funcione algo se genera un archivo llamado un log del *tipo debug-Ymd.log*

## Opción 1:
```PHP
require __DIR__.'/vendor/autoload.php';
use Emiherber\LambdasiLogs\Logger;
use Emiherber\LambdasiLogs\LogLevel;

define('__DR__', $_SERVER['DOCUMENT_ROOT'].'/lambdasi-logs/');

define('TOKEN', 'token_bot');
define('CHATID', 'id_destinatario_mensajes');
define('TITULOSISTEMA', 'nombre_aplicación');

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
    $log->log(LogLevel::DEBUG, 'test', compact('th'));
    $log->log(LogLevel::ERROR, 'test', ['th' => new Error('Error')]);
    $log->log(LogLevel::WARNING, $th->getMessage(), ['th' => new Exception('Exception')]);
    $log->warning($th->getMessage(), ['th' => new Exception('Exception')]);
    $log->alert($th->getMessage());
  }
}

```

::: info
Para los logs del LogLevel::ALERT se intentara enviar un mensaje a tu chat de Telegram. Si utiliza la forma $log->alert($th->getMessage(),[]); o $log->alert($th->getMessage());.
Si usa $log->log(LogLevel::ALERT, 'test', compact('th')); solo se genera un archivo y no se envia una alerta.
:::


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