<?php

namespace Emiherber\LambdasiLogs;

interface LoggerInterface
{
  /**
   * System is unusable.
   *
   * @param string $message
   * @param array $context
   * @return void
   */
  function emergency(string $message, array $context = []);

  /**
   * Action must be taken immediately.
   *
   * Example: Entire website down, database unavailable, etc. This should
   * trigger the SMS alerts and wake you up.
   *
   * @param string $message
   * @param array $context
   * @return void
   */
  function alert(string $message, array $context = []);

  /**
   * Critical conditions.
   *
   * Example: Application component unavailable, unexpected exception.
   *
   * @param string $message
   * @param array $context
   * @return void
   */
  function critical(string $message, array $context = []);

  /**
   * Runtime errors that do not require immediate action but should typically
   * be logged and monitored.
   *
   * @param string $message
   * @param array $context
   * @return void
   */
  function error(string $message, array $context = []);

  /**
   * Exceptional occurrences that are not errors.
   *
   * Example: Use of deprecated APIs, poor use of an API, undesirable things
   * that are not necessarily wrong.
   *
   * @param string $message
   * @param array $context
   * @return void
   */
  function warning(string $message, array $context = []);

  /**
   * Normal but significant events.
   *
   * @param string $message
   * @param array $context
   * @return void
   */
  function notice(string $message, array $context = []);

  /**
   * Interesting events.
   *
   * Example: User logs in, SQL logs.
   *
   * @param string $message
   * @param array $context
   * @return void
   */
  function info(string $message, array $context = []);

  /**
   * Detailed debug information.
   *
   * @param string $message
   * @param array $context
   * @return void
   */
  function debug(string $message, array $context = []);

  /**
   * Logs with an arbitrary level.
   *
   * @param mixed $level
   * @param string $message
   * @param array $context
   * @return void
   */
  function log(string $level, string $message, array $context = []);
}
