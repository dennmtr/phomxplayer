<?php

use phOMXPlayer\Config;
use PHPUnit\Framework\TestCase;

final class ConfigTest extends TestCase
{
  /**
   * Don't forget to define a valid absolute file path,
   * or a valid url address for the tests process in phpunit.xml configuration file.
   */
  public function testUri()
  {

    $pass = is_readable(TEST_URI) || filter_var(TEST_URI, FILTER_VALIDATE_URL);

    $this->assertTrue($pass, 'Uri expects a valid absolute path of file or a valid url address.');

  }

  public function testConfig()
  {

    $session_path = Config::getSessionPath();
    $this->assertNotEmpty($session_path);
  }

}
