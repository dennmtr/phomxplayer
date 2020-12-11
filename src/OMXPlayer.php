<?php

namespace phOMXPlayer;

use phOMXPlayer\Exception;

/**
 * phOMXPlayer - OMXPlayer wrap shell script.
 * Ready for REST/XML-RPC APIs or CLI implementations.
 *
 * Initiates a DBus session, proper configured for an OMXPlayer shell instance,
 * controlled via dbus-send commands.
 *
 * @version		0.9.9 beta
 *
 * @author		Dionisis Mitropoulos <dennmtr@gmail.com>
 *
 * @copyright	Copyright (c) 2020-2021, Dionisis Mitropoulos
 *
 * @link		https://github.com/dennmtr/phomxplayer
 * @link		https://github.com/popcornmix/omxplayer Official OMXPlayer documentation.
 *
 * Attention!
 *
 * OMXPlayer requires at least 128MB of memory reserved for GPU.
 * OMXPlayer requires a user member of video group.
 **/
final class OMXPlayer extends ShellArguments implements CommandInterface

{
	/**
	 * @var DBus Contains the active DBus instance.
	 */
	private $dbus;

	/**
	 * OMXPlayer accepts an optional array of constructor options,
	 * and an optional client of an active DBus Session.
	 *
	 * Example:
	 *
	 *     $player = new OMXPlayer([
	 *        'adev' => 'hdmi',
	 *        'blank' => true
	 *     ]);
	 *
	 * @param array|null $shell_arguments	Contains OMXPlayer configuration options
	 *
	 *  If skipped or if array is empty it will pass the default configuration options.
	 *  A null value passes no options.
	 *
	 * @param DBusClient|null $dbus			Contains an optional active DBusClient instance.
	 *
	 * @throws Exception\ShellException
	 * @see OMXPlayerArgumentsInterface		For the available shell arguments.
	 * @see CommandInterface				For the available commands.
	 * @see Config							For the list of default named keys and values.
	 */
	public function __construct(?array $shell_arguments = [], ?DBusClient $dbus = null)
	{

		if (!$this->command_exists(Config::getOMXPlayerPath())) {
			throw new Exception\ShellException('omxplayer.bin not found.');
		}

		parent::__construct($shell_arguments, Config::getDefaultPlayerArguments());

		$this->dbus = (!empty($dbus) ? $dbus : new DBusClient());

	}

	/**
	 * Terminates if exists and creates a new omxplayer shell instance.
	 *
	 * @param string $uri Contains a valid url string or an absolute path of an existing local file.
	 *
	 * @return OMXPlayer
	 * @throws Exception\OMXPlayerException
	 */
	public function play(string $uri): self
	{

		$this->kill();

		$this->cleanStdOut();

		$this->setEnv('LD_LIBRARY_PATH', '/opt/vc/lib');
		$this->setEnv('DBUS_SESSION_BUS_ADDRESS', $this->dbus->getAddress());
		$this->setEnv('DBUS_SESSION_BUS_PID', $this->dbus->getPid());

		$pid = (int)shell_exec('(nohup stdbuf -o0 ' . Config::getOMXPlayerPath().$this->getShellArgs() . ' ' . escapeshellarg($uri) . ' >>' . $this->getStdOutPath() . ' 2>&1) >/dev/null 2>&1 & echo $!');

		if (!empty($pid)) {

			$this->init($pid);

			$timeout = new TimeoutInterval();

			do {

				clearstatcache(true, $this->getStdOutPath());

				$initialized = filesize($this->getStdOutPath()) > 0;

				if ($timeout->expired()) {

					throw new Exception\OMXPlayerException('Timeout expired. OMXPlayer failed to load.');

				}

			} while (!$initialized);

		} else {

			throw new Exception\OMXPlayerException('OMXPlayer failed to load.');

		}

		return $this;

	}

	/**
	 * Whether or not the player can be controlled.
	 *
	 * @return bool
	 * @see Commands\CanControl
	 * @api
	 */
	public function canControl(): bool
	{

		$command = new Commands\CanControl();

		return $command->getFormattedOutput();

	}

	/**
	 * Returns and array of all known audio streams.
	 * The length of the array is the number of streams.
	 *
	 * @return array
	 * @api
	 * @see Commands\ListAudio
	 */
	public function listAudio(): array
	{

		$command = new Commands\ListAudio();

		return $command->getFormattedOutput();

	}

	/**
	 * Selects the audio stream at a given index.
	 *
	 * @param int $index Requested index.
	 *
	 * @return bool
	 * @throws Exception\ShellException
	 * @api
	 * @see Commands\SelectAudio
	 */
	public function selectAudio(int $index): bool
	{

		$command = new Commands\SelectAudio($index);

		return $command->getFormattedOutput();

	}

	/**
	 * Whether or not the play can skip to the next track.
	 *
	 * @return bool
	 * @api
	 * @see Commands\CanGoNext
	 */
	public function canGoNext(): bool
	{

		$command = new Commands\CanGoNext();

		return $command->getFormattedOutput();

	}

	/**
	 * Whether or not the player can skip to the previous track.
	 *
	 * @return bool
	 * @api
	 * @see Commands\CanGoPrevious
	 */
	public function canGoPrevious(): bool
	{

		$command = new Commands\CanGoPrevious();

		return $command->getFormattedOutput();

	}

	/**
	 * Whether or not the player can skip to the previous track.
	 *
	 * @return bool
	 * @api
	 * @see Commands\CanPause
	 */
	public function canPause(): bool
	{

		$command = new Commands\CanPause();

		return $command->getFormattedOutput();

	}

	/**
	 * Whether or not the player can play.
	 *
	 * @return bool
	 * @api
	 * @see Commands\CanPlay
	 */
	public function canPlay(): bool
	{

		$command = new Commands\CanPlay();

		return $command->getFormattedOutput();

	}

	/**
	 * Whether or not the player can seek.
	 *
	 * @return bool
	 * @api
	 * @see Commands\CanSeek
	 */
	public function canSeek(): bool
	{

		$command = new Commands\CanSeek();

		return $command->getFormattedOutput();

	}

	/**
	 * Returns the total length of the playing media.
	 *
	 * @return float Contains the total length in microseconds.
	 * @api
	 * @see Commands\Duration
	 */
	public function getDuration(): float
	{

		$command = new Commands\Duration();

		return $command->getFormattedOutput();

	}

	/**
	 * The current file or stream that is being played.
	 *
	 * @return string
	 * @api
	 * @see Commands\GetSource
	 */
	public function getSource(): string
	{

		$command = new Commands\GetSource();

		return $command->getFormattedOutput();

	}

	/**
	 * The current state of the player, either "Paused" or "Playing".
	 *
	 * @return bool When true then playing else paused.
	 * @api
	 * @see Commands\PlaybackStatus
	 */
	public function playbackStatus(): bool
	{

		$command = new Commands\PlaybackStatus();

		return $command->getFormattedOutput();

	}

	/**
	 * Execute a "keyboard" command.
	 *
	 * @param int $action
	 *
	 * @return Omxplayer
	 * @throws Exception\ShellException
	 * @api
	 * @see Commands\Action For the available indexed keys.
	 */
	public function action(int $action): self
	{

		new Commands\Action($action);

		return $this;

	}

	/**
	 * Mute the audio stream. If the volume is already muted, this does nothing.
	 *
	 * @return Omxplayer
	 * @api
	 * @see Commands\Mute
	 *
	 */
	public function mute(): self
	{

		new Commands\Mute();

		return $this;

	}

	/**
	 * Skip to the next chapter.
	 *
	 * @return Omxplayer
	 * @api
	 * @see Commands\Next
	 */
	public function nextChapter(): self
	{

		new Commands\Next();

		return $this;

	}

	/**
	 * Pause the video. If the video is playing, it will be paused, if it is paused it will stay in pause (no effect).
	 *
	 * @return Omxplayer
	 * @api
	 * @see Commands\Pause
	 */
	public function pause(): self
	{

		new Commands\Pause();

		return $this;

	}

	/**
	 * Seeks to a specific location in the file. This is an absolute seek.
	 *
	 * @param float $time Contains the time in microseconds. Big Int value, used Float to extend PHP_INT_MAX limit.
	 *
	 * @return Omxplayer
	 * @throws Exception\ShellException
	 * @api
	 * @see Commands\setPosition
	 */
	public function setPosition(float $time): self
	{

		new Commands\Position($time);

		return $this;

	}

	/**
	 * Returns the current position of the playing media.
	 *
	 * @return float Time in microseconds. Big Int value, used Float to extend PHP_INT_MAX limit.
	 * @api
	 * @see Commands\Position
	 */
	public function getPosition(): float
	{

		$command = new Commands\Position();

		return $command->getFormattedOutput();

	}

	/**
	 * Skip to the previous chapter.
	 *
	 * @return Omxplayer
	 * @api
	 * @see Commands\Previous
	 */
	public function previousChapter(): self
	{

		new Commands\Previous();

		return $this;

	}

	/**
	 * Set the playing rate and return the current rate.
	 * Rate of 1.0 is the normal playing rate.
	 * A value of 2.0 corresponds to two times faster than normal rate.
	 * A value of 0.5 corresponds to two times slower than the normal rate.
	 *
	 * @param float $rate Contains the rate to set.
	 *
	 * @return float        Contains the current rate.
	 * @throws Exception\ShellException
	 * @api
	 * @see Commands\Rate
	 */
	public function setRate(float $rate): float
	{

		$rate = new Commands\Rate($rate);

		return $rate->getFormattedOutput();

	}

	/**
	 * Returns the current rate.
	 *
	 * @return float
	 * @api
	 * @see Commands\Rate
	 */
	public function getRate(): float
	{

		$command = new Commands\Rate();

		return $command->getFormattedOutput();

	}

	/**
	 * Play the video. If the video is playing, it has no effect, if it is paused it will play from current position.
	 *
	 * @return OMXPlayer
	 * @api
	 * @see Commands\Play
	 */
	public function resume(): self
	{

		new Commands\Play();

		return $this;

	}

	/**
	 * Perform a relative seek, i.e. seek plus or minus a certain number of microseconds from the current position in the video.
	 *
	 * @param float $time Contains the time to seek in microseconds. backwards supported
	 *
	 * @return OMXPlayer
	 * @throws Exception\ShellException
	 * @api
	 * @see Commands\Seek
	 */
	public function seek(float $time): self
	{

		new Commands\Seek($time);

		return $this;

	}

	/**
	 * Stops the video (terminates the OMXPlayer instance).
	 *
	 * @return OMXPlayer
	 * @api
	 * @see Commands\Stop
	 */
	public function stop(): self
	{

		new Commands\Stop();

		return $this;

	}

	/**
	 * Returns a array of all known subtitles.
	 * The length of the array is the number of subtitles.
	 *
	 * @return array
	 * @api
	 * @see Commands\ListSubtitles
	 */
	public function listSubtitle(): array
	{

		$command = new Commands\ListSubtitles();

		return $command->getFormattedOutput();

	}

	/**
	 * Selects the subtitle at a given index.
	 *
	 * @param int $index Requested index.
	 *
	 * @return bool
	 * @throws Exception\ShellException
	 * @api
	 * @see Commands\SelectSubtitle
	 */
	public function selectSubtitle(int $index): bool
	{

		$command = new Commands\SelectSubtitle($index);

		return $command->getFormattedOutput();

	}

	/**
	 * Turns off subtitles.
	 *
	 * @return Omxplayer
	 * @api
	 * @see Commands\HideSubtitles
	 */
	public function hideSubtitles(): self
	{

		new Commands\HideSubtitles();

		return $this;

	}

	/**
	 * Turns on subtitles.
	 *
	 * @return Omxplayer
	 * @api
	 * @see Commands\ShowSubtitles
	 */
	public function showSubtitles(): self
	{

		new Commands\ShowSubtitles();

		return $this;

	}

	/**
	 * Toggles the play state. If the video is playing, it will be paused, if it is paused it will start playing.
	 *
	 * @return Omxplayer
	 * @api
	 * @see Commands\Toggle
	 */
	public function toggle(): self
	{

		new Commands\Toggle();

		return $this;

	}

	/**
	 * Playable URI formats.
	 *
	 * @return string
	 * @api
	 * @see Commands\SupportedUriSchemes
	 */
	public function getSupportedUriScheme(): string
	{

		$command = new Commands\SupportedUriSchemes();

		return $command->getFormattedOutput();

	}

	/**
	 * Supported mime types. Note: currently not implemented.
	 *
	 * @return string
	 * @api
	 * @see Commands\SupportedMimeTypes
	 */
	public function getSupportedMimeType(): string
	{

		$command = new Commands\SupportedMimeTypes();

		return $command->getFormattedOutput();

	}

	/**
	 * Unmute the audio stream. If the stream is already unmuted, this does nothing.
	 *
	 * @return Omxplayer
	 * @api
	 * @see Commands\Unmute
	 */
	public function unmute(): self
	{

		new Commands\Unmute();

		return $this;

	}

	/**
	 * Restart and open another URI for playing.
	 *
	 * @param string $uri
	 *
	 * @return string Contains the current uri (url or absolute file path).
	 * @throws Exception\ShellException
	 * @api
	 * @see Commands\OpenUri
	 */
	public function openUri(string $uri): string
	{

		$command = new Commands\OpenUri($uri);

		return $command->getFormattedOutput();

	}

	/**
	 * Returns and array of all known video streams.
	 * The length of the array is the number of streams.
	 * Each item in the array is a string in the following format.
	 *
	 * @return array
	 * @api
	 * @see Commands\ListVideo
	 */

	public function listVideo(): array
	{

		$command = new Commands\ListVideo();

		return $command->getFormattedOutput();

	}

	/**
	 * Return the current volume.
	 * As defined by the MPRIS specifications, this value should be greater than or equal to 0. 1 is the normal volume.
	 * Everything below is quieter than normal, everything above is louder.
	 *
	 * @return float contains the current volume. Greater than or equal to 0. 1 is the normal volume.
	 * @api
	 * @see Commands\Volume
	 *
	 */
	public function getVolumeLevel(): float
	{

		$command = new Commands\Volume();

		return $command->getFormattedOutput();

	}

	/**
	 * Set the volume and return the current volume.
	 *
	 * @param float $volume As defined by the MPRIS specifications,
	 *                            this value should be greater than or equal to 0. 1 is the normal volume.
	 *                            Everything below is quieter than normal, everything above is louder.
	 *                            Greater than or equal to 0. 1 is the normal volume.
	 *
	 * @return float
	 * @throws Exception\ShellException
	 * @api
	 * @see Commands\Volume
	 */
	public function setVolumeLevel(float $volume): float
	{

		$command = new Commands\Volume($volume);

		return $command->getFormattedOutput();

	}

}
