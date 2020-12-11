<?php

namespace phOMXPlayer\Arguments;
/**
 *  Disable keyboard input (prevents hangs for certain TTYs).
 *
 * @see Argument
 */
final class NoKeys extends Argument
{
	/**
	 * @var bool Disable keyboard input.
	 */
	const ENABLED = true;
	/**
	 * @var bool Enable keyboard input.
	 */
	const DISABLED = false;
	/**
	 * @var mixed Default value.
	 */
	const DEFAULT_VALUE = self::DISABLED;
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
		return in_array($value, static::ACCEPTABLE_VALUES, true);

	}

	/**
	 * Sanitizes the input value.
	 *
	 * @param mixed $value
	 * @return bool
	 */
	public static function sanitizeValue($value): bool
	{

		return boolval($value);

	}

	/**
	 * Returns the shell argument.
	 *
	 * @return string
	 */
	public function getShellArg(): ?string
	{

		if ($this->value == self::ENABLED) {
			return '--no-keys';
		}
		return null;

	}

}
