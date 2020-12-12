<?php

namespace Commands;

use phOMXPlayer\Commands;
use phOMXPlayer\OMXPlayer;
use PHPUnit\Framework\TestCase;

final class OpenUriTest extends TestCase
{

	public function testOpenUri(): void
	{

		$player = new OMXPlayer();
		$this->assertTrue($player->alive(), 'OMXPlayer must be active before testing.');
		$command = new Commands\OpenUri(TEST_URI);
		$this->assertEmpty($command->getStdOut());
		$this->assertNull($command->getFormattedOutput());

	}

}
