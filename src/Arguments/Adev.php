<?php

namespace phOMXPlayer\Arguments;

/**
 * Audio out device.
 *
 * @see Argument
 */
final class Adev extends Argument

{
	/**
	 * @var string HDMI audio output.
	 */
	const HDMI 	= 'hdmi';
	/**
	 * @var string Jack audio output.
	 */
	const LOCAL = 'local';
	/**
	 * @var string HDMI & Jack audio output.
	 */
	const BOTH 	= 'both';
	/**
	 * @var string Alsa:device specific.
	 */
	const ALSA 	= 'alsa';

	/**
	 * @var mixed Default value.
	 */
	const DEFAULT_VALUE = self::HDMI;

	/**
	 * @var array Default values as array.
	 */
	const ACCEPTABLE_VALUES = array(
		self::HDMI,
		self::LOCAL,
		self::BOTH,
		self::ALSA
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

		return '--adev ' . $this->value;

	}

}
