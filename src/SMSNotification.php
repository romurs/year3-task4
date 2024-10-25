<?php

namespace Romurs\Task4;

use Romurs\Task4\AbstractNotification;
use Romurs\Task4\Exceptions\MessageExceedsMaxCharactersException;

class SMSNotification extends AbstractNotification
{
  private int $maxLength = 160;

  public function send(string $message){
    if (strlen($message) > $this->maxLength) {
      throw new MessageExceedsMaxCharactersException('Длина сообщения превышает 160 символов');
    }
    
    try {
      $this->status = "sent";
      print "Отправка SMS: " . $message . PHP_EOL;
    } catch (MessageExceedsMaxCharactersException $e) {
      $this->status = "failed";
      print $e->getMessage() . PHP_EOL;
    }
  }
  public function getType(){
    return "SMS";
  }
}