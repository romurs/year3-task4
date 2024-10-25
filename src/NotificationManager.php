<?php

namespace Romurs\Task4;

use Exception;
use Romurs\Task4\Notification;

class NotificationManager
{
  private array $notificationHistory = [];

  public function getNotificationHistory(): array
  {
    return $this->notificationHistory;
  }

  private function writeLogToFile(string $path, string $message) : void
  {
    $fd = fopen($path, 'a');
    fwrite($fd, $message);
    fclose($fd);
  }

  public function sendNotification(Notification $notification, string $message): void
  {
    try {
      $notification->send($message);
      array_push($this->notificationHistory, [
        'type' => $notification->getType(),
        'status' => $notification->getStatus(),
        'timestamp' => $notification->getTimestamp()
      ]);
      $this->writeLogToFile('log.txt', 'Отправилось со статусом:' . $notification->getStatus() . PHP_EOL);
    } catch (Exception $e) {
      array_push($this->notificationHistory, [
        'type' => $notification->getType(),
        'status' => 'failed',
        'timestamp' => date('Y-m-d H:i:s')
      ]);
      $this->writeLogToFile('log.txt', 'Ошибка:' . $e->getMessage() . PHP_EOL);
    }
  }
}
