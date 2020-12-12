<?php

namespace Commands;

use phOMXPlayer\Commands;
use phOMXPlayer\Exception;
use phOMXPlayer\OMXPlayer;
use PHPUnit\Framework\TestCase;

final class VolumeTest extends TestCase
{

	public function testVolume(): void
	{

		$player = new OMXPlayer();
		$this->assertTrue($player->alive(), 'OMXPlayer must be active before testing.');
		foreach (range(0, 1, 0.05) as $val) {

			$command = new Commands\Volume($val);
			$this->assertEquals($val, $command->getFormattedOutput());
			$command = new Commands\Volume();
			$this->assertEquals($val, $command->getFormattedOutput());

		}

	}

	/**
	 * @depends testVolume
	 */
	public function testWrongValue(): void
	{

		$player = new OMXPlayer();
		$this->assertTrue($player->alive(), 'OMXPlayer must be active before testing.');
		$this->expectException(Exception\CommandException::class);
		new Commands\Volume(2);

	}

	/**
	 * @depends testWrongValue
	 */
	public function testAcceptsNumericStrings(): void
	{

		$player = new OMXPlayer();
		$this->assertTrue($player->alive(), 'OMXPlayer must be active before testing.');
		$this->assertTrue(Commands\Volume::validateInput('0.5'));

	}

}
