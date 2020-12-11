<?php

namespace phOMXPlayer\Commands;

use phOMXPlayer\Exception;

/**
 * Perform a relative seek, i.e. seek plus or minus a certain number of microseconds from the current position in the video.
 *
 * @see Command
 */
final class Seek extends Command
{
	/**
	 * @var string Contains the required DBusClient method.
	 */
	protected $method = 'org.mpris.MediaPlayer2.Player.Seek';

	/**
	 * Returns the required DBusClient parameters.
	 *
	 * @return array
	 */
	protected function getParams(): array
	{

		return array(
			array('int64', $this->input)
		);

	}

	/**
	 * Sanitizes the input value.
	 *
	 * @param mixed $input
	 *
	 * @return int
	 * @throws Exception\CommandException
	 */
	protected function sanitizeInput($input): int
	{

		if (static::validateInput($input)) {
			return (float)$this->input;
		}
		throw new Exception\CommandException('Invalid input number.');

	}

	/**
	 * Validates the input value.
	 *
	 * @param mixed $input
	 *
	 * @return bool
	 */
	public static function validateInput($input = null): bool
	{

		if (is_numeric($input)) return true;
		return false;

	}

	/**
	 * Formats the stdout string buffer accordingly.
	 *
	 * @return null
	 */
	protected function formatOutput()
	{
		return null;
	}

}
