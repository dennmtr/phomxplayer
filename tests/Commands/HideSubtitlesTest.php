<?php

namespace Commands;

use phOMXPlayer\Commands;
use phOMXPlayer\OMXPlayer;
use PHPUnit\Framework\TestCase;

final class HideSubtitlesTest extends TestCase
{

  public function testHideSubtitles(): void
  {

    $player = new OMXPlayer();
    $this->assertTrue($player->alive(), 'OMXPlayer must be active before testing.');
    $command = new Commands\HideSubtitles();
    $this->assertEmpty($command->getStdOut());
    $this->assertNull($command->getFormattedOutput());

  }

}
