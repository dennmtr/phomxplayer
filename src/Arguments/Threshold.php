<?php

namespace phOMXPlayer\Arguments;
/**
 * Amount of buffered data required to finish buffering [s].
 *
 * @see Argument
 */
final class Threshold extends Argument
{
  /**
   * @var array Default values as array.
   */
  const ACCEPTABLE_VALUES = array(
    ['type' => 'int', 'label' => 'integer']
  );

  /**
   * Input value validator.
   *
   * @param mixed $value
   * @return bool
   */
  public static function isValid($value): bool
  {

    return is_numeric($value);

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

    return '--threshold ' . $this->value;

  }

}
