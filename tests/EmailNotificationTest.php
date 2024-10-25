<?php

use PHPUnit\Framework\TestCase;
use Romurs\Task4\EmailNotification;
use Romurs\Task4\Exceptions\ThemeIsNotSelectedException;

class EmailNotificationTest extends TestCase
{
  public function testSendMessage(){
    $email = new EmailNotification();
    $email->setTheme('World');
    $email->send('Hello world!');
    $this->assertEquals('sent', $email->getStatus());
  }
  public function testThemeIsNotSelectedExceptions(){
    $this->expectException(ThemeIsNotSelectedException::class);
    $email = new EmailNotification();
    $email->send('Hello world!');
  }
}
