<?php

namespace phOMXPlayer\Arguments;
/**
 * Letterbox, fill, stretch. Default: stretch if win is specified, letterbox otherwise.
 *
 * @see Argument
 */
final class AspectMode extends Argument
{
  /**
   * @var string
   */
  const MODE_LETTERBOX = 'letterbox';
  /**
   * @var string
   */
  const MODE_FILL = 'fill';
  /**
   * @var string
   */
  const MODE_STRETCH = 'stretch';

  /**
   * @var array Default values as array.
   */
  const ACCEPTABLE_VALUES = array(
    self::MODE_LETTERBOX,
    self::MODE_FILL,
    self::MODE_STRETCH
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

    return '--aspect-mode ' . $this->value;

  }

}
