<?php

namespace Commands;

use phOMXPlayer\Commands;
use phOMXPlayer\Exception;
use phOMXPlayer\OMXPlayer;
use PHPUnit\Framework\TestCase;

final class SeekTest extends TestCase
{

  public function testSeek(): void
  {

    $player = new OMXPlayer();
    $this->assertTrue($player->alive(), 'OMXPlayer must be active before testing.');
    $command = new Commands\Position();
    $current_position = $command->getFormattedOutput();
    $command = new Commands\Position(2000000);
    $command = new Commands\Seek(2000000);
    $this->assertIsNumeric($command->getFormattedOutput());
    $command = new Commands\Seek(-2000000);
    $this->assertIsNumeric($command->getFormattedOutput());
    new Commands\Position($current_position);

  }

  /**
   * @depends testSeek
   */
  public function testWrongValue(): void
  {

    $player = new OMXPlayer();
    $this->assertTrue($player->alive(), 'OMXPlayer must be active before testing.');
    $this->expectException(Exception\CommandException::class);
    new Commands\Seek('seek');

  }

  /**
   * @depends testWrongValue
   */
  public function testAcceptsNumericStrings(): void
  {

    $player = new OMXPlayer();
    $this->assertTrue($player->alive(), 'OMXPlayer must be active before testing.');
    $this->assertTrue(Commands\Seek::validateInput('10000'));

  }

}
