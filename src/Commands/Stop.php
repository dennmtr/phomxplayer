<?php

namespace phOMXPlayer\Commands;

use phOMXPlayer\Exception\OMXPlayerException;
use phOMXPlayer\TimeoutInterval;

/**
 * Stops the video (terminates the OMXPlayer instance).
 *
 * @see Command
 */
final class Stop extends Command

{

	/**
	 * @var string Contains the required DBusClient method.
	 */
	protected $method = 'org.mpris.MediaPlayer2.Quit';

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
	 * @return mixed
	 */
	protected function getParams(): ?array
	{
		return null;
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
	 * @return null
	 */
	protected function formatOutput()
	{
		return null;
	}

}
