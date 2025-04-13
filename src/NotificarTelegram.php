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
    $this->urlApi = 'https://api.telegram.org/bot' . TOKEN ?? 'TOKEN_DE_PRUEBA';
    $this->tituloSistema = TITULOSISTEMA ?? 'Sistema de Logs';
    $this->chatId = CHATID ?? 'CHAT_ID_DE_PRUEBA';
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
    } catch (\Throwable $th) {
      throw $th;
    }

    curl_close($ch);
  }
}
