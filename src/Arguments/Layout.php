<?php

namespace phOMXPlayer\Arguments;

/**
 * Set output speaker layout (e.g. 5.1).
 *
 * @see Argument
 */
final class Layout extends Argument

{
	/**
	 * @var string
	 */
	const MODE_2_0 = '2.0';
	/**
	 * @var string
	 */
	const MODE_2_1 = '2.1';
	/**
	 * @var string
	 */
	const MODE_3_0 = '3.0';
	/**
	 * @var string
	 */
	const MODE_3_1 = '3.1';
	/**
	 * @var string
	 */
	const MODE_4_0 = '4.0';
	/**
	 * @var string
	 */
	const MODE_4_1 = '4.1';
	/**
	 * @var string
	 */
	const MODE_5_0 = '5.0';
	/**
	 * @var string
	 */
	const MODE_5_1 = '5.1';
	/**
	 * @var string
	 */
	const MODE_7_0 = '7.0';
	/**
	 * @var string
	 */
	const MODE_7_1 = '7.1';

	/**
	 * @var array Default values as array.
	 */
	const ACCEPTABLE_VALUES = array(
		self::MODE_2_0,
		self::MODE_2_1,
		self::MODE_3_0,
		self::MODE_3_1,
		self::MODE_4_0,
		self::MODE_4_1,
		self::MODE_5_0,
		self::MODE_5_1,
		self::MODE_7_0,
		self::MODE_7_1,
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

		return '--layout ' . $this->value;

	}

}
