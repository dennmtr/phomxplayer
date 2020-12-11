<?php

namespace phOMXPlayer\Commands;
/**
 * Returns a array of all known subtitles.
 * The length of the array is the number of subtitles.
 *
 * @see Command
 */
final class ListSubtitles extends Command
{

	/**
	 * @var string Contains the required DBusClient method.
	 */
	protected $method = 'org.mpris.MediaPlayer2.Player.ListSubtitles';

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
	 * Returns a array of all known subtitles.
	 * The length of the array is the number of subtitles.
	 *
	 * @return array
	 */
	protected function formatOutput(): array
	{

		return $this->getList();

	}

}
