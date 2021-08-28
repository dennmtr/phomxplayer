<?php

namespace Commands;

use phOMXPlayer\Commands;
use phOMXPlayer\OMXPlayer;
use PHPUnit\Framework\TestCase;

final class PauseTest extends TestCase
{

  public function testPause(): void
  {

    $player = new OMXPlayer();
    $this->assertTrue($player->alive(), 'OMXPlayer must be active before testing.');
    $command = new Commands\CanPause();
    $this->assertTrue($command->getFormattedOutput());
    $command = new Commands\Pause();
    $this->assertEmpty($command->getStdOut());
    $this->assertNull($command->getFormattedOutput());
    $command = new Commands\PlaybackStatus();
    $this->assertFalse($command->getFormattedOutput());

  }

}
