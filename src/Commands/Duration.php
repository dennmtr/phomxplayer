<?php

namespace phOMXPlayer\Commands;

/**
 * Returns the total length of the playing media.
 *
 * @see Command
 */
final class Duration extends Command
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
			array('string', 'Duration'),
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
	 * Returns the total length in microseconds
	 *
	 * @return float
	 */
	protected function formatOutput(): ?float
	{

		preg_match_all('/int64\s(\d+)/', $this->stdout, $output_array);
		if (isset($output_array[1][0])) {

			$duration_in_ms = (float)($output_array[1][0]);
			if ($duration_in_ms >= 0) {

				return $duration_in_ms;

			}

		}
		return null;

	}

}
