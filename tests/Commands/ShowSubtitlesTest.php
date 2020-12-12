<?php

namespace Commands;

use phOMXPlayer\Commands;
use phOMXPlayer\OMXPlayer;
use PHPUnit\Framework\TestCase;

final class ShowSubtitlesTest extends TestCase
{

	public function testShowSubtitles(): void
	{

		$player = new OMXPlayer();
		$this->assertTrue($player->alive(), 'OMXPlayer must be active before testing.');
		$command = new Commands\ShowSubtitles();
		$this->assertEmpty($command->getStdOut());
		$this->assertNull($command->getFormattedOutput());

	}

}
