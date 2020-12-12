<?php

namespace phOMXPlayer\Arguments;

use phOMXPlayer\Exception;
use ReflectionClass;

/**
 * Abstract Class
 *
 * Initializes a shell argument.
 */
abstract class Argument
{

	/**
	 * @var mixed    Contains the argument's default value if input value is missing.
	 */
	const DEFAULT_VALUE = null;
	/**
	 * @var array    Contains an array with the acceptable input values.
	 */
	const ACCEPTABLE_VALUES = [];
	/**
	 * @var mixed    Contains the sanitized input value.
	 */
	protected $value;

	/**
	 * Initializes a shell argument.
	 *
	 * @param mixed $value Contains the input value.
	 * @throws Exception\ArgumentException
	 */
	public final function __construct($value = null)
	{

		if ($value === null) {
			$value = static::DEFAULT_VALUE;
		}
		if ($value === null || !static::isValid($value)) {

			$message = "";
			$accepted_values = self::getAcceptedValues(true);
			if (!empty($accepted_values)) {
				$message = ". Accepted values: " . $accepted_values;
			}

			$reflect = new ReflectionClass($this);

			throw new Exception\ArgumentException($reflect->getShortName() . ': Invalid input parameter' . $message);

		}
		$this->value = static::sanitizeValue($value);

	}

	/**
	 * Abstract method
	 *
	 * Checks if the input value is a valid argument's value.
	 *
	 * @param mixed $value
	 * @return bool
	 */
	public static abstract function isValid($value): bool;

	/**
	 * Returns a formatted string with the acceptable values.
	 * Used for error messages.
	 *
	 * @param bool $as_string If False returns an array. Default FALSE
	 * @return array|string
	 */
	public static final function getAcceptedValues(bool $as_string = false)
	{

		$values = array_map(function ($value) use ($as_string) {

			if ($as_string) {

				if (is_bool($value)) {

					return ($value ? "true" : "false");
				} else {

					if (is_array($value) && !empty($value['label'])) {
						return $value['label'];
					}

				}

			}
			return $value;

		}, static::ACCEPTABLE_VALUES);
		if ($as_string) {
			return implode(', ', $values);
		}
		return $values;

	}

	/**
	 * Abstract method
	 *
	 * Returns the input value sanitized.
	 *
	 * @param mixed $value
	 * @return mixed
	 */
	public static abstract function sanitizeValue($value);

	/**
	 * Float value sanitizer.
	 *
	 * @param mixed $value
	 * @return float|null
	 */
	protected static final function sanitizeDecVal($value = null): ?float
	{

		if (!is_numeric($value)) $value = str_replace(',', '.', $value);
		if (!is_numeric($value)) return null;
		return floatval($value);

	}

	/**
	 * Abstract method
	 *
	 * Exports the shell argument (key and value).
	 *
	 * @return string|null
	 */
	public abstract function getShellArg(): ?string;

	/**
	 * Exports the argument value without the key.
	 *
	 * @return mixed
	 */
	public final function getValue()
	{

		return $this->value;

	}

}
