<?php

use phOMXPlayer\OMXPlayer;
use PHPUnit\Framework\TestCase;
use phOMXPlayer\Config;

final class DupDBusSessionAvoidedTest extends TestCase
{

	public function testForDuplicateSession()
	{


		foreach (range(0, 10, 1) as $val) {

			$player = new OMXPLayer();
			$player->play(TEST_URI);
			if (isset($pids)) unset($pids);
			exec('pgrep '. Config::getDBusDaemonPath(), $pids, $error);
			$this->assertFalse(boolval($error));
			$this->assertGreaterThan(0, count($pids));
			$current_user = posix_getpwuid(posix_geteuid())['name'];
			if (count($pids) > 1) {

				$pids = array_filter($pids, function ($pid) use ($current_user) {

					return trim(shell_exec('ps -o user= -p ' . $pid)) === $current_user;

				});

			}
			$this->assertCount(1, $pids);

		}

	}

}
