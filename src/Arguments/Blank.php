<?php

namespace phOMXPlayer\Arguments;

/**
 * Set the video background color to black.
 *
 * @see Argument
 */
final class Blank extends Argument

{
	/**
	 * @var bool Set the video background color to black.
	 */
	const ENABLED = true;
	/**
	 * @var bool Disables the video background color.
	 */
	const DISABLED = false;

	/**
	 * @var mixed Default value.
	 */
	const DEFAULT_VALUE = self::ENABLED;

	/**
	 * @var array Default values as array.
	 */
	const ACCEPTABLE_VALUES = array(
		self::ENABLED,
		self::DISABLED
	);

	/**
	 * Input value validator.
	 *
	 * @param mixed $value
	 * @return bool
	 */
	public static function isValid($value): bool
	{

		switch (true) {

			case $value === "0":
			case $value === 0:
				$value = false;
				break;
			case $value === "1":
			case $value === 1:
				$value = true;
				break;

		}

		switch (true) {
			case in_array($value, static::ACCEPTABLE_VALUES, true):
				return true;
		}

		return false;

	}

	/**
	 * Sanitizes the input value.
	 *
	 * @param mixed $value
	 * @return string
	 */
	public static function sanitizeValue($value)
	{

		if (is_numeric($value)) return boolval($value);

		return (string)$value;

	}

	/**
	 * Returns the shell argument.
	 *
	 * @return string
	 */
	public function getShellArg(): ?string
	{

		if ($this->value == self::ENABLED) {
			return '--blank';
		}

		return null;
	}

}
