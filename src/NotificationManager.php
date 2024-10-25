<?php

namespace Romurs\Task4;

use Exception;
use Romurs\Task4\Notification;

class NotificationManager
{
  private $notificationHistory = [];

  public function getNotificationHistory(){
    return $this->notificationHistory;
  }

  private function writeLogToFile($path, $message){
    $fd = fopen($path, 'a') or die('Не удалось открыть файл');
    fwrite($fd, $message);
    fclose($fd);
  }

  public function sendNotification(Notification $notification, $message)
  {
    try {
      $notification->send($message);
      array_push($this->notificationHistory, [
        'type' => $notification->getType(),
        'status' => $notification->getStatus(),
        'timestamp' => $notification->getTimestamp()
      ]);
      $this->writeLogToFile('log.txt', 'Отправилось со статусом:' . $notification->getStatus());
    } catch (Exception $e) {
      array_push($this->notificationHistory, [
        'type' => $notification->getType(),
        'status' => 'failed',
        'timestamp' => date('Y-m-d H:i:s')
      ]);
      $this->writeLogToFile('log.txt', 'Ошибка:' .$e->getMessage());
    }
  }
}
