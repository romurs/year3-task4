<?php

use PHPUnit\Framework\TestCase;
use Romurs\Task4\EmailNotification;
use Romurs\Task4\NotificationManager;
use Romurs\Task4\SMSNotification;
use Romurs\Task4\Notification;

class NotificationManagerTest extends TestCase
{
  public function testSendNotificationSuccessfully()
    {
        $SMSnotification = new SMSNotification;
        $manager = new NotificationManager();
        $manager->sendNotification($SMSnotification, 'Hello world!');

        $history = $manager->getNotificationHistory();
        $this->assertCount(1, $history);
        $this->assertEquals('sent', $history[0]['status']);

        $logContent = file_get_contents('log.txt');
        $this->assertStringContainsString('Отправилось со статусом:sent', $logContent);
    }
    public function testSendNotificationWithException()
    {
        $EmailNotification = new EmailNotification();

        $manager = new NotificationManager();
        $manager->sendNotification($EmailNotification, 'Test message');

        // Проверка истории уведомлений
        $history = $manager->getNotificationHistory();
        $this->assertCount(1, $history);
        $this->assertEquals('failed', $history[0]['status']);

        // Проверка лог-файла
        $logContent = file_get_contents('log.txt');
        $this->assertStringContainsString('Ошибка:Ошибка отправки', $logContent);
    }
}