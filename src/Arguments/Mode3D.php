<?php

namespace phOMXPlayer\Arguments;
/**
 * Switch tv into 3d mode (e.g. SBS/TB).
 *
 * @see Argument
 */
final class Mode3D extends Argument
{
	/**
	 * @var string
	 */
	const FRAME_PACKING = 'FP';
	/**
	 * @var string
	 */
	const TOP_BOTTOM = 'TB';
	/**
	 * @var string
	 */
	const SBS = 'SBS';

	/**
	 * @var array Default values as array.
	 */
	const ACCEPTABLE_VALUES = array(
		self::FRAME_PACKING,
		self::TOP_BOTTOM,
		self::SBS
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

		return '--3d ' . $this->value;

	}

}
