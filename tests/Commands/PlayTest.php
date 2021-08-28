<?php

namespace Commands;

use phOMXPlayer\Commands;
use phOMXPlayer\OMXPlayer;
use PHPUnit\Framework\TestCase;

final class PlayTest extends TestCase
{

  public function testPlay(): void
  {

    $player = new OMXPlayer();
    $this->assertTrue($player->alive(), 'OMXPlayer must be active before testing.');
    $command = new Commands\CanPlay();
    $this->assertTrue($command->getFormattedOutput());
    $command = new Commands\Play();
    $this->assertEmpty($command->getStdOut());
    $this->assertNull($command->getFormattedOutput());
    $command = new Commands\PlaybackStatus();
    $this->assertTrue($command->getFormattedOutput());

  }

}
