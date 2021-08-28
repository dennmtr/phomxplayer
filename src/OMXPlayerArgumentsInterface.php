<?php

namespace phOMXPlayer;
/**
 * Arguments interface for OMXPlayer shell arguments.
 */
interface OMXPlayerArgumentsInterface
{
  /**
   * Sets the adev option value
   * Audio out device  : e.g. hdmi/local/both/alsa[:device]
   *
   * @param mixed $value
   *
   * @return ShellArguments
   * @throws Exception\ArgumentException
   * @api
   * @see Arguments\Adev
   */
  public function adev($value): ShellArguments;

  /**
   * Sets the no-keys option value
   * Disable keyboard input (prevents hangs for certain TTYs)
   *
   * @param mixed $value
   *
   * @return ShellArguments
   * @throws Exception\ArgumentException
   * @api
   * @see Arguments\NoKeys
   */
  public function no_keys($value): ShellArguments;

  /**
   * Set the video background color to black (or optional ARGB value)
   *
   * @param mixed $value
   *
   * @return ShellArguments
   * @throws Exception\ArgumentException
   * @api
   * @see Arguments\Blank
   */
  public function blank($value): ShellArguments;

  /**
   * Sets the with-info option value
   *
   * @param mixed $value
   *
   * @return ShellArguments
   * @throws Exception\ArgumentException
   * @api
   * @see Arguments\WithInfo
   */
  public function with_info($value): ShellArguments;

  /**
   * Sets the with-info option value,
   * dump stream format before playback
   *
   * @param mixed $value
   *
   * @return ShellArguments
   * @throws Exception\ArgumentException
   * @api
   * @see Arguments\Pos
   */
  public function pos($value): ShellArguments;

  /**
   * Sets the pos option value
   * Start position (hh:mm:ss)
   *
   * @param mixed $value
   *
   * @return ShellArguments
   * @throws Exception\ArgumentException
   * @api
   * @see Arguments\Fps
   */
  public function fps($value): ShellArguments;

  /**
   * Set fps of video where timestamps are not present
   *
   * @param mixed $value
   *
   * @return ShellArguments
   * @throws Exception\ArgumentException
   * @see Arguments\Aidx
   */
  public function aidx($value): ShellArguments;

  /**
   * Show subtitle with index
   *
   * @param mixed $value
   *
   * @return ShellArguments
   * @throws Exception\ArgumentException
   * @see Arguments\Sid
   */
  public function sid($value): ShellArguments;

  /**
   * Sets the with-info option value
   *
   * @param mixed $value
   *
   * @return ShellArguments
   * @throws Exception\ArgumentException
   * @api
   * @see Arguments\Passthrough
   */
  public function passthrough($value): ShellArguments;

  /**
   * Force deinterlacing
   *
   * @param mixed $value
   *
   * @return ShellArguments
   * @throws Exception\ArgumentException
   * @see Arguments\Deinterlace
   */
  public function deinterlace($value): ShellArguments;

  /**
   * Force no deinterlacing
   *
   * @param mixed $value
   *
   * @return ShellArguments
   * @throws Exception\ArgumentException
   * @see Arguments\NoDeInterlace
   */
  public function nodeinterlace($value): ShellArguments;

  /**
   * Let display handle interlace.
   *
   * @param mixed $value
   *
   * @return ShellArguments
   * @throws Exception\ArgumentException
   * @see Arguments\NativeDeinterlace
   */
  public function nativedeinterlace($value): ShellArguments;

  /**
   * Hw audio decoding.
   *
   * @param mixed $value
   *
   * @return ShellArguments
   * @throws Exception\ArgumentException
   * @see Arguments\Hw
   */
  public function hw($value): ShellArguments;

  /**
   * Allow decoding of both views of MVC stereo stream.
   *
   * @param mixed $value
   *
   * @return ShellArguments
   * @throws Exception\ArgumentException
   * @see Arguments\AllowMvc
   */
  public function allow_mvc($value): ShellArguments;

  /**
   * Display refresh rate to match video (default).
   *
   * @param mixed $value
   *
   * @return ShellArguments
   * @throws Exception\ArgumentException
   * @see Arguments\HdmiClockSync
   */
  public function hdmiclocksync($value): ShellArguments;

  /**
   * Do not adjust display refresh rate to match video.
   *
   * @param mixed $value
   *
   * @return ShellArguments
   * @throws Exception\ArgumentException
   * @see Arguments\NoHdmiClockSync
   */
  public function nohdmiclocksync($value): ShellArguments;

  /**
   * Do not adjust display refresh rate to match video.
   *
   * @param mixed $value
   *
   * @return ShellArguments
   * @throws Exception\ArgumentException
   * @see Arguments\Refresh
   */
  public function refresh($value): ShellArguments;

  /**
   * Loop file. Ignored if file not seekable.
   *
   * @param mixed $value
   *
   * @return ShellArguments
   * @throws Exception\ArgumentException
   * @see Arguments\Loop
   */
  public function loop($value): ShellArguments;

  /**
   * Don't boost volume when downmixing.
   *
   * @param mixed $value
   *
   * @return ShellArguments
   * @throws Exception\ArgumentException
   * @see Arguments\NoBoostOnDownmix
   */
  public function no_boost_on_downmix($value): ShellArguments;

  /**
   *  Do not display status information on screen.
   *
   * @param mixed $value
   *
   * @return ShellArguments
   * @throws Exception\ArgumentException
   * @see Arguments\NoOsd
   */
  public function no_osd($value): ShellArguments;

  /**
   *  No semitransparent boxes behind subtitles.
   *
   * @param mixed $value
   *
   * @return ShellArguments
   * @throws Exception\ArgumentException
   * @see Arguments\NoGhostBox
   */
  public function no_ghost_box($value): ShellArguments;

  /**
   *  Set for live tv or vod type stream.
   *
   * @param mixed $value
   *
   * @return ShellArguments
   * @throws Exception\ArgumentException
   * @see Arguments\Live
   */
  public function live($value): ShellArguments;

  /**
   *  Enable/disable advanced deinterlace for HD videos (default enabled).
   *
   * @param mixed $value
   *
   * @return ShellArguments
   * @throws Exception\ArgumentException
   * @see Arguments\Advanced
   */
  public function advanced($value): ShellArguments;

  /**
   *  Switch tv into 3d mode (e.g. SBS/TB).
   *
   * @param mixed $value
   *
   * @return ShellArguments
   * @throws Exception\ArgumentException
   * @see Arguments\Mode3D
   */
  public function mode3d($value): ShellArguments;

  /**
   *  Set initial amplification in millibels (default 0).
   *
   * @param mixed $value
   *
   * @return ShellArguments
   * @throws Exception\ArgumentException
   * @see Arguments\Amp
   */
  public function amp($value): ShellArguments;

  /**
   *  Set initial volume in millibels (default 0).
   *
   * @param mixed $value
   *
   * @return ShellArguments
   * @throws Exception\ArgumentException
   * @see Arguments\Vol
   */
  public function vol($value): ShellArguments;

  /**
   *  External subtitles in UTF-8 srt format.
   *
   * @param mixed $value
   *
   * @return ShellArguments
   * @throws Exception\ArgumentException
   * @see Arguments\Subtitles
   */
  public function subtitles($value): ShellArguments;

  /**
   *  Default: /usr/share/fonts/truetype/freefont/FreeSans.ttf.
   *
   * @param mixed $value
   *
   * @return ShellArguments
   * @throws Exception\ArgumentException
   * @see Arguments\Font
   */
  public function font($value): ShellArguments;

  /**
   *  Font size in 1/1000 screen height (default: 55).
   *
   * @param mixed $value
   *
   * @return ShellArguments
   * @throws Exception\ArgumentException
   * @see Arguments\FontSize
   */
  public function font_size($value): ShellArguments;

  /**
   *  Subtitle alignment (default: left).
   *
   * @param mixed $value
   *
   * @return ShellArguments
   * @throws Exception\ArgumentException
   * @see Arguments\Align
   */
  public function align($value): ShellArguments;

  /**
   *  Number of lines in the subtitle buffer (default: 3).
   *
   * @param mixed $value
   *
   * @return ShellArguments
   * @throws Exception\ArgumentException
   * @see Arguments\Lines
   */
  public function lines($value): ShellArguments;

  /**
   *  Letterbox, fill, stretch. Default: stretch if win is specified, letterbox otherwise.
   *
   * @param mixed $value
   *
   * @return ShellArguments
   * @throws Exception\ArgumentException
   * @see Arguments\AspectMode
   */
  public function aspect_mode($value): ShellArguments;

  /**
   *  Amount of buffered data required to finish buffering [s].
   *
   * @param mixed $value
   *
   * @return ShellArguments
   * @throws Exception\ArgumentException
   * @see Arguments\Threshold
   */
  public function threshold($value): ShellArguments;

  /**
   *  Timeout for stalled file/network operations (default 10s).
   *
   * @param mixed $value
   *
   * @return ShellArguments
   * @throws Exception\ArgumentException
   * @see Arguments\Timeout
   */
  public function timeout($value): ShellArguments;

  /**
   *  Set orientation of video (0, 90, 180 or 270).
   *
   * @param mixed $value
   *
   * @return ShellArguments
   * @throws Exception\ArgumentException
   * @see Arguments\Orientation
   */
  public function orientation($value): ShellArguments;

  /**
   *  Set output speaker layout (e.g. 5.1).
   *
   * @param mixed $value
   *
   * @return ShellArguments
   * @throws Exception\ArgumentException
   * @see Arguments\Layout
   */
  public function layout($value): ShellArguments;

  /**
   *  Set video render layer number (higher numbers are on top).
   *
   * @param mixed $value
   *
   * @return ShellArguments
   * @throws Exception\ArgumentException
   * @see Arguments\Layer
   */
  public function layer($value): ShellArguments;

  /**
   *  Set video transparency (0..255).
   *
   * @param mixed $value
   *
   * @return ShellArguments
   * @throws Exception\ArgumentException
   * @see Arguments\Alpha
   */
  public function alpha($value): ShellArguments;

  /**
   *  Set display to output to.
   *
   * @param mixed $value
   *
   * @return ShellArguments
   * @throws Exception\ArgumentException
   * @see Arguments\Display
   */
  public function display($value): ShellArguments;

  /**
   *  Send specified cookie as part of HTTP requests.
   *
   * @param mixed $value
   *
   * @return ShellArguments
   * @throws Exception\ArgumentException
   * @see Arguments\Cookie
   */
  public function cookie($value): ShellArguments;

  /**
   * Send specified User-Agent as part of HTTP requests.
   *
   * @param mixed $value
   *
   * @return ShellArguments
   * @throws Exception\ArgumentException
   * @see Arguments\UserAgent
   */
  public function user_agent($value): ShellArguments;

  /**
   * Options passed to libavformat, e.g. 'probesize:250000,...'.
   *
   * @param mixed $value
   *
   * @return ShellArguments
   * @throws Exception\ArgumentException
   * @see Arguments\Lavfdopts
   */
  public function lavfdopts($value): ShellArguments;

  /**
   * Options passed to demuxer, e.g., 'rtsp_transport:tcp,...'.
   *
   * @param mixed $value
   *
   * @return ShellArguments
   * @throws Exception\ArgumentException
   * @see Arguments\Avdict
   */
  public function avdict($value): ShellArguments;

  /**
   * Default: /usr/share/fonts/truetype/freefont/FreeSansOblique.ttf.
   *
   * @param mixed $value
   *
   * @return ShellArguments
   * @throws Exception\ArgumentException
   * @see Arguments\ItalicFont
   */
  public function italic_font($value): ShellArguments;


}
