<?php

namespace phOMXPlayer\Arguments;

/**
 * Number of lines in the subtitle buffer (default: 3).
 *
 * @see Argument
 */
final class Lines extends Argument

{
	/**
	 * @var array Default values as array.
	 */
	const ACCEPTABLE_VALUES = array(
		['type' => 'int', 'label' => 'integer']
	);

	/**
	 * Input value validator.
	 *
	 * @param mixed $value
	 * @return bool
	 */
	public static function isValid($value): bool
	{

		return is_numeric($value);

	}

	/**
	 * Sanitizes the input value.
	 *
	 * @param mixed $value
	 * @return int
	 */
	public static function sanitizeValue($value): int
	{

		return (int)$value;

	}

	/**
	 * Returns the shell argument.
	 *
	 * @return string
	 */
	public function getShellArg(): string
	{

		return '--lines ' . $this->value;

	}

}
