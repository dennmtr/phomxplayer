<?php

namespace phOMXPlayer;

use phOMXPlayer\Exception;

/**
 * Initializes a new DBus session proper configured for OMXPlayer.
 */
class DBus extends ShellArguments

{
	/**
	 * DBus session constructor.
	 *
	 * @param bool $autostart 				Execute after initialization, default TRUE.
	 * @param array|null $shell_arguments 	Used to append default shell arguments.
	 *
	 * @throws Exception\ShellException
	 * @throws Exception\DBusException
	 *
	 * Recommended initialization way:
	 *
	 * @see DBusClient
	 */
	public function __construct($autostart = true, ?array $shell_arguments = [])
	{

		if (!$this->command_exists(Config::getDBusDaemonPath())) {
			throw new Exception\ShellException('dbus-daemon not found.');
		}

		parent::__construct($shell_arguments, Config::getDefaultDbusArguments());

		if ($autostart && !$this->alive()) {

			$this->start();

		}

	}

	/**
	 * Initializes a new DBus session.
	 *
	 * @return DBus
	 * @throws Exception\DBusException
	 */
	public function start(): self
	{

		if ($this->alive()) {

			throw new Exception\DBusException('DBus session already opened.');

		}

		$process = proc_open(Config::getDBusDaemonPath().$this->getShellArgs(), array(

			0 => array("pipe", "r"),
			1 => array("pipe", "w"),
			2 => array("pipe", "w"),
			$this->print_address->getValue() => array("file", $this->getAddressPath(), "wn"),
			$this->print_pid->getValue() => array("file", $this->getPidPath(), "wn"),

		), $pipes);

		if (is_resource($process)) {

			fclose($pipes[0]);

			$timeout = new TimeoutInterval();

			do {

				clearstatcache(true, $this->getAddressPath());
				clearstatcache(true, $this->getPidPath());

				$initialized = filesize($this->getAddressPath()) > 0 && filesize($this->getPidPath()) > 0;

				if ($timeout->expired()) break;

			} while (!$initialized);

			fclose($pipes[1]);
			fclose($pipes[2]);

			if ($initialized) {

				$this->init();

				return $this;

			}

		}

		throw new Exception\DBusException('DBus session failed to start');

	}

}
