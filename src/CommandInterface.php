<?php

namespace phOMXPlayer;
/**
 * Command interface for OMXPlayer Commands.
 */
interface CommandInterface
{
  /**
   * Whether or not the player can be controlled.
   *
   * @return bool
   * @api
   * @see Commands\CanControl
   */
  public function canControl(): bool;

  /**
   * Returns and array of all known audio streams.
   * The length of the array is the number of streams.
   *
   * @return array
   * @api
   * @see Commands\ListAudio
   */
  public function listAudio(): array;

  /**
   * Selects the audio stream at a given index.
   *
   * @param int $index
   * @return bool
   * @throws Exception\CommandException
   * @api
   * @see Commands\SelectAudio
   */
  public function selectAudio(int $index): bool;

  /**
   * Whether or not the play can skip to the next track.
   *
   * @return bool
   * @api
   * @see Commands\CanGoNext
   */
  public function canGoNext(): bool;

  /**
   * Whether or not the player can skip to the previous track.
   *
   * @return bool
   * @api
   * @see Commands\CanGoPrevious
   */
  public function canGoPrevious(): bool;

  /**
   * Whether or not the player can skip to the previous track.
   *
   * @return bool
   * @api
   * @see Commands\CanPause
   */
  public function canPause(): bool;

  /**
   * Whether or not the player can play.
   *
   * @return bool
   * @api
   * @see Commands\CanPlay
   */
  public function canPlay(): bool;

  /**
   * Whether or not the player can seek.
   *
   * @return bool
   * @api
   * @see Commands\CanSeek
   */
  public function canSeek(): bool;

  /**
   * Returns the total length of the playing media.
   *
   * @return float Total length in microseconds
   * @api
   * @see Commands\Duration
   */
  public function getDuration(): float;

  /**
   * The current file or stream that is being played.
   *
   * @return string
   * @api
   * @see Commands\GetSource
   */
  public function getSource(): string;

  /**
   * The current state of the player, either "Paused" or "Playing".
   *
   * @return bool True = Playing, False = Paused
   * @api
   * @see Commands\PlaybackStatus
   */
  public function playbackStatus(): bool;

  /**
   * Execute a "keyboard" command.
   *
   * @param int $action
   * @return Omxplayer
   * @throws Exception\CommandException
   * @api
   * @see Commands\Action For available codes, see Commands\Action constants.
   */
  public function action(int $action): OMXPlayer;

  /**
   * Mute the audio stream. If the volume is already muted, this does nothing.
   *
   * @return Omxplayer
   * @api
   * @see Commands\Mute
   */
  public function mute(): OMXPlayer;

  /**
   * Skip to the next chapter.
   *
   * @return Omxplayer
   * @api
   * @see Commands\Next
   */
  public function nextChapter(): OMXPlayer;

  /**
   * Pause the video. If the video is playing, it will be paused, if it is paused it will stay in pause (no effect).
   *
   * @return Omxplayer
   * @api
   * @see Commands\Pause
   */
  public function pause(): OMXPlayer;

  /**
   * Seeks to a specific location in the file. This is an absolute seek.
   *
   * @param float $time Time in microseconds. Big Int value, used Float to extend PHP_INT_MAX limit.
   *
   * @return Omxplayer
   * @throws Exception\CommandException
   * @api
   * @see Commands\Position
   */
  public function setPosition(float $time): OMXPlayer;

  /**
   * Returns the current position of the playing media.
   *
   * @return float Time in microseconds. Big Int value, used Float to extend PHP_INT_MAX limit.
   * @api
   * @see Commands\Position
   */
  public function getPosition(): float;

  /**
   * Skip to the previous chapter.
   *
   * @return Omxplayer
   * @api
   * @see Commands\Previous
   */
  public function previousChapter(): OMXPlayer;

  /**
   * Set the playing rate and return the current rate.
   * Rate of 1.0 is the normal playing rate.
   * A value of 2.0 corresponds to two times faster than normal rate, a value of 0.5 corresponds to two times slower than the normal rate.
   *
   * @param float $rate Rate to set.
   *
   * @return float Current rate
   * @throws Exception\CommandException
   * @api
   * @see Commands\Rate
   */
  public function setRate(float $rate): float;

  /**
   * Returns the current rate.
   *
   * @return float
   * @api
   * @see Commands\Rate
   */
  public function getRate(): float;

  /**
   * Play the video. If the video is playing, it has no effect, if it is paused it will play from current position.
   *
   * @return OMXPlayer
   * @api
   * @see Commands\Play
   */
  public function resume(): OMXPlayer;

  /**
   * Perform a relative seek, i.e. seek plus or minus a certain number of microseconds from the current position in the video.
   *
   * @param float $time
   * @return OMXPlayer
   * @throws Exception\CommandException
   * @api
   * @see Commands\Seek
   */
  public function seek(float $time): OMXPlayer;

  /**
   * Stops the video (terminates the OMXPlayer instance).
   *
   * @return OMXPlayer
   * @api
   * @see Commands\Stop
   *
   */
  public function stop(): OMXPlayer;

  /**
   * Returns a array of all known subtitles.
   * The length of the array is the number of subtitles.
   *
   * @return array
   * @api
   * @see Commands\ListSubtitles
   */
  public function listSubtitle(): array;

  /**
   * Selects the subtitle at a given index.
   *
   * @param int $index
   * @return bool
   * @throws Exception\CommandException
   * @api
   * @see Commands\SelectSubtitle
   */
  public function selectSubtitle(int $index): bool;

  /**
   * Turns off subtitles.
   *
   * @return Omxplayer
   * @api
   * @see Commands\HideSubtitles
   */
  public function hideSubtitles(): OMXPlayer;

  /**
   * Turns on subtitles.
   *
   * @return Omxplayer
   * @api
   * @see Commands\ShowSubtitles
   */
  public function showSubtitles(): OMXPlayer;

  /**
   * Toggles the play state. If the video is playing, it will be paused, if it is paused it will start playing.
   *
   * @return Omxplayer
   * @api
   * @see Commands\Toggle
   */
  public function toggle(): OMXPlayer;

  /**
   * Playable URI formats.
   *
   * @return string
   * @api
   * @see Commands\SupportedUriSchemes
   */
  public function getSupportedUriScheme(): string;

  /**
   * Supported mime types. Note: currently not implemented.
   *
   * @return string
   * @api
   * @see Commands\SupportedMimeTypes
   */
  public function getSupportedMimeType(): string;

  /**
   * Unmute the audio stream. If the stream is already unmuted, this does nothing.
   *
   * @return Omxplayer
   * @api
   * @see Commands\Unmute
   */
  public function unmute(): OMXPlayer;

  /**
   * Restart and open another URI for playing.
   *
   * @param string $uri
   * @return string Current Uri (Url or absolute file path)
   * @throws Exception\CommandException
   * @api
   * @see Commands\OpenUri
   */
  public function openUri(string $uri): string;

  /**
   * Returns and array of all known video streams.
   * The length of the array is the number of streams.
   * Each item in the array is a string in the following format.
   *
   * @return array
   * @api
   * @see Commands\ListVideo
   */
  public function listVideo(): array;

  /**
   * Return the current volume.
   * As defined by the MPRIS specifications, this value should be greater than or equal to 0. 1 is the normal volume.
   * Everything below is quieter than normal, everything above is louder.
   *
   * @return float Current volume. Greater than or equal to 0. 1 is the normal volume.
   * @api
   * @see Commands\Volume
   */
  public function getVolumeLevel(): float;

  /**
   * Set the volume and return the current volume.
   *
   * @param float $volume As defined by the MPRIS specifications, this value should be greater than or equal to 0. 1 is the normal volume.
   *                            Everything below is quieter than normal, everything above is louder.
   *                            Greater than or equal to 0. 1 is the normal volume.
   * @return float            Current volume
   * @throws Exception\CommandException
   * @api
   * @see Commands\Volume
   */
  public function setVolumeLevel(float $volume): float;

}
