<?php /** @noinspection PhpUndefinedClassInspection */

namespace phOMXPlayer\Commands;

use phOMXPlayer\DBusClient;
use phOMXPlayer\Exception;

/**
 *   Abstract class
 *   Predefines a custom DBusClient command.
 **/
abstract class Command extends DBusClient
{

	/**
	 * @var mixed	Contains the input value.
	 */
	protected $input;
	/**
	 * @var string 	Contains the stdout buffer.
	 */
	protected $stdout;

	/**
	 *   Initializes a new DBusClient instance and executes the predefined command.
	 *
	 *   Example:
	 *
	 *     $command = new Commands\PredefinedCommand();
	 *
	 *     $output = $command->getFormattedOutput(); // Returns the stdout buffer formatted accordingly
	 *     $stdout = $command->getStdOut(); // Returns the raw stdout buffer always as string
	 *
	 *   // Setting Volume
	 *
	 *     $input = 0.5;
	 *
	 *     if (Commands\Volume::validateInput($input)) {
	 *        $command = new Commands\Volume($input);
	 *        $new_volume_level = $command->getFormattedOutput(); // Returns float
	 *     }
	 *
	 * @param mixed $input Contains the value for setting.
	 *
	 * @throws CommandException
	 * @throws DBusException
	 * @throws Exception\ShellException
	 */
	public final function __construct($input = null)
	{

		if (empty($this->method)) {

			throw new Exception\CommandException('Method name cannot be empty.');
		}

		parent::__construct();

		$this->input = $this->sanitizeInput($input);

		$this->stdout = $this->call($this->method, $this->getParams());

	}

	/**
	 * Abstract Method
	 * Sanitizes input value.
	 *
	 * @param mixed $input Contains the input value.
	 * @return mixed
	 */
	protected abstract function sanitizeInput($input);

	/**
	 * Abstract Method
	 * Returns the array of DBusClient parameters defined in sub-class.
	 *
	 * @return array|null
	 */
	protected abstract function getParams(): ?array;

	/**
	 * Abstract Method
	 * Checks if the input value is a valid value for this command.
	 *
	 * @param mixed $input Contains the input value.
	 *
	 * @static
	 * @return bool
	 */
	public static abstract function validateInput($input = null): bool;

	/**
	 * Returns the stdout buffer as a raw string
	 *
	 * @return string|null
	 */
	public final function getStdOut(): ?string
	{

		return $this->stdout;
	}

	/**
	 * Returns the stdout buffer formatted accordingly
	 *
	 * @return mixed
	 */
	public final function getFormattedOutput()
	{

		return $this->formatOutput();
	}

	/**
	 * Abstract Method

	 * @return mixed
	 * @see getFormattedOutput
	 */
	protected abstract function formatOutput();

	/**
	 * Converts the proper stdout string in array
	 *
	 * @return array
	 */
	protected function getList(): array
	{

		preg_match_all('/(\d+?)(?=:):(.*?)(?=:):(.*?)(?=:):(.*?)(?=:):(.*?)(?=\s{3})/', $this->stdout, $output_array);

		$outer = [];
		$inner = [];

		for ($i = 0; $i < count($output_array[0]); $i++) {
			unset($inner);
			$inner = null;
			if (count($output_array) > 2) {
				$inner = [];
				for ($j = 2; $j < count($output_array); $j++) {
					$value = trim((string)$output_array[$j][$i]);
					switch ($j) {
						case 5:
							$value = false;
							if ($output_array[$j][$i] === "active") {
								$value = true;
							}
							break;
						default:
							switch (true) {
								case $value === "true":
									$value = true;
									break;
								case $value === "false":
									$value = false;
									break;
								case is_numeric($value):
									$value = (float)$value;
									break;
								case empty($value):
									$value = null;
									break;
							}
							break;
					}

					$inner[] = $value;
				}
			}
			$outer[] = $inner;
		}

		return $outer;

	}

}
