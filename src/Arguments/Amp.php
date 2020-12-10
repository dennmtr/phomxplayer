<?php

namespace phOMXPlayer\Arguments;

/**
 * Set initial amplification in millibels (default 0).
 *
 * @see Argument
 */
final class Amp extends Argument

{

	/**
	 * @var array Default values as array.
	 */
	const ACCEPTABLE_VALUES = array(

		[' max' => 1, 'min' => 0, 'type' => 'float', 'label' => '>=0, <=1']

	);

	/**
	 * Input value validator.
	 *
	 * @param mixed $value
	 * @return bool
	 */
	public static function isValid($value): bool
	{

		$value = self::sanitizeValue($value);

		return !empty($value) && $value >= 0 && $value <= 1;

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

		return '--amp ' . self::convertToMillibels($this->value);
	}

	/**
	 * Vol converter.
	 *
	 * @return mixed
	 */
	public static function convertToMillibels($value)
	{

		$value = self::sanitizeDecVal($value);

		return floor(2000 * (log10($value)));

	}

}
