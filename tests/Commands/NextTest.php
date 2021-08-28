<?php

namespace Commands;

use phOMXPlayer\Commands;
use phOMXPlayer\OMXPlayer;
use PHPUnit\Framework\TestCase;

final class NextTest extends TestCase
{

  public function testNext(): void
  {

    $player = new OMXPlayer();
    $this->assertTrue($player->alive(), 'OMXPlayer must be active before testing.');
    $command = new Commands\CanGoNext();
    $passes = $command->getFormattedOutput();
    if ($passes) {
      $command = new Commands\Next();
      $this->assertEmpty($command->getStdOut());
      $this->assertNull($command->getFormattedOutput());
    }


  }

}
