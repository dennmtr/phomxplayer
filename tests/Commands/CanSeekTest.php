<?php

namespace Commands;

use phOMXPlayer\Commands;
use phOMXPlayer\OMXPlayer;
use PHPUnit\Framework\TestCase;

final class CanSeekTest extends TestCase
{

  public function testCanSeek(): void
  {

    $player = new OMXPlayer();
    $this->assertTrue($player->alive(), 'OMXPlayer must be active before testing.');
    $command = new Commands\CanSeek();
    $this->assertStringContainsString('boolean', $command->getStdOut());
    $this->assertIsBool($command->getFormattedOutput());

  }

}
