<?php

namespace phOMXPlayer\Commands;
/**
 * Toggles the play state. If the video is playing, it will be paused, if it is paused it will start playing.
 *
 * @see Command
 */
final class Toggle extends Command
{

  /**
   * @var string Contains the required DBusClient method.
   */
  protected $method = 'org.mpris.MediaPlayer2.Player.PlayPause';

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
   * @return array|null
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
   * @return string
   */
  protected function formatOutput()
  {
    return null;
  }

}
