<?php

namespace Commands;

use phOMXPlayer\Commands;
use phOMXPlayer\OMXPlayer;
use PHPUnit\Framework\TestCase;

final class ToggleTest extends TestCase
{

	public function testToggle(): void
	{

		$player = new OMXPlayer();
		$this->assertTrue($player->alive(), 'OMXPlayer must be active before testing.');
		$command = new Commands\CanPause();
		$this->assertTrue($command->getFormattedOutput());
		$command = new Commands\CanPlay();
		$this->assertTrue($command->getFormattedOutput());
		$command = new Commands\Toggle();
		$this->assertEmpty($command->getStdOut());
		$this->assertNull($command->getFormattedOutput());

	}

}
