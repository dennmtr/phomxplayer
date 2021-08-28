<?php
return [
  /*
  |--------------------------------------------------------------------------
  | phOMXPlayer Arguments
  |--------------------------------------------------------------------------
  |
  | 	Default configuration values.
  | 	Wrong or missing values may cause an unstable behavior.
  | 	There is no reason to override these values on a clean and fresh installed Raspberry Pi OS.
  |
  */
  /**
   * Contains the absolute path to store session files. The path MUST be writable.
   * Small files in size.
   * Default:        /dev/shm (shared memory)
   * Recommended:    /dev/shm, /tmp
   */
  'session_path' => '/dev/shm',
  /**
   * Contains the default omxplayer.bin shell arguments.
   */
  //	'default_options' => [
  //		'adev' => 'hdmi',
  //		'no-keys' => true,
  //		'blank' => true,
  //		'with-info' => true,
  //	],
  /**
   * Contains the absolute path of the omxplayer.bin binary file.
   * Define the basename of the file if its path included in PATH environment variable.
   * Default: omxplayer.bin
   */
  //'omxplayer_bin' => 'omxplayer.bin',
  /**
   * Contains the absolute path of the dbus-daemon binary file.
   * Define the basename of the file if its path included in PATH environment variable.
   * Default: dbus-daemon
   */
  //'dbus_daemon_bin' => 'dbus-daemon',
  /**
   * Contains the absolute path of the dbus-send binary file.
   * Define the basename of the file if its path included in PATH environment variable.
   * Default: dbus-send
   */
  //'dbus_client_bin' => 'dbus-send',
  /**
   * The number of milliseconds to count before timeout expiration.
   * Default: 10000 (10 sec.)
   */
  //'timeout_interval' => 10000,
];
