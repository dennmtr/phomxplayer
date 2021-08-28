<?php

namespace phOMXPlayer\Arguments;
/**
 * Set orientation of video (0, 90, 180 or 270)
 *
 * @see Argument
 */
final class Orientation extends Argument
{
  /**
   * @var int
   */
  const ROTATE_0 = 0;
  /**
   * @var int
   */
  const ROTATE_90 = 90;
  /**
   * @var int
   */
  const ROTATE_180 = 180;
  /**
   * @var int
   */
  const ROTATE_270 = 270;


  /**
   * @var array Default values as array.
   */
  const ACCEPTABLE_VALUES = array(
    self::ROTATE_0,
    self::ROTATE_90,
    self::ROTATE_180,
    self::ROTATE_270
  );

  /**
   * Input value validator.
   *
   * @param mixed $value
   * @return bool
   */
  public static function isValid($value): bool
  {

    return in_array($value, static::ACCEPTABLE_VALUES, false);

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

    return '--orientation ' . $this->value;

  }

}
