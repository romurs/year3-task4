<?php

namespace Romurs\Task4;

use Romurs\Task4\Notification;

abstract class AbstractNotification implements Notification
{
  protected string $status;
  protected $timestamp;

  abstract public function send(string $message);

  public function getStatus(){
    return $this->status;
  }

  public function getTimestamp(){
    return $this->timestamp;
  }
}