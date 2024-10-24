<?php

namespace Romurs\Task4;

use Exception;
use Romurs\Task4\AbstractNotification;
use Romurs\Task4\Exceptions\ThemeIsNotSelectedException;

class EmailNotification extends AbstractNotification
{
  private string $theme;

  public function setTheme(string $theme)
  {
    $this->theme = $theme;
  }

  public function send($message)
  {
    if (empty($this->theme)) {
      throw new ThemeIsNotSelectedException('Тема не выбрана');
    }

    try {
      print "Отправка Email: " . $this->theme . " - " . $message . PHP_EOL;
      $this->status = "sent";
    } catch (Exception $e) {
      $this->status = "failed";
      print $e->getMessage() . PHP_EOL;
    }
  }

  public function getType() {
    return "Email";
  }
}
