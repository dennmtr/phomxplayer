<?php

namespace phOMXPlayer\Arguments;

/**
 * Subtitle alignment (default: left).
 *
 * @see Argument
 */
final class Align extends Argument

{
	/**
	 * @var string
	 */
	const ALIGN_CENTER 	= 'center';
	/**
	 * @var string
	 */
	const ALIGN_LEFT = 'left';
	/**
	 * @var string
	 */
	const ALIGN_RIGHT 	= 'right';

	/**
	 * @var array Default values as array.
	 */
	const ACCEPTABLE_VALUES = array(
		self::ALIGN_CENTER,
		self::ALIGN_LEFT,
		self::ALIGN_RIGHT
	);

	/**
	 * Input value validator.
	 *
	 * @param mixed $value
	 * @return bool
	 */
	public static function isValid($value): bool
	{

		return in_array($value, static::ACCEPTABLE_VALUES, true);

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

		return '--align ' . $this->value;

	}

}
