<?php

namespace phOMXPlayer\Commands;

use phOMXPlayer\Exception;

/**
 * Accessor
 *
 * Set the volume and return the current volume.
 *
 * Return the current volume.
 *
 * As defined by the MPRIS specifications, this value should be greater than or equal to 0. 1 is the normal volume.
 * Everything below is quieter than normal, everything above is louder.
 *
 * @see Command
 */
final class Volume extends Command
{

	/**
	 * @var string Contains the required DBusClient method.
	 */
	protected $method = 'org.freedesktop.DBus.Properties';

	/**
	 * Returns the required DBusClient parameters.
	 *
	 * @return array|null
	 */
	protected function getParams(): ?array
	{

		$params = array(
			array('string', escapeshellarg('org.mpris.MediaPlayer2.Player')),
			array('string', escapeshellarg('Volume'))
		);
		if (!is_null($this->input)) {

			$params[] = array('variant:double', $this->input);

		}
		return $params;

	}

	/**
	 * Sanitizes the input value.
	 *
	 * @param mixed $input
	 *
	 * @return mixed
	 * @throws Exception\CommandException
	 */
	protected function sanitizeInput($input)
	{

		if (is_null($input)) {

			$this->method .= '.Get';
			return null;

		} else {

			if (static::validateInput($input)) {

				$this->method .= '.Set';
				return (float)$input;

			}
			throw new Exception\CommandException('Invalid input number.');

		}

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

		return is_numeric($input) && $input <= 1 && $input >= 0;

	}

	/**
	 * Formats the stdout string buffer accordingly.
	 *
	 * @return float|null
	 */
	protected function formatOutput(): ?float
	{

		preg_match_all('/double\s(.+)/', $this->stdout, $output_array);
		if (isset($output_array[1][0])) {

			if (is_numeric($output_array[1][0])) {

				return (float)($output_array[1][0]);

			}

		}
		return null;

	}

}
