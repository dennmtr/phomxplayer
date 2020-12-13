<?php

namespace Commands;

use phOMXPlayer\Commands;
use phOMXPlayer\Exception;
use phOMXPlayer\OMXPlayer;
use PHPUnit\Framework\TestCase;

final class PositionTest extends TestCase
{

	public function testPosition(): void
	{

		$player = new OMXPlayer();
		$this->assertTrue($player->alive(), 'OMXPlayer must be active before testing.');
		$command = new Commands\Duration();
		$duration = $command->getFormattedOutput();
		$command = new Commands\Position();
		$current_position = $command->getFormattedOutput();
		$command = new Commands\Position(0);
		$this->assertLessThanOrEqual(0, $command->getFormattedOutput());
		$ms = round(($duration / 2));
		$command = new Commands\Position($ms);
		$this->assertIsNumeric($command->getFormattedOutput());
		new Commands\Position($current_position);

	}

	/**
	 * @depends testPosition
	 */
	public function testWrongValue(): void
	{

		$player = new OMXPlayer();
		$this->assertTrue($player->alive(), 'OMXPlayer must be active before testing.');
		$this->expectException(Exception\CommandException::class);
		new Commands\Position('position');

	}

	/**
	 * @depends testWrongValue
	 */
	public function testAcceptsNumericStrings(): void
	{

		$player = new OMXPlayer();
		$this->assertTrue($player->alive(), 'OMXPlayer must be active before testing.');
		$this->assertTrue(Commands\Position::validateInput('10000'));

	}

}
