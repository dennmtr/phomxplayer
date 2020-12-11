<?php

namespace phOMXPlayer\Arguments;
/**
 * Dump stream format before playback.
 *
 * @see Argument
 */
final class WithInfo extends Argument
{
	/**
	 * @var bool Show info.
	 */
	const ENABLED = true;
	/**
	 * @var bool Hide info.
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
			return '--with-info';
		}
		return null;

	}

}
