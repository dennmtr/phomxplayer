<?php

namespace phOMXPlayer\Commands;

use phOMXPlayer\Exception;

/**
 * Selects the audio stream at a given index.
 *
 * @see Command
 */
final class SelectAudio extends Command

{

	/**
	 * @var string Contains the required DBusClient method.
	 */
	protected $method = 'org.mpris.MediaPlayer2.Player.SelectAudio';

	/**
	 * Returns the required DBusClient parameters.
	 *
	 * @return array
	 */
	protected function getParams(): array
	{

		return array(
			array('int32', $this->input)
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

			return (int)$input;

		}

		throw new Exception\CommandException('Invalid index number.');

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

		if (is_numeric($input) && $input >= 0) return true;

		return false;

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
