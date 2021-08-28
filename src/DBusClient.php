<?php

namespace phOMXPlayer;

use phOMXPlayer\Exception;

/**
 * Broadcasts DBus commands via dbus-send.
 */
class DBusClient extends DBus
{
  /**
   * Requires an active DBus session, initializes in parent constructor.
   *
   * Example (recommended only for custom implementations):
   *
   *        $dbus_client = new DBusClient();
   *
   *        $player = new OMXPlayer([], $dbus_client); // Optional
   *
   *        if (!empty($player->pid)) {
   *                $stdout = $dbus_client->call( 'org.freedesktop.DBus.Properties.Get', [
   *                    ['string', 'org.mpris.MediaPlayer2.Player'],
   *                    ['string', 'CanControl'],
   *                ]); // Assumes an active DBus session. Returns the raw stdout buffer as string
   *          }
   *
   * @throws Exception\DBusException
   * @throws Exception\ShellException
   *
   * Alternative and recommended usage, initializing a predefined command:
   *
   * @see Commands\Command Predefined command.
   */
  public function __construct()
  {

    if (!$this->command_exists(Config::getDBusClientPath())) {
      throw new Exception\ShellException('dbus-send not found.');
    }
    parent::__construct();
    if (!$this->alive()) {

      throw new Exception\DBusException('Cannot initialize DBusClient without an active DBus session.');
    }
  }

  /**
   * Broadcasts DBus commands.
   *
   * @param string $method Contains the required method.
   * @param array|null $params Contains the optional parameters.
   * @param string|null $object_name Contains the optional object name.
   * @param array|null $options Contains the optional options.
   *
   * @return string
   *
   * @throws Exception\CommandException
   */
  public function call(string $method, ?array $params = null, ?string $object_name = null, ?array $options = null): string
  {

    if ($params === null) $params = [];
    if ($object_name === null) $object_name = Config::getDBusObjectName();
    if ($options === null) $options = Config::getDBusClientOptions();
    $this->setEnv('DBUS_SESSION_BUS_ADDRESS', $this->getAddress());
    $this->setEnv('DBUS_SESSION_BUS_PID', $this->getPid());
    $script = Config::getDBusClientPath();
    foreach ($options as $key => $val) {

      if (!empty($val)) {

        $script .= ' --' . $key . (!is_bool($val) ? '=' . $val : '');

      }
    }
    $script .= ' ' . $object_name . ' ' . $method;
    foreach ($params as $arr) {

      if (count($arr) === 2 && !empty($arr[0])) {

        $script .= ' ' . $arr[0] . ':' . $arr[1];

      }

    }
    exec($script . ' 2>&1', $stdout, $error);
    $stdout = trim(implode(PHP_EOL, $stdout));
    if ($error) {

      throw new Exception\CommandException($stdout);

    }
    return $stdout;

  }

}
