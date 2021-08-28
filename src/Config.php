<?php

namespace phOMXPlayer;
/**
 * Default configuration values.
 * Values can be overridden via static methods accordingly the framework or the custom implementation.
 *
 * Wrong or missing values may cause an unstable behavior.
 * There is no reason to override these values on a clean and fresh installed Raspberry Pi OS.
 */
final class Config
{
  /**
   * @var string    Contains the absolute path of the omxplayer.bin binary file.
   *                Define the basename of the file if its path included in PATH environment variable.
   *                Default:        omxplayer.bin
   */
  const OMXPLAYER_BINARY_PATH = 'omxplayer.bin';
  /**
   * @var string    Contains the absolute path of the dbus-daemon binary file.
   *                Define the basename of the file if its path included in PATH environment variable.
   *                Default:        dbus-daemon
   */
  const DBUS_DAEMON_PATH = 'dbus-daemon';
  /**
   * @var string    Contains the absolute path of the dbus-send binary file.
   *                Define the basename of the file if its path included in PATH environment variable.
   *                Default:        dbus-send
   */
  const DBUS_CLIENT_PATH = 'dbus-send';
  /**
   * @var string    Contains the absolute path to store session files. The path MUST be writable.
   *                Small files in size.
   *                Default:        /dev/shm (shared memory)
   *                Recommended:    /dev/shm, /tmp
   */
  const SESSION_PATH = '/dev/shm';
  /**
   * @var int    The number of milliseconds to count before timeout expiration.
   *                Default:        10000 (10 sec.)
   *
   * @see TimeoutInterval
   */
  const TIMEOUT_INTERVAL = 10000;

  /**
   * @var array    Contains the default dbus shell arguments to initiate a session.
   */
  const DBUS_DAEMON_ARGUMENTS = [
    'print-address' => 5,
    'print-pid' => 6,
    'fork' => true,
    'session' => true
  ];

  /**
   * @var array    Contains the default dbus-send options.
   */
  const DBUS_CLIENT_OPTIONS = [
    'print-reply' => 'literal',
    'session' => true,
    'dest' => 'org.mpris.MediaPlayer2.omxplayer',
  ];

  /**
   * @var string    Contains the default dbus-send object name.
   */
  const DBUS_CLIENT_OBJECTNAME = '/org/mpris/MediaPlayer2';

  /**
   * @var array    Contains the available omxplayer.bin shell arguments.
   */
  const PLAYER_ARGUMENT_KEYS = [
    'aidx',
    'adev',
    'with-info',
    'passthrough',
    'deinterlace',
    'nodeinterlace',
    'nativedeinterlace',
    'advanced',
    'hw',
    'mode3d',
    'allow-mvc',
    'hdmiclocksync',
    'nohdmiclocksync',
    'sid',
    'refresh',
    'pos',
    'blank',
    'loop',
    'no-boost-on-downmix',
    'vol',
    'amp',
    'no-osd',
    'no-keys',
    'subtitles',
    'font',
    'italic-font',
    'font-size',
    'align',
    'no-ghost-box',
    'lines',
    'aspect-mode',
    'threshold',
    'timeout',
    'orientation',
    'fps',
    'live',
    'layout',
    'alpha',
    'layer',
    'display',
    'cookie',
    'user-agent',
    'lavfdopts',
    'avdict',
  ];

  /**
   * @var array    Contains the default omxplayer.bin shell arguments.
   */
  const DEFAULT_PLAYER_ARGUMENTS = [
    'adev' => 'hdmi',
    'no-keys' => true,
    'blank' => true,
    'with-info' => true,
    'align' => 'center',
    'no-ghost-box' => true,
    'font-size' => 66,
  ];

  /**
   * Returns the default absolute path to store session files.
   * Default path can be overridden accordingly the framework or the custom implementation.
   *
   * @return string
   */
  public static function getSessionPath(): string
  {

    $session_path = self::SESSION_PATH;
    if (class_exists('\Illuminate\Support\Facades\Config')) {

      $session_path = \Illuminate\Support\Facades\Config::get('phomxplayer.session_path', $session_path);

    }
    return $session_path;

  }

  /**
   * Returns the default dbus-send object name.
   * The value can be overridden accordingly the framework or the custom implementation
   *
   * @return string
   */
  public static function getDBusObjectName(): string
  {

    $name = self::DBUS_CLIENT_OBJECTNAME;
    if (class_exists('\Illuminate\Support\Facades\Config')) {

      $name = \Illuminate\Support\Facades\Config::get('phomxplayer.dbus_client_object_name', $name);

    }
    return $name;

  }

  /**
   * Returns the default dbus shell arguments to initiate a session.
   * The array can be overridden accordingly the framework or the custom implementation
   *
   * @return array
   */
  public static function getDefaultDbusArguments(): array
  {

    $params = self::DBUS_DAEMON_ARGUMENTS;
    if (class_exists('\Illuminate\Support\Facades\Config')) {

      $params = array_merge($params, \Illuminate\Support\Facades\Config::get('phomxplayer.dbus_params', []));

    }
    return $params;

  }

  /**
   * Returns the default dbus-send options.
   * The array can be overridden accordingly the framework or the custom implementation
   *
   * @return array
   */
  public static function getDBusClientOptions(): array
  {

    $options = self::DBUS_CLIENT_OPTIONS;
    if (class_exists('\Illuminate\Support\Facades\Config')) {

      $options = array_merge($options, \Illuminate\Support\Facades\Config::get('phomxplayer.dbus_client_options', []));

    }
    return $options;

  }

  /**
   * Returns the default omxplayer.bin shell arguments.
   * The array can be overridden accordingly the framework or the custom implementation
   *
   * @return array
   */
  public static function getDefaultPlayerArguments(): array
  {

    $options = self::DEFAULT_PLAYER_ARGUMENTS;
    if (class_exists('\Illuminate\Support\Facades\Config')) {

      $options = array_merge($options, \Illuminate\Support\Facades\Config::get('phomxplayer.default_options', []));

    }
    array_walk($options, function (&$value, $key) {

      $key = str_replace('-', '_', $key);

    });
    return $options;

  }

  /**
   * Returns the absolute path of the omxplayer.bin binary file.
   * The path can be overridden accordingly the framework or the custom implementation.
   *
   * @return string
   */
  public static function getOMXPlayerPath(): string
  {

    $value = self::OMXPLAYER_BINARY_PATH;
    if (class_exists('\Illuminate\Support\Facades\Config')) {

      $value = \Illuminate\Support\Facades\Config::get('phomxplayer.omxplayer_bin', $value);

    }
    return $value;

  }

  /**
   * Returns the absolute path of the dbus-daemon binary file.
   * The path can be overridden accordingly the framework or the custom implementation.
   *
   * @return string
   */
  public static function getDBusDaemonPath(): string
  {

    $value = self::DBUS_DAEMON_PATH;
    if (class_exists('\Illuminate\Support\Facades\Config')) {

      $value = \Illuminate\Support\Facades\Config::get('phomxplayer.dbus_daemon_bin', $value);

    }
    return $value;

  }

  /**
   * Returns the absolute path of the dbus-send binary file.
   * The path can be overridden accordingly the framework or the custom implementation.
   *
   * @return string
   */
  public static function getDBusClientPath(): string
  {

    $value = self::DBUS_CLIENT_PATH;
    if (class_exists('\Illuminate\Support\Facades\Config')) {

      $value = \Illuminate\Support\Facades\Config::get('phomxplayer.dbus_client_bin', $value);

    }
    return $value;

  }

  /**
   * Returns the default number of milliseconds to count before timeout expiration.
   * The time can be overridden accordingly the framework or the custom implementation.
   *
   * @return int
   */
  public static function getTimeOutInterval(): int
  {

    $value = self::TIMEOUT_INTERVAL;
    if (class_exists('\Illuminate\Support\Facades\Config')) {

      $value = \Illuminate\Support\Facades\Config::get('phomxplayer.timeout_interval', $value);

    }
    return $value;

  }

}
