<?php

namespace phOMXPlayer\Commands;
/**
 * Returns and array of all known audio streams.
 * The length of the array is the number of streams.
 *
 * @see Command
 */
final class ListAudio extends Command
{

	/**
	 * @var string Contains the required DBusClient method.
	 */
	protected $method = 'org.mpris.MediaPlayer2.Player.ListAudio';

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
	 * Returns and array of all known audio streams.
	 * The length of the array is the number of streams.
	 *
	 * @return array
	 */
	protected function formatOutput(): array
	{

		return $this->getList();

	}

}
