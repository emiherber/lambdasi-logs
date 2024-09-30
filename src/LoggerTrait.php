<?php

namespace Emiherber\LambdasiLogs;

trait LoggerTrait
{

  /**
   * System is unusable.
   */
  function emergency(string $message, array $context = []): void
  {
    $this->log(LogLevel::EMERGENCY, $message, $context);
  }

  /**
   * Action must be taken immediately.
   *
   * Example: Entire website down, database unavailable, etc. This should
   * trigger the SMS alerts and wake you up.
   */
  function alert(string $message, array $context = []): void
  {
    try {
      $notificar = new NotificarTelegram();
      $notificar->notificar($message);
    } catch (\Throwable $th) {
      $this->debug('Error al enviar el mensaje a telegram: '. $th->getMessage(), compact('th'));
    }

  }

  /**
   * Critical conditions.
   *
   * Example: Application component unavailable, unexpected exception.
   */
  function critical(string $message, array $context = []): void
  {
    $this->log(LogLevel::CRITICAL, $message, $context);
  }

  /**
   * Runtime errors that do not require immediate action but should typically
   * be logged and monitored.
   */
  function error(string $message, array $context = []): void
  {
    $this->log(LogLevel::ERROR, $message, $context);
  }

  /**
   * Exceptional occurrences that are not errors.
   *
   * Example: Use of deprecated APIs, poor use of an API, undesirable things
   * that are not necessarily wrong.
   */
  function warning(string $message, array $context = []): void
  {
    $this->log(LogLevel::WARNING, $message, $context);
  }

  /**
   * Normal but significant events.
   */
  function notice(string $message, array $context = []): void
  {
    $this->log(LogLevel::NOTICE, $message, $context);
  }

  /**
   * Interesting events.
   *
   * Example: User logs in, SQL logs.
   */
  function info(string $message, array $context = []): void
  {
    $this->log(LogLevel::INFO, $message, $context);
  }

  /**
   * Detailed debug information.
   */
  function debug(string $message, array $context = []): void
  {
    $this->log(LogLevel::DEBUG, $message, $context);
  }
}
