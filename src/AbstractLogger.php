<?php

namespace Emiherber\LambdasiLogs;

abstract class AbstractLogger implements LoggerInterface
{
  use LoggerTrait;

  abstract function log(string $level, string $message, array $context = []);
}
