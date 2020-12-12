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

		$this->assertFileIsReadable(TEST_URI);

	}

	public function testConfig()
	{

		$session_path = Config::getSessionPath();
		$this->assertNotEmpty($session_path);
	}

}
