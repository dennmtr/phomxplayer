<?php

namespace Commands;

use phOMXPlayer\Commands;
use phOMXPlayer\OMXPlayer;
use PHPUnit\Framework\TestCase;

final class DurationTest extends TestCase
{

  public function testDuration(): void
  {

    $player = new OMXPlayer();
    $this->assertTrue($player->alive(), 'OMXPlayer must be active before testing.');
    $command = new Commands\Duration();
    $this->assertStringContainsString('int64', $command->getStdOut());
    $this->assertIsNumeric($command->getFormattedOutput());

  }

}
