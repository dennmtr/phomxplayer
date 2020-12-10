<?php

namespace phOMXPlayer\Arguments;

/**
 * Enable/disable advanced deinterlace for HD videos (default enabled).
 *
 * @see Argument
 */
final class Advanced extends Argument

{
	/**
	 * @var int
	 */
	const ENABLED = 1;
	/**
	 * @var int
	 */
	const DISABLED = 0;
	/**
	 * @var mixed
	 */
	const DEFAULT_VALUE = null;

	/**
	 * @var array
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
				$value = 0;
				break;
			case $value === "1":
			case $value === 1:
				$value = 1;
				break;

		}

		return in_array($value, static::ACCEPTABLE_VALUES, true);

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
	public function getShellArg(): ?string
	{

		if ($this->value == self::DISABLED) {
			return '--advanced='.$this->value;
		}

		return null;

	}

}
