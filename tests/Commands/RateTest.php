<?php

namespace Commands;

use phOMXPlayer\Commands;
use phOMXPlayer\Exception;
use phOMXPlayer\OMXPlayer;
use PHPUnit\Framework\TestCase;

final class RateTest extends TestCase
{

	public function testRate(): void
	{

		$player = new OMXPlayer();
		$this->assertTrue($player->alive(), 'OMXPlayer must be active before testing.');
		$command = new Commands\Rate();
		$this->assertIsFloat($command->getFormattedOutput());
		$this->assertGreaterThan(0, $command->getFormattedOutput());
		$command = new Commands\Rate(0.5);
		$this->assertIsFloat($command->getFormattedOutput());
		$this->assertGreaterThan(0, $command->getFormattedOutput());
		$command = new Commands\Rate(2.0);
		$this->assertIsFloat($command->getFormattedOutput());
		$this->assertGreaterThan(0, $command->getFormattedOutput());
		$command = new Commands\Rate(1.0);
		$this->assertIsFloat($command->getFormattedOutput());
		$this->assertGreaterThan(0, $command->getFormattedOutput());
	}

	/**
	 * @depends testRate
	 */
	public function testWrongValue(): void
	{

		$player = new OMXPlayer();
		$this->assertTrue($player->alive(), 'OMXPlayer must be active before testing.');
		$this->expectException(Exception\CommandException::class);
		new Commands\Rate(0);

	}

	/**
	 * @depends testWrongValue
	 */
	public function testAcceptsNumericStrings(): void
	{

		$player = new OMXPlayer();
		$this->assertTrue($player->alive(), 'OMXPlayer must be active before testing.');
		$this->assertTrue(Commands\Rate::validateInput('0.5'));

	}

}
