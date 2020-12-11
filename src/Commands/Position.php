<?php

namespace phOMXPlayer\Commands;

use phOMXPlayer\Exception;

/**
 * Accessor
 *
 * Returns the current position.
 * Seeks to a specific location in the file. This is an absolute seek.
 *
 * @see Command
 */
final class Position extends Command
{

	/**
	 * @var string Contains the required DBusClient method.
	 */
	protected $method = 'org.';

	/**
	 * If input value is null will return the current position
	 * If input is a valid input time will seek to the specific location
	 *     *
	 * @return array
	 */
	protected function getParams(): array
	{

		if (is_null($this->input)) {

			return array(
				array('string', 'org.mpris.MediaPlayer2.Player'),
				array('string', 'Position'),
			);

		} else {

			return array(
				array('objpath', '/not/used'),
				array('int64', $this->input),
			);

		}

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

			$this->method .= 'freedesktop.DBus.Properties.Get';
			return null;

		} else {

			if (static::validateInput($input)) {

				$this->method .= 'mpris.MediaPlayer2.Player.SetPosition';
				return (float)$input;

			}
			throw new Exception\CommandException('Invalid input position number.');

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

		if (is_numeric($input) && $input >= 0) return true;
		return false;

	}

	/**
	 * Formats the stdout string buffer accordingly.
	 *
	 * @return float
	 */
	protected function formatOutput(): ?float
	{

		if (is_null($this->input)) {

			return (float)explode('int64', $this->stdout)[1];

		} else {

			preg_match_all('/int64\s(\d+)/', $this->stdout, $output_array);
			if (isset($output_array[1][0])) {

				if (is_numeric($output_array[1][0])) {

					return (float)($output_array[1][0]);

				}

			}

		}
		return null;

	}

//	public static function convertFormattedTimeToMs(?string $time = null) : ?float {
//
//		if (!empty($time) && preg_match("/\d{1,2}:\d{1,2}:\d{1,2}/", $time)) {
//
//			$time = explode(":", $time);
//
//			$multiplier = (float)(3600 * 1000000);
//			$value = (float)($time[0] * $multiplier);
//			$multiplier = 60 * 1000000;
//			$value += (float)($time[1] * $multiplier);
//			$multiplier = 1 * 1000000;
//			$value += (float)$time[2] * $multiplier;
//
//			return $value;
//
//		}
//
//		return null;
//
//	}
}
