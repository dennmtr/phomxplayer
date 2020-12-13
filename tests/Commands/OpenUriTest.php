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


		if (filter_var(TEST_URI, FILTER_VALIDATE_URL)) return;

		$command = new Commands\OpenUri(TEST_URI);
		$this->assertEquals(TEST_URI, $command->getStdOut());
		$this->assertEquals(TEST_URI, $command->getFormattedOutput());

	}

}
