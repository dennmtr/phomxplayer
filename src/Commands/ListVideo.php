<?php

namespace phOMXPlayer\Commands;
/**
 * Returns and array of all known video streams.
 * The length of the array is the number of streams.
 * Each item in the array is a string in the following format.
 *
 * @see Command
 */
final class ListVideo extends Command
{

  /**
   * @var string Contains the required DBusClient method.
   */
  protected $method = 'org.mpris.MediaPlayer2.Player.ListVideo';

  /**
   * Validates the input value.
   *
   * @param mixed $input
   *
   * @return bool
   */
  public static function validateInput($input = null): bool
  {

    if (is_null($input)) return true;
    return false;

  }

  /**
   * Returns the required DBusClient parameters.
   *
   * @return array
   */
  protected function getParams(): ?array
  {
    return null;
  }

  /**
   * Sanitizes the input value.
   *
   * @param mixed $input
   *
   * @return null
   */
  protected function sanitizeInput($input)
  {
    return null;
  }

  /**
   * Returns and array of all known video streams.
   * The length of the array is the number of streams.
   * Each item in the array is a string in the following format.
   *
   * @return array
   */
  protected function formatOutput(): array
  {

    return $this->getList();

  }

}
