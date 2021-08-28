<?php

namespace phOMXPlayer\Arguments;
/**
 * Set video render layer number (higher numbers are on top).
 *
 * @see Argument
 */
final class Display extends Argument
{

  /**
   * @var array Default values as array.
   */
  const ACCEPTABLE_VALUES = array(
    ['type' => 'int', 'label' => 'int: display']
  );

  /**
   * Input value validator.
   *
   * @param mixed $value
   * @return bool
   */
  public static function isValid($value): bool
  {

    return (is_numeric($value));

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
   * @return string|null
   */
  public function getShellArg(): ?string
  {

    return '--display ' . $this->value;

  }

}
