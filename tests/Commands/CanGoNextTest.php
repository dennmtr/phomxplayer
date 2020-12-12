<?php

namespace Commands;

use phOMXPlayer\Commands;
use phOMXPlayer\OMXPlayer;
use PHPUnit\Framework\TestCase;

final class CanGoNextTest extends TestCase
{

	public function testCanGoNext(): void
	{

		$player = new OMXPlayer();
		$this->assertTrue($player->alive(), 'OMXPlayer must be active before testing.');
		$command = new Commands\CanGoNext();
		$this->assertStringContainsString('boolean', $command->getStdOut());
		$this->assertIsBool($command->getFormattedOutput());

	}

}
