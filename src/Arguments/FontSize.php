<?php

namespace phOMXPlayer\Arguments;
/**
 * Font size in 1/1000 screen height (default: 55).
 *
 * @see Argument
 */
final class FontSize extends Argument
{

	/**
	 * @var array Default values as array.
	 */
	const ACCEPTABLE_VALUES = array(
		['type' => 'int', 'label' => 'int: font size']
	);

	/**
	 * Input value validator.
	 *
	 * @param mixed $value
	 * @return bool
	 */
	public static function isValid($value): bool
	{

		return (is_numeric($value));

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
	 * @return string|null
	 */
	public function getShellArg(): ?string
	{

		return '--font-size ' . $this->value;

	}

}
