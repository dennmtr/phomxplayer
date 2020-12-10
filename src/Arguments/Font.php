<?php

namespace phOMXPlayer\Arguments;

/**
 * Default: /usr/share/fonts/truetype/freefont/FreeSans.ttf.
 *
 * @see Argument
 */
final class Font extends Argument

{

	/**
	 * @var array Default values as array.
	 */
	const ACCEPTABLE_VALUES = array(
		['type' => 'string', 'label' => 'string: a valid absolute file path']
	);

	/**
	 * Input value validator.
	 *
	 * @param mixed $value
	 * @return bool
	 */
	public static function isValid($value): bool
	{

		return !empty($value) && file_exists($value);

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

		return '--font ' . escapeshellarg($this->value);

	}

}
