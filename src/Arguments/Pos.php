<?php

namespace phOMXPlayer\Arguments;
/**
 * Start position (hh:mm:ss).
 *
 * @see Argument
 */
final class Pos extends Argument
{
  /**
   * @var array Regex time pattern.
   */
  const REGEX_PATTERN = ['pattern' => '\d{1,2}:\d{1,2}:\d{1,2}', 'type' => 'time', 'label' => 'hh:mm:ss'];
  /**
   * @var array Default values as array.
   */
  const ACCEPTABLE_VALUES = array(
    self::REGEX_PATTERN,
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

    switch (true) {
      case is_numeric($value):
      case preg_match('/' . self::REGEX_PATTERN['pattern'] . '/', $value):
        return true;
    }
    return false;

  }

  /**
   * Sanitizes the input value.
   *
   * @param mixed $value
   * @return string
   */
  public static function sanitizeValue($value)
  {

    $position = $value;
    if (is_numeric($position)) {

      return self::formatTime($position);

    }
    return $position;

  }

  /**
   * Microseconds to hh:mm:ss format converter.
   *
   * @param float $ms
   * @return string
   */
  private static function formatTime(float $ms): string
  {
    $seconds = $ms / 1000000;
    $hours = 0;
    if ($seconds > 3600) {
      $hours = floor($seconds / 3600);
    }
    $seconds = $seconds % 3600;
    return str_pad($hours, 2, '0', STR_PAD_LEFT)
      . gmdate(':i:s', $seconds);
  }

  /**
   * Returns the shell argument.
   *
   * @return string|null
   */
  public function getShellArg(): ?string
  {

    if ($this->value !== "00:00:00") {
      return '--pos ' . $this->value;
    }
    return null;

  }

}
