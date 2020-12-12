<?php

namespace Commands;

use phOMXPlayer\Commands;
use phOMXPlayer\OMXPlayer;
use PHPUnit\Framework\TestCase;

final class CanPlayTest extends TestCase
{

	public function testCanPlay(): void
	{

		$player = new OMXPlayer();
		$this->assertTrue($player->alive(), 'OMXPlayer must be active before testing.');
		$command = new Commands\CanPlay();
		$this->assertStringContainsString('boolean', $command->getStdOut());
		$this->assertIsBool($command->getFormattedOutput());

	}

}
