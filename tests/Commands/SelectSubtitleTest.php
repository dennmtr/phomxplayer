<?php

namespace Commands;

use phOMXPlayer\Commands;
use phOMXPlayer\Exception;
use phOMXPlayer\OMXPlayer;
use PHPUnit\Framework\TestCase;

final class SelectSubtitleTest extends TestCase
{

  public function testSelectSubtitle(): void
  {

    $player = new OMXPlayer();
    $this->assertTrue($player->alive(), 'OMXPlayer must be active before testing.');
    $command = new Commands\SelectSubtitle(1);
    $this->assertIsBool($command->getFormattedOutput());

  }

  /**
   * @depends testSelectSubtitle
   */
  public function testWrongValue(): void
  {

    $player = new OMXPlayer();
    $this->assertTrue($player->alive(), 'OMXPlayer must be active before testing.');
    $this->expectException(Exception\CommandException::class);
    new Commands\SelectSubtitle('selectsubtitle');

  }

  /**
   * @depends testWrongValue
   */
  public function testAcceptsNumericStrings(): void
  {

    $player = new OMXPlayer();
    $this->assertTrue($player->alive(), 'OMXPlayer must be active before testing.');
    $this->assertTrue(Commands\SelectSubtitle::validateInput('1'));

  }


}
