<?php

namespace phOMXPlayer\Commands;

use phOMXPlayer\Exception;

/**
 * Executes a "keyboard" command
 *
 * @see Command
 */
final class Action extends Command
{

  /*
   * Action aliases.
   */
  const BLANK = 24;
  const CHANGE_FILE = 37;
  const CROP_VIDEO = 34;
  const DECREASE_SPEED = 1;
  const DECREASE_SUBTITLE_DELAY = 13;
  const DECREASE_VOLUME = 17;
  const EXIT = 15;
  const FAST_FORWARD = 4;
  const HIDE_SUBTITLES = 30;
  const HIDE_VIDEO = 28;
  const INCREASE_SPEED = 2;
  const INCREASE_SUBTITLE_DELAY = 14;
  const INCREASE_VOLUME = 18;
  const MOVE_VIDEO = 27;
  const NEXT_AUDIO = 7;
  const NEXT_CHAPTER = 9;
  const NEXT_SUBTITLE = 11;
  const PAUSE = 35;
  const PLAY = 36;
  const PLAYPAUSE = 16;
  const PREVIOUS_AUDIO = 6;
  const PREVIOUS_CHAPTER = 8;
  const PREVIOUS_SUBTITLE = 10;
  const REWIND = 3;
  const SEEK_ABSOLUTE = 26;
  const SEEK_BACK_LARGE = 21;
  const SEEK_BACK_SMALL = 19;
  const SEEK_FORWARD_LARGE = 22;
  const SEEK_FORWARD_SMALL = 20;
  const SEEK_RELATIVE = 25;
  const SET_ALPHA = 32;
  const SET_ASPECT_MODE = 33;
  const SET_LAYER = 38;
  const SHOW_INFO = 5;
  const SHOW_SUBTITLES = 31;
  const STEP = 23;
  const TOGGLE_SUBTITLE = 12;
  const UNHIDE_VIDEO = 29;

  /*
   * Action collection.
   */
  const PLAYER_ACTIONS = [

    self::BLANK,
    self::CHANGE_FILE,
    self::CROP_VIDEO,
    self::DECREASE_SPEED,
    self::DECREASE_SUBTITLE_DELAY,
    self::DECREASE_VOLUME,
    self::EXIT,
    self::FAST_FORWARD,
    self::HIDE_SUBTITLES,
    self::HIDE_VIDEO,
    self::INCREASE_SPEED,
    self::INCREASE_SUBTITLE_DELAY,
    self::INCREASE_VOLUME,
    self::MOVE_VIDEO,
    self::NEXT_AUDIO,
    self::NEXT_CHAPTER,
    self::NEXT_SUBTITLE,
    self::PAUSE,
    self::PLAY,
    self::PLAYPAUSE,
    self::PREVIOUS_AUDIO,
    self::PREVIOUS_CHAPTER,
    self::PREVIOUS_SUBTITLE,
    self::REWIND,
    self::SEEK_ABSOLUTE,
    self::SEEK_BACK_LARGE,
    self::SEEK_BACK_SMALL,
    self::SEEK_FORWARD_LARGE,
    self::SEEK_FORWARD_SMALL,
    self::SEEK_RELATIVE,
    self::SET_ALPHA,
    self::SET_ASPECT_MODE,
    self::SET_LAYER,
    self::SHOW_INFO,
    self::SHOW_SUBTITLES,
    self::STEP,
    self::TOGGLE_SUBTITLE,
    self::UNHIDE_VIDEO,

  ];

  /**
   * @var string Contains the required DBusClient method.
   */
  protected $method = 'org.mpris.MediaPlayer2.Player.Action';

  /**
   * Returns an array with the available actions.
   *
   * @return array
   */
  public static function getAlias(): array
  {

    return array(
      'DECREASE_SPEED' => static::DECREASE_SPEED,
      'INCREASE_SPEED' => static::INCREASE_SPEED,
      'REWIND' => static::REWIND,
      'FAST_FORWARD' => static::FAST_FORWARD,
      'SHOW_INFO' => static::SHOW_INFO,
      'PREVIOUS_AUDIO' => static::PREVIOUS_AUDIO,
      'NEXT_AUDIO' => static::NEXT_AUDIO,
      'PREVIOUS_CHAPTER' => static::PREVIOUS_CHAPTER,
      'NEXT_CHAPTER' => static::NEXT_CHAPTER,
      'PREVIOUS_SUBTITLE' => static::PREVIOUS_SUBTITLE,
      'NEXT_SUBTITLE' => static::NEXT_SUBTITLE,
      'TOGGLE_SUBTITLE' => static::TOGGLE_SUBTITLE,
      'DECREASE_SUBTITLE_DELAY' => static::DECREASE_SUBTITLE_DELAY,
      'INCREASE_SUBTITLE_DELAY' => static::INCREASE_SUBTITLE_DELAY,
      'EXIT' => static::EXIT,
      'PLAYPAUSE' => static::PLAYPAUSE,
      'DECREASE_VOLUME' => static::DECREASE_VOLUME,
      'INCREASE_VOLUME' => static::INCREASE_VOLUME,
      'SEEK_BACK_SMALL' => static::SEEK_BACK_SMALL,
      'SEEK_FORWARD_SMALL' => static::SEEK_FORWARD_SMALL,
      'SEEK_BACK_LARGE' => static::SEEK_BACK_LARGE,
      'SEEK_FORWARD_LARGE' => static::SEEK_FORWARD_LARGE,
      'SEEK_RELATIVE' => static::SEEK_RELATIVE,
      'SEEK_ABSOLUTE' => static::SEEK_ABSOLUTE,
      'STEP' => static::STEP,
      'BLANK' => static::BLANK,
      'MOVE_VIDEO' => static::MOVE_VIDEO,
      'HIDE_VIDEO' => static::HIDE_VIDEO,
      'UNHIDE_VIDEO' => static::UNHIDE_VIDEO,
      'HIDE_SUBTITLES' => static::HIDE_SUBTITLES,
      'SHOW_SUBTITLES' => static::SHOW_SUBTITLES,
      'SET_ALPHA' => static::SET_ALPHA,
      'SET_ASPECT_MODE' => static::SET_ASPECT_MODE,
      'CROP_VIDEO' => static::CROP_VIDEO,
      'PAUSE' => static::PAUSE,
      'PLAY' => static::PLAY,
      'CHANGE_FILE' => static::CHANGE_FILE,
      'SET_LAYER' => static::SET_LAYER,
    );
  }

  /**
   * Returns the required DBusClient parameters.
   *
   * @return array
   */
  protected function getParams(): array
  {

    return array(
      array('int32', $this->input),
    );

  }

  /**
   * Sanitizes the input value.
   *
   * @param mixed $input
   *
   * @return int
   * @throws Exception\CommandException
   */
  protected function sanitizeInput($input): int
  {

    if (static::validateInput($input)) {
      return (int)$input;
    }
    throw new Exception\CommandException('Invalid action key.');

  }

  /**
   * Validates the input value.
   *
   * @param mixed $input
   *
   * @return bool
   */
  public static function validateInput($input = null): bool
  {

    if (is_numeric($input) && $input >= 1 && $input <= 38) return true;
    return false;

  }

  /**
   * Formats the stdout string buffer accordingly.
   *
   * @return mixed|null
   */
  protected function formatOutput()
  {
    return null;
  }

}
