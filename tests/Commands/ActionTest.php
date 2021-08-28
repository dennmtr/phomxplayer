<?php

namespace Commands;

use phOMXPlayer\Commands;
use phOMXPlayer\Exception;
use phOMXPlayer\OMXPlayer;
use PHPUnit\Framework\TestCase;

final class ActionTest extends TestCase
{

  public function testAction(): void
  {

    $player = new OMXPlayer();
    $this->assertTrue($player->alive(), 'OMXPlayer must be active before testing.');
    $command = new Commands\Action(Commands\Action::SHOW_INFO);
    $this->assertEmpty($command->getStdOut());
    $this->assertNull($command->getFormattedOutput());

  }

  public function testWrongValue(): void
  {

    $player = new OMXPlayer();
    $this->assertTrue($player->alive(), 'OMXPlayer must be active before testing.');
    $this->expectException(Exception\CommandException::class);
    new Commands\Action(0);

  }

  /**
   * @depends testWrongValue
   */
  public function testAcceptsNumericStrings(): void
  {

    $player = new OMXPlayer();
    $this->assertTrue($player->alive(), 'OMXPlayer must be active before testing.');
    $this->assertTrue(Commands\Action::validateInput('10'));

  }

}
