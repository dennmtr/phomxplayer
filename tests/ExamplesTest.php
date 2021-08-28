<?php

use phOMXPlayer\Arguments;
use phOMXPlayer\Exception;
use phOMXPlayer\OMXPlayer;
use PHPUnit\Framework\TestCase;

/**
 * Tests from README.md
 */
final class ExamplesTest extends TestCase
{

  public function testExamples()
  {

    $arguments = [
      'adev' => 'hdmi',
      'blank' => true,
      'no-keys' => true
    ];
    $player = new OMXPlayer($arguments);
    $this->assertInstanceOf(OMXPlayer::class, $player);
    $this->assertInstanceOf(Arguments\Adev::class, $player->adev);
    $this->assertEquals('--adev hdmi', $player->adev->getShellArg());
    $this->assertEquals('hdmi', $player->adev->getValue());
    $player->adev = 'local'; // Sets a new adev argument instance with its variant value via magic method.
    $this->assertEquals('local', $player->adev->getValue());
    $player->map([
      'adev' => 'both',
      'with-info' => false
    ]);
    $this->assertEquals('both', $player->adev->getValue());
    $this->assertFalse($player->with_info->getValue());
    $this->assertTrue($player->blank->getValue());
    $player->map([
      'adev' => new Arguments\Adev(Arguments\Adev::HDMI),
      'blank' => new Arguments\Blank(false),
      'with-info' => true,
    ]);
    $this->assertEquals('hdmi', $player->adev->getValue());
    $this->assertEquals('--adev hdmi --no-keys --with-info', $player->getShellArgs(false, false));
    $input = true;
    $this->assertFalse(Arguments\Adev::isValid($input));
    if (Arguments\Adev::isValid($input)) {
      $player->adev = $input;       // It will never reach here because boolean true is not a valid Adev value.
    }
    $this->expectException(Exception\ArgumentException::class);
    $player->adev = $input;         // It will throw an ArgumentException because boolean true is not a valid Adev value.
  }

}
