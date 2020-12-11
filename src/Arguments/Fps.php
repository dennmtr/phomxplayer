<?php

namespace phOMXPlayer\Arguments;

/**
 * Set fps of video where timestamps are not present.
 *
 * @see Argument
 */
final class Fps extends Argument

{

	/**
	 * @var array Default values as array.
	 */
	const ACCEPTABLE_VALUES = array(

		[' max' => 120, 'min' => 16, 'type' => 'float', 'label' => '>=16, <=120']

	);

	/**
	 * Input value validator.
	 *
	 * @param mixed $value
	 * @return bool
	 */
	public static function isValid($value): bool
	{

		$value = self::sanitizeDecVal($value);

		return !empty($value) && $value >= 16 && $value <= 120;

	}

	/**
	 * Sanitizes the input value.
	 *
	 * @param mixed $value
	 * @return float
	 */
	public static function sanitizeValue($value): float
	{

		return self::sanitizeDecVal($value);

	}

	/**
	 * Returns the shell argument.
	 *
	 * @return string
	 */
	public function getShellArg(): string
	{

		return '--fps ' . $this->value;

	}


}
