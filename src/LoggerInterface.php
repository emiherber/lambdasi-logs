<?php

namespace Emiherber\LambdasiLogs;

interface LoggerInterface
{
  /**
   * El sistema no se encuentra disponible.
   *
   * @param string $message
   * @param array $context
   * @return void
   */
  function emergency(string $message, array $context = []);

  /**
   * El método alert se utiliza para indicar situaciones que requieren atención inmediata.
   * Se pueden utilizar ejemplos como un sitio web completo caido, una base de datos no disponible, etc.
   * Este método desencadenará las alertas por SMS y despertará al usuario.
   *
   * @param string $message
   * @param array $context
   * @return void
   */
  function alert(string $message, array $context = []);

  /**
   * Condiciones críticas.
   *
   * Ejemplo: Componente de aplicación no disponible, excepción inesperada.
   *
   * @param string $message
   * @param array $context
   * @return void
   */
  function critical(string $message, array $context = []);

  /**
   * Errores de tiempo de ejecución que no requieren una acción inmediata
   * pero que normalmente deben registrarse y monitorearse.
   *
   * @param string $message
   * @param array $context
   * @return void
   */
  function error(string $message, array $context = []);

  /**
   * Sucesos excepcionales que no son errores.
   *
   * Ejemplo: uso de API obsoletas, uso deficiente de una API,
   * cosas indeseables que no necesariamente son incorrectas.
   *
   * @param string $message
   * @param array $context
   * @return void
   */
  function warning(string $message, array $context = []);

  /**
   * Eventos normales pero significativos.
   *
   * @param string $message
   * @param array $context
   * @return void
   */
  function notice(string $message, array $context = []);

  /**
   * Eventos interesantes.
   *
   * Ejemplo: inicios de sesión de usuario, registros SQL.
   *
   * @param string $message
   * @param array $context
   * @return void
   */
  function info(string $message, array $context = []);

  /**
   * Información de depuración detallada.
   *
   * @param string $message
   * @param array $context
   * @return void
   */
  function debug(string $message, array $context = []);

  /**
   * Registros con un nivel arbitrario.
   *
   * @param mixed $level
   * @param string $message
   * @param array $context
   * @return void
   */
  function log(string $level, string $message, array $context = []);
}
