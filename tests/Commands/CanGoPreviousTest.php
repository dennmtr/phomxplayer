<?php

namespace Commands;

use phOMXPlayer\Commands;
use phOMXPlayer\OMXPlayer;
use PHPUnit\Framework\TestCase;

final class CanGoPreviousTest extends TestCase
{

  public function testCanGoPrevious(): void
  {

    $player = new OMXPlayer();
    $this->assertTrue($player->alive(), 'OMXPlayer must be active before testing.');
    $command = new Commands\CanGoPrevious();
    $this->assertStringContainsString('boolean', $command->getStdOut());
    $this->assertIsBool($command->getFormattedOutput());

  }

}
