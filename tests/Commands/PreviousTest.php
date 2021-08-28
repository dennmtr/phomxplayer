<?php

namespace Commands;

use phOMXPlayer\Commands;
use phOMXPlayer\OMXPlayer;
use PHPUnit\Framework\TestCase;

final class PreviousTest extends TestCase
{

  public function testPrevious(): void
  {

    $player = new OMXPlayer();
    $this->assertTrue($player->alive(), 'OMXPlayer must be active before testing.');
    $command = new Commands\CanGoPrevious();
    $passes = $command->getFormattedOutput();
    if ($passes) {
      $command = new Commands\Previous();
      $this->assertEmpty($command->getStdOut());
      $this->assertNull($command->getFormattedOutput());
    }

  }

}
