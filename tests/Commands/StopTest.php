<?php

namespace Commands;

use phOMXPlayer\Commands;
use phOMXPlayer\OMXPlayer;
use phOMXPlayer\TimeoutInterval;
use PHPUnit\Framework\TestCase;

final class StopTest extends TestCase
{

  public function testCanStop(): void
  {

    $player = new OMXPlayer();
    $this->assertTrue($player->alive(), 'OMXPlayer must be active before testing.');
    new Commands\Stop();
    $timeout = new TimeoutInterval();
    do {

      $stopped = !$player->alive();
      if ($timeout->expired()) break;

    } while (!$stopped);
    $this->assertTrue($stopped, 'OMXPlayer cannot be stopped.');

  }

}
