<?php

namespace phOMXPlayer\Arguments;
/**
 * Loop file. Ignored if file not seekable.
 *
 * @see Argument
 */
final class Loop extends Argument
{
  /**
   * @var bool
   */
  const ENABLED = true;
  /**
   * @var bool
   */
  const DISABLED = false;
  /**
   * @var mixed
   */
  const DEFAULT_VALUE = self::DISABLED;

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
      return '--loop';
    }
    return null;

  }

}
