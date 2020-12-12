<?php

namespace Commands;

use phOMXPlayer\Commands;
use phOMXPlayer\Exception;
use phOMXPlayer\OMXPlayer;
use PHPUnit\Framework\TestCase;

final class SelectAudioTest extends TestCase
{

	public function testSelectAudio(): void
	{

		$player = new OMXPlayer();
		$this->assertTrue($player->alive(), 'OMXPlayer must be active before testing.');
		$command = new Commands\SelectAudio(1);
		$this->assertIsBool($command->getFormattedOutput());

	}

	/**
	 * @depends testSelectAudio
	 */
	public function testWrongValue(): void
	{

		$player = new OMXPlayer();
		$this->assertTrue($player->alive(), 'OMXPlayer must be active before testing.');
		$this->expectException(Exception\CommandException::class);
		new Commands\SelectAudio('selectaudio');

	}

	/**
	 * @depends testWrongValue
	 */
	public function testAcceptsNumericStrings(): void
	{

		$player = new OMXPlayer();
		$this->assertTrue($player->alive(), 'OMXPlayer must be active before testing.');
		$this->assertTrue(Commands\SelectAudio::validateInput('1'));

	}

}
