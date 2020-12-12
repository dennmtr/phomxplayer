<?php

namespace Commands;

use phOMXPlayer\Commands;
use phOMXPlayer\OMXPlayer;
use PHPUnit\Framework\TestCase;

final class ListAudioTest extends TestCase
{

	public function testListAudio(): void
	{

		$player = new OMXPlayer();
		$this->assertTrue($player->alive(), 'OMXPlayer must be active before testing.');
		$command = new Commands\ListAudio();
		$this->assertNotEmpty($command->getStdOut());
		$this->assertIsArray($command->getFormattedOutput());

	}

}
