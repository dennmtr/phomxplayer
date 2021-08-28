<?php

namespace Commands;

use phOMXPlayer\Commands;
use phOMXPlayer\OMXPlayer;
use PHPUnit\Framework\TestCase;

final class CanControlTest extends TestCase
{

  public function testCanControl(): void
  {

    $player = new OMXPlayer();
    $this->assertTrue($player->alive(), 'OMXPlayer must be active before testing.');
    $command = new Commands\CanControl();
    $this->assertStringContainsString('boolean', $command->getStdOut());
    $this->assertIsBool($command->getFormattedOutput());

  }

}
