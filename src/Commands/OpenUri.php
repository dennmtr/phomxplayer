<?php

namespace phOMXPlayer\Commands;

use phOMXPlayer\Exception;

/**
 * Returns and array of all known video streams.
 * The length of the array is the number of streams.
 * Each item in the array is a string in the following format.
 *
 * @see Command
 */
final class OpenUri extends Command

{
	/**
	 * @var string Contains the required DBusClient method.
	 */
	protected $method = 'org.mpris.MediaPlayer2.Player.OpenUri';

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
			array('string', $this->input)
		);
	}

	/**
	 * Sanitizes the input value.
	 *
	 * @param mixed $input
	 *
	 * @return string Uri path
	 * @throws Exception\CommandException
	 */
	protected function sanitizeInput($input): string
	{

		if (is_file($input)) {
			return $this->input;
		}

		throw new Exception\CommandException('File not found.');

	}

	/**
	 * Formats the stdout string buffer accordingly.
	 *
	 * @return string Uri Path
	 */
	protected function formatOutput(): string
	{

		return $this->stdout;

	}

}