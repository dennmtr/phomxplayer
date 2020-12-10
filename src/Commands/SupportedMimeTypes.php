<?php

namespace phOMXPlayer\Commands;

/**
 * Supported mime types. Note: currently not implemented.
 *
 * @see Command
 */
final class SupportedMimeTypes extends Command

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
	protected function getParams(): ?array
	{

		return array(
			array('string', 'org.mpris.MediaPlayer2'),
			array('string', 'SupportedMimeTypes'),
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
	 * @return string
	 */
	protected function formatOutput(): string
	{
		return $this->stdout;
	}

}
