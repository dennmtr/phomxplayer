<?php

namespace Commands;

use phOMXPlayer\Commands;
use phOMXPlayer\OMXPlayer;
use PHPUnit\Framework\TestCase;

final class ListSubtitlesTest extends TestCase
{

  public function testListSubtitles(): void
  {

    $player = new OMXPlayer();
    $this->assertTrue($player->alive(), 'OMXPlayer must be active before testing.');
    $command = new Commands\ListSubtitles();
    $this->assertNotEmpty($command->getStdOut());
    $this->assertIsArray($command->getFormattedOutput());

  }

}
