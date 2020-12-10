<?php

namespace phOMXPlayer\Arguments;

/**
 * Options passed to demuxer, e.g., 'rtsp_transport:tcp,...'.
 *
 * @see Argument
 */
final class Avdict extends Argument

{

	/**
	 * @var array Default values as array.
	 */
	const ACCEPTABLE_VALUES = array(
		['type' => 'string', 'label' => 'string']
	);

	/**
	 * Input value validator.
	 *
	 * @param mixed $value
	 * @return bool
	 */
	public static function isValid($value): bool
	{

		return !empty($value);

	}

	/**
	 * Sanitizes the input value.
	 *
	 * @param mixed $value
	 * @return string
	 */
	public static function sanitizeValue($value): string
	{

		return (string)$value;

	}

	/**
	 * Returns the shell argument.
	 *
	 * @return string
	 */
	public function getShellArg(): string
	{

		return '--avdict ' . escapeshellarg($this->value);

	}

}
