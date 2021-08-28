<?php

namespace Commands;

use phOMXPlayer\Commands;
use phOMXPlayer\OMXPlayer;
use PHPUnit\Framework\TestCase;

final class GetSourceTest extends TestCase
{

  public function testGetSource(): void
  {

    $player = new OMXPlayer();
    $this->assertTrue($player->alive(), 'OMXPlayer must be active before testing.');
    $command = new Commands\GetSource();
    $this->assertNotEmpty($command->getFormattedOutput());

  }

}
