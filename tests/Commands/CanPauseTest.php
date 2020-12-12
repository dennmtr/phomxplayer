<?php

namespace Commands;

use phOMXPlayer\Commands;
use phOMXPlayer\OMXPlayer;
use PHPUnit\Framework\TestCase;

final class CanPauseTest extends TestCase
{

	public function testCanPause(): void
	{

		$player = new OMXPlayer();
		$this->assertTrue($player->alive(), 'OMXPlayer must be active before testing.');
		$command = new Commands\CanPause();
		$this->assertStringContainsString('boolean', $command->getStdOut());
		$this->assertIsBool($command->getFormattedOutput());

	}

}
