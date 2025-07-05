<?php

namespace Emiherber\LambdasiLogs;

use Exception;

class NotificarTelegram implements NotificarInterface
{
  private $urlApi;
  private $tituloSistema;
  private $chatId;

  function __construct()
  {
    $this->urlApi = 'https://api.telegram.org/bot';
    $this->tituloSistema = 'Sistema de Logs';
    $this->chatId = 'CHAT_ID_DE_PRUEBA';

    if (defined('TOKEN')) { $this->urlApi .= TOKEN; }
    if (defined('TITULOSISTEMA')) { $this->tituloSistema = TITULOSISTEMA; }
    if (defined('CHATID')) { $this->chatId = CHATID; }
  }

  function notificar(string $mensaje)
  {
    try {
      $params = [
        'chat_id' => $this->chatId,
        'text' => "<b>" . $this->tituloSistema . "</b>\n" . $mensaje,
        'parse_mode' => 'HTML'
      ];

      $ch = curl_init($this->urlApi . '/sendMessage');
      curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
      $response = curl_exec($ch);

      $data = json_decode($response, true);

      if (!$data['ok']) {
        throw new Exception($data['description'], $data['error_code']);
      }
    } catch (\Throwable) {}

    curl_close($ch);
  }
}
