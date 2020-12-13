<?php

namespace phOMXPlayer;

use phOMXPlayer\Exception;

/**
 * Required tools and aliases for shell functionality and process
 **/
class Shell
{
	/**
	 * @var int       Contains the active pid of the current process.
	 */
	private $pid;
	/**
	 * @var string    Contains the domain abstract socket address.
	 */
	private $address;
	/**
	 * @var string    Contains the current logged in user.
	 */
	private $user;
	/**
	 * @var string    Contains the absolute file path to capture the active pid.
	 */
	private $pid_path;
	/**
	 * @var string    Contains the absolute file path to capture the stdout buffer.
	 */
	private $stdout_path;
	/**
	 * @var string    Contains the absolute file path to save the socket address.
	 */
	private $address_path;
	/**
	 * @var string    Contains the temporary path to store the session files.
	 */
	private $session_path;

	/**
	 * Shell constructor restores the current session information details for the current process.
	 *
	 * @throws Exception\ShellException
	 */
	protected function __construct()
	{

		if (!$this->check_os()) {
			throw new Exception\ShellException('This operation system is not supported.');
		}
		$this->session_path = Config::getSessionPath();
		if (!is_writable($this->session_path)) {

			throw new Exception\ShellException('Cannot write to temporary path ' . $this->session_path);

		}
		$this->user = posix_getpwuid(posix_geteuid())['name'];
		if (!$this->memberOfGroup('video')) {
			throw new Exception\ShellException("OMXPlayer requires a user member of video group.");
		}
		if (!$this->memberOfGroup('audio')) {
			throw new Exception\ShellException("OMXPlayer requires a user member of audio group.");
		}
		$prefix = $this->getFilePrefix();
		$this->pid_path = $this->session_path . '/' . $prefix . $this->user . '.pid';
		$this->address_path = $this->session_path . '/' . $prefix . $this->user . '.address';
		$this->stdout_path = $this->session_path . '/' . $prefix . $this->user . '.stdout';
		$this->init();

	}

	/**
	 * OS compatibility checker.
	 *
	 * @return bool
	 */
	private function check_os(): bool
	{

		return PHP_OS_FAMILY === "Linux";

	}

	/**
	 * Returns a file name prefix to organize the session path structure of the current process.
	 *
	 * @return string|null
	 */
	private final function getFilePrefix(): ?string
	{

		switch (true) {

			case $this instanceof OMXPlayer:
				return "omxplayer.";
				break;
			case $this instanceof DBus:
				return "dbus.";
				break;
		}
		return null;

	}

	/**
	 * Accessor. Backups and restores the current session details.
	 *
	 * @param int|null $pid Contains the current process pid to capture.
	 *
	 * @return Shell
	 */
	protected final function init(int $pid = null): self
	{

		if (is_null($pid)) {

			if (file_exists($this->pid_path)) {

				$pid = (int)file_get_contents($this->pid_path);

			}
			if (!is_null($pid) && posix_getpgid($pid)) {

				$this->pid = $pid;
				if (file_exists($this->address_path)) {

					$this->address = rtrim(file_get_contents($this->address_path));

				}

			} else {

				$this->pid = null;
				$this->address = null;
				if (file_exists($this->pid_path)) unlink($this->pid_path);
				if (file_exists($this->address_path)) unlink($this->address_path);

			}

		} else {

			$this->pid = $pid;
			file_put_contents($this->pid_path, $pid);

		}
		return $this;

	}

	/**
	 * Checks if user is member of video group name.
	 *
	 * @param string $group_name Contains the name of the group to match.
	 * @return bool
	 */
	private function memberOfGroup(string $group_name): bool
	{

		$group_info = posix_getgrnam($group_name);
		return $group_info !== false && in_array($this->user, $group_info['members'], true);

	}

	/**
	 * Returns the captured stdout buffer.
	 *
	 * @return string|null
	 */
	public function getStdOut(): ?string
	{

		return file_get_contents($this->stdout_path);

	}

	/**
	 * Command checker.
	 *
	 * @param string $command Contains the relative or the absolute file path of executable file.
	 *
	 * @return bool
	 */
	protected function command_exists($command): bool
	{

		return is_executable(rtrim(shell_exec("which $command")));

	}

	/**
	 * Returns the active socket address.
	 *
	 * @return string|null
	 */
	protected final function getAddress(): ?string
	{

		return $this->address;

	}

	/**
	 * Returns the current process pid.
	 *
	 * @return int|null
	 */
	protected final function getPid(): ?int
	{

		return $this->pid;

	}

	/**
	 * Returns the absolute file path that contains the captured socket address.
	 *
	 * @return string
	 */
	protected final function getAddressPath(): string
	{

		return $this->address_path;

	}

	/**
	 * Returns the absolute file path that contains the current process pid.
	 *
	 * @return string
	 */
	protected final function getPidPath(): string
	{

		return $this->pid_path;

	}

	/**
	 * Returns the absolute file path that contains the captured stdout content.
	 *
	 * @return string
	 */
	protected final function getStdOutPath(): string
	{

		return $this->stdout_path;

	}

	/**
	 * Soft kill of the current process pid.
	 *
	 * @param int $signal Contains the kill signal, default SIGTERM (emulates CTRL+C).
	 *
	 * @return void
	 */
	protected final function kill(int $signal = 2): void
	{

		if ($this->alive()) {

			$timeout = new TimeoutInterval();
			do {

				posix_kill($this->pid, $signal);
				$killed = posix_getpgid($this->pid) === false;
				if ($timeout->expired()) break;

			} while (!$killed);

		}

	}

	/**
	 * Whether or not the current process pid is active.
	 *
	 * @return bool
	 */
	public final function alive(): bool
	{

		return !empty($this->pid) && posix_getpgid($this->pid) !== false;

	}

	/**
	 * Alias. Creates a new environment variable for the current shell instance.
	 *
	 * @param string $key Contains the variable name.
	 * @param string $value Contains the variable value.
	 *
	 * @return void
	 */
	protected final function setEnv(string $key, string $value): void
	{

		putenv($key . '=' . $value);

	}

	/**
	 * Deletes the current stdout buffer stored as file.
	 *
	 * @return void
	 */
	protected final function cleanStdOut(): void
	{

		clearstatcache(true, $this->stdout_path);
		if (file_exists($this->stdout_path)) {

			if (is_writable($this->stdout_path)) {

				unlink($this->stdout_path);

			}
		}

	}

	/**
	 * Returns a human readable array of the stdout content.
	 *
	 * @return array|null
	 */
	protected function getFormattedStdOut(): ?array
	{

		if (!file_exists($this->stdout_path)) {
			return null;
		}
		$lines = file_get_contents($this->stdout_path);
		$length_in_seconds = null;
		$overall_bitrate = null;
		if (preg_match_all('/Duration:\s+(?P<duration>.*?)(?=,|\s).*bitrate:\s+(?P<kbps>.*?)(?=\s).*\/s/', $lines, $output_array)) {

			$length_in_seconds = $output_array['duration'][0];
			$length_in_seconds = explode(":", $length_in_seconds);
			if (count($length_in_seconds) === 3) {

				$length_in_seconds = ($length_in_seconds[0] * 3600) + ($length_in_seconds[1] * 60) + floor($length_in_seconds[2]);
				$length_in_seconds = $length_in_seconds * 1000000;

			} else {

				$length_in_seconds = null;
			}
			$overall_bitrate = (is_numeric($output_array['kbps'][0])) ? (float)$output_array['kbps'][0] : null;

		}
		$std_audio_streams = array();
		$std_video_streams = array();
		if (preg_match_all('/Program\s*\d+[\S\s]*?(?=Program|$)/', $lines, $programs) || preg_match_all('/Input\s*#[\S\s]*?(?=$)/', $lines, $programs)) {

			foreach ($programs[0] as $program) {

				$pattern = '/' .
					'Stream\s+#\d+:\d+.*:\s+Video:\s+(?P<codec>.*?)(?=\s).*,\s+(?P<color>.+?)(?=\()\((?P<scanning>.+)\),' .
					'(?:.*\s+(?P<width>\d+)x(?P<height>\d+))?' .
					'(?:.*SAR\s+(?P<sar>\d+:\d+))?' .
					'(?:.*DAR\s+(?P<dar>\d+:\d+))?' .
					'(?:.*\s+(?P<kbps>.*?)(?=\skb\/s,))?' .
					'(?:.*,\s+(?P<fps>.*?)(?=\s+fps))?' .
					'(?:.*\s*Metadata:(?:.*\s*){0,3}(?:variant_bitrate|BPS).*:\s+(?P<bps>\d+))?' .
					'/';
				if (preg_match_all($pattern, $program, $video_streams)) {

					array_push($std_video_streams, array(
						'color' => $video_streams['color'][0] ?: null,
						'scanning' => $video_streams['scanning'][0] ?: null,
						'width' => (int)$video_streams['width'][0] ?: null,
						'height' => (int)$video_streams['height'][0] ?: null,
						'sar' => $video_streams['sar'][0] ?: null,
						'dar' => $video_streams['dar'][0] ?: null,
						'fps' => (float)$video_streams['fps'][0] ?: null,
						'kbps' => (float)$video_streams['kbps'][0] ?: null,
						'bps' => (float)$video_streams['bps'][0] ?: null,
					));
				}
				$pattern = '/' .
					'Stream\s+#\d+:\d+' .
					'(?:.*\((?P<language>.*?)(?=\)))?' .
					'.*:\s+Audio:' .
					'\s+(?P<codec>.*?)(?=\s|,)' .
					'(?:.*\s+(?P<frequency>.*?)(?=\s+Hz))?' .
					'(?:\s+Hz,\s+(?P<channels>.+?)(?=,|\s))?' .
					'(?:.*\s+(?P<kbps>.*?)(?=\s).*\/s)?' .
					'(?:.*\s*Metadata:(?:.*\s*){0,3}(?:variant_bitrate|BPS).*:\s+(?P<bps>\d+))?' .
					'/';
				if (preg_match_all($pattern, $program, $audio_streams)) {

					array_push($std_audio_streams, array(
						'language' => $audio_streams['language'][0] ?: null,
						'codec' => $audio_streams['codec'][0] ?: null,
						'frequency' => (float)$audio_streams['frequency'][0] ?: null,
						'channels' => $audio_streams['channels'][0] ?: null,
						'kbps' => (float)$audio_streams['kbps'][0] ?: null,
						'bps' => (float)$audio_streams['bps'][0] ?: null
					));

				}

			}
		}
		return array(
			'duration' => $length_in_seconds,
			'bitrate' => $overall_bitrate,
			'video_streams' => $std_video_streams,
			'audio_streams' => $std_audio_streams,
		);

	}

}
