<?php

use PHPUnit\Framework\TestCase;
use Romurs\Task4\SMSNotification;
use Romurs\Task4\AbstractNotification;
use Romurs\Task4\MessageExceedsMaxCharactersException;

class SMSNotificationTest extends TestCase
{
  public function testSendMessage()
  {
    $message = "Hello world!";
    $sms = new SMSNotification();
    $sms->send($message);
    $this->assertEquals('sent', $sms->getStatus());
  }
  public function testMessageExceedsMaxCharactersException()
  {
    $this->expectException(MessageExceedsMaxCharactersException::class);
    $message = "Hello world! Hello world! Hello world! Hello world! Hello world! Hello world! Hello world! Hello world! Hello world! Hello world! Hello world! Hello world! Hello world! ";
    $sms = new SMSNotification();
    $sms->send($message);
  }
}
