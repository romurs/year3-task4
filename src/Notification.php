<?php

namespace Romurs\Task4;

interface Notification{
  public function send(string $message);
  public function getStatus();
  public function getType();
  public function getTimestamp();

}