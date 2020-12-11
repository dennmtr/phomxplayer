<?php

namespace phOMXPlayer\Commands;

use phOMXPlayer\Exception;

/**
 * Set the playing rate and return the current rate, or gets the current rate.
 * Rate of 1.0 is the normal playing rate.
 * A value of 2.0 corresponds to two times faster than normal rate, a value of 0.5 corresponds to two times slower than the normal rate.
 *
 * @see Command
 */
final class Rate extends Command
{

	/**
	 * @var string Contains the required DBusClient method.
	 */
	protected $method = 'org.freedesktop.DBus.Properties';

	/**
	 * Returns the required DBusClient parameters.
	 *
	 * @return array
	 */
	protected function getParams(): ?array
	{

		$params = array(
			array('string', escapeshellarg('org.mpris.MediaPlayer2.Player')),
			array('string', escapeshellarg('Rate'))
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
	 * @return null
	 * @throws Exception\CommandException
	 */
	protected function sanitizeInput($input)
	{

		if (is_null($input)) {

			$this->method .= '.Get';
			return null;

		} else {

			if (static::validateInput($this->input)) {

				$this->method .= '.Set';
				return (float)$this->input;

			}
			throw new Exception\CommandException('Invalid input rate number.');

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

		if (is_numeric($input) && $input > 0 && $input <= 4) return true;
		return false;

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

				return (float)$output_array[1][0];

			}

		}
		return null;

	}

}
