<?php

namespace phOMXPlayer\Commands;
/**
 * The current file or stream that is being played.
 *
 * @see Command
 */
final class GetSource extends Command
{
	/**
	 * @var string Contains the required DBusClient method.
	 */
	protected $method = 'org.mpris.MediaPlayer2.Player.GetSource';

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
	 * Returns the current source uri
	 *
	 * @return string
	 */
	protected function formatOutput(): string
	{

		return $this->stdout;

	}

}
