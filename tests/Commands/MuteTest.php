<?php

namespace Commands;

use phOMXPlayer\Commands;
use phOMXPlayer\OMXPlayer;
use PHPUnit\Framework\TestCase;

final class MuteTest extends TestCase
{

	public function testMute(): void
	{

		$player = new OMXPlayer();
		$this->assertTrue($player->alive(), 'OMXPlayer must be active before testing.');
		$command = new Commands\Mute();
		$this->assertEmpty($command->getStdOut());
		$this->assertNull($command->getFormattedOutput());

	}

}
