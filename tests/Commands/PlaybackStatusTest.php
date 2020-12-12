<?php

namespace Commands;

use phOMXPlayer\Commands;
use phOMXPlayer\OMXPlayer;
use PHPUnit\Framework\TestCase;

final class PlaybackStatusTest extends TestCase
{

	public function testPlaybackStatus(): void
	{

		$player = new OMXPlayer();
		$this->assertTrue($player->alive(), 'OMXPlayer must be active before testing.');
		$command = new Commands\PlaybackStatus();
		$this->assertMatchesRegularExpression('/Paused|Playing/', $command->getStdOut());
		$this->assertIsBool($command->getFormattedOutput());

	}

}
