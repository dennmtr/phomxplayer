<?php

namespace phOMXPlayer\Arguments;
/**
 * Set video transparency (0..255).
 *
 * @see Argument
 */
final class Alpha extends Argument
{

	/**
	 * @var array Default values as array.
	 */
	const ACCEPTABLE_VALUES = array(
		['max' => 255, 'min' => 0, 'type' => 'int', 'label' => '>=0, <=255']
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
		return $value >= 0 && $value <= 255;

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

		return '--alpha ' . $this->value;
	}

}
