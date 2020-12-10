<?php

namespace phOMXPlayer\Commands;

/**
 * Returns the total length of the playing media.
 *
 * @see Command
 */
final class CanSeek extends Command

{

	/**
	 * @var string Contains the required DBusClient method.
	 */
	protected $method = 'org.freedesktop.DBus.Properties.Get';

	/**
	 * Validates the input value.
	 *
	 * @param mixed $input
	 *
	 * @return bool
	 */
	public static function validateInput($input = null): bool
	{

		if (is_null($input)) return true;

		return false;

	}

	/**
	 * Returns the required DBusClient parameters.
	 *
	 * @return array
	 */
	protected function getParams(): array
	{

		return array(
			array('string', 'org.mpris.MediaPlayer2.Player'),
			array('string', 'CanSeek'),
		);

	}

	/**
	 * Sanitizes the input value.
	 *
	 * @param mixed $input
	 *
	 * @return null
	 */
	protected function sanitizeInput($input)
	{
		return null;
	}

	/**
	 * Formats the stdout string buffer accordingly.
	 *
	 * @return bool
	 */
	protected function formatOutput(): bool
	{
		return preg_match("/boolean\strue/", $this->stdout) == true;
	}

}
