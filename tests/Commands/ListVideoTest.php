<?php

namespace Commands;

use phOMXPlayer\Commands;
use phOMXPlayer\OMXPlayer;
use PHPUnit\Framework\TestCase;

final class ListVideoTest extends TestCase
{

	public function testListVideo(): void
	{

		$player = new OMXPlayer();
		$this->assertTrue($player->alive(), 'OMXPlayer must be active before testing.');
		$command = new Commands\ListVideo();
		$this->assertNotEmpty($command->getStdOut());
		$this->assertIsArray($command->getFormattedOutput());

	}

}
