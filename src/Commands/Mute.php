<?php

namespace phOMXPlayer\Commands;
/**
 * Mute the audio stream. If the volume is already muted, this does nothing.
 *
 * @see Command
 */
final class Mute extends Command
{

  /**
   * @var string Contains the required DBusClient method.
   */
  protected $method = 'org.mpris.MediaPlayer2.Player.Mute';

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
   * Formats the stdout string buffer accordingly.
   *
   * @return null
   */
  protected function formatOutput()
  {
    return null;
  }

}
