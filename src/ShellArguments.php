<?php

namespace phOMXPlayer;

use phOMXPlayer\Arguments\Argument;

/**
 * Initializes the proper stack of shell arguments before execution.
 **/
class ShellArguments extends Shell implements OMXPlayerArgumentsInterface, DBusArgumentsInterface

{
	/**
	 * @var array Contains the array of current arguments.
	 */
	private $arguments;

	/**
	 *    If you need to validate or extract an argument value, consider accordingly the information below.
	 *
	 *    Example:
	 *
	 * @param array|null $arguments contains an array of named keys and mixed values
	 *
	 * 		$arguments = [
	 * 			'adev' => 'hdmi',
	 * 			'blank' => true,
	 * 			'no-keys' => true
	 * 		];
	 *
	 *      $player = new OMXPlayer($arguments);
	 *
	 *      $player->adev; 					// Returns the Arguments\Adev instance via magic method if exists or null.
	 *      $player->adev->getShellArg(); 	// Returns '--adev hdmi' string, later passed in omxplayer execution.
	 *      $player->adev->getValue(); 		// Returns 'hdmi' string.
	 *      $player->adev = 'local'; 		// Sets a new adev argument instance with its variant value via magic method.
	 *      $player->adev->getValue(); 		// Returns 'local' string.
	 *
	 *      $player->map([
	 *         	'adev' => 'both',
	 *			'with-info' => false
	 *      ]);
	 *
	 *		$player->adev->getValue(); 		// Returns 'both' string.
	 *		$player->with_info->getValue(); // Returns false bool.
	 *		$player->blank->getValue(); 	// Returns true bool.
	 *
	 *		$player->map([
	 *			'adev' => new Arguments\Adev(Arguments\Adev::HDMI),
	 *			'blank' => new Arguments\Blank(false),
	 *			'with-info' => true,
	 *		]);
	 *
	 *		$player->adev->getValue(); 		// Returns 'hdmi' string.
	 *		$player->getShellArgs(false) 	// Returns '--adev hdmi --no-keys --with-info' string.
	 *
	 *		$input = true;
	 *
	 *		if (Arguments\Adev::isValid($input)) {
	 *			$player->adev = $input; 	// It will never reach here because boolean true is not a valid Adev value.
	 *		}
	 *
	 *		$player->adev = $input; 		// It will throw an ArgumentException because boolean true is not a valid Adev value.
	 *
	 * @param array|null $defaults Contains the default arguments of sub-class.
	 *
	 * @throws Exception\ShellException
	 * @see Arguments\Argument
	 */
	public function __construct(?array $arguments = [], ?array $defaults = [])
	{

		parent::__construct();

		$this->arguments = [];

		if (!is_null($arguments)) {

			$arguments = array_merge($defaults, $arguments);

			$this->map($arguments);

		}

	}

	/**
	 * Appends an array of arguments.
	 *
	 * @param array $arguments Contains the arguments to append.
	 *
	 * @return ShellArguments
	 */
	public final function map(iterable $arguments): self
	{

		foreach ($arguments as $key => $argument) {

			if (is_string($key) && !empty($key)) {

				$key = str_replace('-', '_', $key);

				if ($argument instanceof Argument) {

					$this->arguments[$key] = $argument;

				} else {

					$this->$key = $argument;

				}

			}

		}

		return $this;

	}

	/**
	 * Magic method
	 * Returns the instance of the requested argument.
	 *
	 * @param string $argument Contains the named key.
	 *
	 * @return Argument|null
	 */
	public function __get(string $argument): ?Argument
	{

		return $this->arguments[$argument] ?? null;

	}

	/**
	 * Magic method
	 * Updates the arguments collection with a new argument instance with its input value.
	 *
	 * @param string $argument 	Contains the named key.
	 * @param mixed $value 		Contains the value.
	 *
	 * @return ShellArguments
	 */
	public function __set(string $argument, $value): self

	{

		$this->$argument($value);

		return $this;

	}

	/**
	 * Returns all the arguments as string.
	 *
	 * @param bool $leading_space 	Prepends a leading space in string. default TRUE.
	 * @param bool $as_array 		If TRUE returns the arguments as array.
	 *
	 * @return string|array
	 */
	public function getShellArgs(bool $leading_space = true, bool $as_array = false)
	{

		$arguments = array_map(function (Argument $argument) {

			return trim($argument->getShellArg());

		}, $this->arguments);

		$arguments = array_filter($arguments);

		return (!$as_array ? ($leading_space ? ' ' : '').implode(' ', $arguments) : $arguments);

	}

	/**
	 * Sets the adev argument value.
	 * Audio out device      : e.g. hdmi/local/both/alsa[:device]
	 *
	 * @param mixed $value
	 *
	 * @return ShellArguments
	 * @throws Exception\ArgumentException
	 * @see Arguments\Adev
	 */
	public function adev($value): self
	{

		$this->arguments['adev'] = new Arguments\Adev($value);

		return $this;

	}

	/**
	 * Sets the no-keys argument value.
	 * Disable keyboard input (prevents hangs for certain TTYs).
	 *
	 * @param mixed $value
	 *
	 * @return ShellArguments
	 * @throws Exception\ArgumentException
	 * @see Arguments\NoKeys
	 */
	public function no_keys($value): self
	{

		$this->arguments['no_keys'] = new Arguments\NoKeys($value);

		return $this;

	}

	/**
	 * Set the video background color to black (or optional ARGB value).
	 *
	 * @param mixed $value
	 *
	 * @return ShellArguments
	 * @throws Exception\ArgumentException
	 * @see Arguments\Blank
	 */
	public function blank($value): self
	{

		$this->arguments['blank'] = new Arguments\Blank($value);

		return $this;

	}

	/**
	 * Sets the with-info argument value
	 * dump stream format before playback
	 *
	 * @param mixed $value
	 *
	 * @return ShellArguments
	 * @throws Exception\ArgumentException
	 * @see Arguments\WithInfo
	 */
	public function with_info($value): self
	{

		$this->arguments['with_info'] = new Arguments\WithInfo($value);

		return $this;

	}

	/**
	 * Sets the pos argument value
	 * Start position (hh:mm:ss)
	 *
	 * @param mixed $value
	 *
	 * @return ShellArguments
	 * @throws Exception\ArgumentException
	 * @see Arguments\Pos
	 */
	public function pos($value): self
	{

		$this->arguments['pos'] = new Arguments\Pos($value);

		return $this;

	}

	/**
	 * Set fps of video where timestamps are not present.
	 *
	 * @param mixed $value
	 *
	 * @return ShellArguments
	 * @throws Exception\ArgumentException
	 * @see Arguments\Fps
	 */
	public function fps($value): self
	{

		$this->arguments['fps'] = new Arguments\Fps($value);

		return $this;

	}

	/**
	 * Sets the aidx argument value
	 * Audio stream index    : e.g. 1
	 *
	 * @param mixed $value
	 *
	 * @return ShellArguments
	 * @throws Exception\ArgumentException
	 * @see Arguments\Aidx
	 */
	public function aidx($value): self
	{

		$this->arguments['aidx'] = new Arguments\Aidx($value);

		return $this;

	}

	/**
	 * Show subtitle with index
	 *
	 * @param mixed $value
	 *
	 * @return ShellArguments
	 * @throws Exception\ArgumentException
	 * @see Arguments\Sid
	 */
	public function sid($value): self
	{

		$this->arguments['sid'] = new Arguments\Sid($value);

		return $this;

	}

	/**
	 * @param mixed $value
	 *
	 * @return ShellArguments
	 * @throws Exception\ArgumentException
	 * @see Arguments\PrintAddress
	 */
	public function print_address($value): self
	{

		$this->arguments['print_address'] = new Arguments\PrintAddress($value);

		return $this;

	}

	/**
	 * @param mixed $value
	 *
	 * @return ShellArguments
	 * @throws Exception\ArgumentException
	 * @see Arguments\PrintPid
	 */
	public function print_pid($value): self
	{

		$this->arguments['print_pid'] = new Arguments\PrintPid($value);

		return $this;

	}

	/**
	 * @param mixed $value
	 *
	 * @return ShellArguments
	 * @throws Exception\ArgumentException
	 * @see Arguments\Session
	 */
	public function session($value): self
	{

		$this->arguments['session'] = new Arguments\Session($value);

		return $this;

	}

	/**
	 * @param mixed $value
	 *
	 * @return ShellArguments
	 * @throws Exception\ArgumentException
	 * @see Arguments\Fork
	 */
	public function fork($value): self
	{

		$this->arguments['fork'] = new Arguments\Fork($value);

		return $this;

	}

	/**
	 * @param mixed $value
	 *
	 * @return ShellArguments
	 * @throws Exception\ArgumentException
	 * @see Arguments\Passthrough
	 */
	public function passthrough($value): self
	{

		$this->arguments['passthrough'] = new Arguments\Passthrough($value);

		return $this;

	}

	/**
	 * @param mixed $value
	 *
	 * @return ShellArguments
	 * @throws Exception\ArgumentException
	 * @see Arguments\Deinterlace
	 */
	public function deinterlace($value): self
	{

		$this->arguments['deinterlace'] = new Arguments\Deinterlace($value);

		return $this;

	}

	/**
	 * @param mixed $value
	 *
	 * @return ShellArguments
	 * @throws Exception\ArgumentException
	 * @see Arguments\NoDeinterlace
	 */
	public function nodeinterlace($value): self
	{

		$this->arguments['nodeinterlace'] = new Arguments\NoDeinterlace($value);

		return $this;

	}

	/**
	 * Let display handle interlace.
	 *
	 * @param mixed $value
	 *
	 * @return ShellArguments
	 * @throws Exception\ArgumentException
	 * @see Arguments\NativeDeinterlace
	 */
	public function nativedeinterlace($value): self
	{

		$this->arguments['nativedeinterlace'] = new Arguments\NativeDeinterlace($value);

		return $this;

	}

	/**
	 * Hw audio decoding.
	 *
	 * @param mixed $value
	 *
	 * @return ShellArguments
	 * @throws Exception\ArgumentException
	 * @see Arguments\Hw
	 */
	public function hw($value): self
	{

		$this->arguments['hw'] = new Arguments\Hw($value);

		return $this;

	}

	/**
	 * Allow decoding of both views of MVC stereo stream.
	 *
	 * @param mixed $value
	 *
	 * @return ShellArguments
	 * @throws Exception\ArgumentException
	 * @see Arguments\AllowMvc
	 */
	public function allow_mvc($value): self
	{

		$this->arguments['allow_mvc'] = new Arguments\AllowMvc($value);

		return $this;

	}

	/**
	 * Display refresh rate to match video (default).
	 *
	 * @param mixed $value
	 *
	 * @return ShellArguments
	 * @throws Exception\ArgumentException
	 * @see Arguments\HdmiClockSync
	 */
	public function hdmiclocksync($value): self
	{

		$this->arguments['hdmiclocksync'] = new Arguments\HdmiClockSync($value);

		return $this;

	}

	/**
	 * Do not adjust display refresh rate to match video.
	 *
	 * @param mixed $value
	 *
	 * @return ShellArguments
	 * @throws Exception\ArgumentException
	 * @see Arguments\NoHdmiClockSync
	 */
	public function nohdmiclocksync($value): self
	{

		$this->arguments['nohdmiclocksync'] = new Arguments\NoHdmiClockSync($value);

		return $this;

	}

	/**
	 * Do not adjust display refresh rate to match video.
	 *
	 * @param mixed $value
	 *
	 * @return ShellArguments
	 * @throws Exception\ArgumentException
	 * @see Arguments\Refresh
	 */
	public function refresh($value): self
	{

		$this->arguments['refresh'] = new Arguments\Refresh($value);

		return $this;

	}

	/**
	 * Loop file. Ignored if file not seekable.
	 *
	 * @param mixed $value
	 *
	 * @return ShellArguments
	 * @throws Exception\ArgumentException
	 * @see Arguments\Loop
	 */
	public function loop($value): self
	{

		$this->arguments['loop'] = new Arguments\Loop($value);

		return $this;

	}

	/**
	 * Don't boost volume when downmixing.
	 *
	 * @param mixed $value
	 *
	 * @return ShellArguments
	 * @throws Exception\ArgumentException
	 * @see Arguments\NoBoostOnDownmix
	 */
	public function no_boost_on_downmix($value): self
	{

		$this->arguments['no_boost_on_downmix'] = new Arguments\NoBoostOnDownmix($value);

		return $this;

	}

	/**
	 *  Do not display status information on screen.
	 *
	 * @param mixed $value
	 *
	 * @return ShellArguments
	 * @throws Exception\ArgumentException
	 * @see Arguments\NoOsd
	 */
	public function no_osd($value): self
	{

		$this->arguments['no_osd'] = new Arguments\NoOsd($value);

		return $this;

	}

	/**
	 *  No semitransparent boxes behind subtitles.
	 *
	 * @param mixed $value
	 *
	 * @return ShellArguments
	 * @throws Exception\ArgumentException
	 * @see Arguments\NoGhostBox
	 */
	public function no_ghost_box($value): self
	{

		$this->arguments['no_ghost_box'] = new Arguments\NoGhostBox($value);

		return $this;

	}

	/**
	 *  Set for live tv or vod type stream.
	 *
	 * @param mixed $value
	 *
	 * @return ShellArguments
	 * @throws Exception\ArgumentException
	 * @see Arguments\Live
	 */
	public function live($value): self
	{

		$this->arguments['live'] = new Arguments\Live($value);

		return $this;

	}

	/**
	 *  Enable/disable advanced deinterlace for HD videos (default enabled).
	 *
	 * @param mixed $value
	 *
	 * @return ShellArguments
	 * @throws Exception\ArgumentException
	 * @see Arguments\Advanced
	 */
	public function advanced($value): self
	{

		$this->arguments['advanced'] = new Arguments\Advanced($value);

		return $this;

	}

	/**
	 *  Switch tv into 3d mode (e.g. SBS/TB).
	 *
	 * @param mixed $value
	 *
	 * @return ShellArguments
	 * @throws Exception\ArgumentException
	 * @see Arguments\Mode3D
	 */
	public function mode3d($value): self
	{

		$this->arguments['mode3d'] = new Arguments\Mode3D($value);

		return $this;

	}

	/**
	 *  Set initial amplification in millibels (default 0).
	 *
	 * @param mixed $value
	 *
	 * @return ShellArguments
	 * @throws Exception\ArgumentException
	 * @see Arguments\Amp
	 */
	public function amp($value): self
	{

		$this->arguments['amp'] = new Arguments\Amp($value);

		return $this;

	}

	/**
	 *  Set initial volume in millibels (default 0).
	 *
	 * @param mixed $value
	 *
	 * @return ShellArguments
	 * @throws Exception\ArgumentException
	 * @see Arguments\Vol
	 */
	public function vol($value): self
	{

		$this->arguments['vol'] = new Arguments\Vol($value);

		return $this;

	}

	/**
	 *  External subtitles in UTF-8 srt format.
	 *
	 * @param mixed $value
	 *
	 * @return ShellArguments
	 * @throws Exception\ArgumentException
	 * @see Arguments\Subtitles
	 */
	public function subtitles($value): self
	{

		$this->arguments['subtitles'] = new Arguments\Subtitles($value);

		return $this;

	}

	/**
	 *  Default: /usr/share/fonts/truetype/freefont/FreeSans.ttf.
	 *
	 * @param mixed $value
	 *
	 * @return ShellArguments
	 * @throws Exception\ArgumentException
	 * @see Arguments\Font
	 */
	public function font($value): self
	{

		$this->arguments['font'] = new Arguments\Font($value);

		return $this;

	}

	/**
	 *  Font size in 1/1000 screen height (default: 55).
	 *
	 * @param mixed $value
	 *
	 * @return ShellArguments
	 * @throws Exception\ArgumentException
	 * @see Arguments\FontSize
	 */
	public function font_size($value): self
	{

		$this->arguments['font_size'] = new Arguments\FontSize($value);

		return $this;

	}

	/**
	 *  Subtitle alignment (default: left).
	 *
	 * @param mixed $value
	 *
	 * @return ShellArguments
	 * @throws Exception\ArgumentException
	 * @see Arguments\Align
	 */
	public function align($value): self
	{

		$this->arguments['align'] = new Arguments\Align($value);

		return $this;

	}

	/**
	 *  Number of lines in the subtitle buffer (default: 3).
	 *
	 * @param mixed $value
	 *
	 * @return ShellArguments
	 * @throws Exception\ArgumentException
	 * @see Arguments\Lines
	 */
	public function lines($value): self
	{

		$this->arguments['lines'] = new Arguments\Lines($value);

		return $this;

	}

	/**
	 *  Letterbox, fill, stretch. Default: stretch if win is specified, letterbox otherwise.
	 *
	 * @param mixed $value
	 *
	 * @return ShellArguments
	 * @throws Exception\ArgumentException
	 * @see Arguments\AspectMode
	 */
	public function aspect_mode($value): self
	{

		$this->arguments['aspect_mode'] = new Arguments\AspectMode($value);

		return $this;

	}

	/**
	 *  Amount of buffered data required to finish buffering [s].
	 *
	 * @param mixed $value
	 *
	 * @return ShellArguments
	 * @throws Exception\ArgumentException
	 * @see Arguments\Threshold
	 */
	public function threshold($value): self
	{

		$this->arguments['threshold'] = new Arguments\Threshold($value);

		return $this;

	}

	/**
	 *  Timeout for stalled file/network operations (default 10s).
	 *
	 * @param mixed $value
	 *
	 * @return ShellArguments
	 * @throws Exception\ArgumentException
	 * @see Arguments\Timeout
	 */
	public function timeout($value): self
	{

		$this->arguments['timeout'] = new Arguments\Timeout($value);

		return $this;

	}

	/**
	 *  Set orientation of video (0, 90, 180 or 270).
	 *
	 * @param mixed $value
	 *
	 * @return ShellArguments
	 * @throws Exception\ArgumentException
	 * @see Arguments\Orientation
	 */
	public function orientation($value): self
	{

		$this->arguments['orientation'] = new Arguments\Orientation($value);

		return $this;

	}

	/**
	 *  Set output speaker layout (e.g. 5.1).
	 *
	 * @param mixed $value
	 *
	 * @return ShellArguments
	 * @throws Exception\ArgumentException
	 * @see Arguments\Layout
	 */
	public function layout($value): self
	{

		$this->arguments['layout'] = new Arguments\Layout($value);

		return $this;

	}

	/**
	 *  Set video render layer number (higher numbers are on top).
	 *
	 * @param mixed $value
	 *
	 * @return ShellArguments
	 * @throws Exception\ArgumentException
	 * @see Arguments\Layer
	 */
	public function layer($value): self
	{

		$this->arguments['layer'] = new Arguments\Layer($value);

		return $this;

	}

	/**
	 *  Set video transparency (0..255).
	 *
	 * @param mixed $value
	 *
	 * @return ShellArguments
	 * @throws Exception\ArgumentException
	 * @see Arguments\Alpha
	 */
	public function alpha($value): self
	{

		$this->arguments['alpha'] = new Arguments\Alpha($value);

		return $this;

	}

	/**
	 *  Set display to output to.
	 *
	 * @param mixed $value
	 *
	 * @return ShellArguments
	 * @throws Exception\ArgumentException
	 * @see Arguments\Display
	 */
	public function display($value): self
	{

		$this->arguments['display'] = new Arguments\Display($value);

		return $this;

	}

	/**
	 *  Send specified cookie as part of HTTP requests.
	 *
	 * @param mixed $value
	 *
	 * @return ShellArguments
	 * @throws Exception\ArgumentException
	 * @see Arguments\Cookie
	 */
	public function cookie($value): self
	{

		$this->arguments['cookie'] = new Arguments\Cookie($value);

		return $this;

	}

	/**
	 * Send specified User-Agent as part of HTTP requests.
	 *
	 * @param mixed $value
	 *
	 * @return ShellArguments
	 * @throws Exception\ArgumentException
	 * @see Arguments\UserAgent
	 */
	public function user_agent($value): self
	{

		$this->arguments['user_agent'] = new Arguments\UserAgent($value);

		return $this;

	}

	/**
	 * Options passed to libavformat, e.g. 'probesize:250000,...'.
	 *
	 * @param mixed $value
	 *
	 * @return ShellArguments
	 * @throws Exception\ArgumentException
	 * @see Arguments\Lavfdopts
	 */
	public function lavfdopts($value): self
	{

		$this->arguments['lavfdopts'] = new Arguments\Lavfdopts($value);

		return $this;

	}

	/**
	 * Options passed to demuxer, e.g., 'rtsp_transport:tcp,...'.
	 *
	 * @param mixed $value
	 *
	 * @return ShellArguments
	 * @throws Exception\ArgumentException
	 * @see Arguments\Avdict
	 */
	public function avdict($value): self
	{

		$this->arguments['avdict'] = new Arguments\Avdict($value);

		return $this;

	}

	/**
	 * Default: /usr/share/fonts/truetype/freefont/FreeSansOblique.ttf.
	 *
	 * @param mixed $value
	 *
	 * @return ShellArguments
	 * @throws Exception\ArgumentException
	 * @see Arguments\ItalicFont
	 */
	public function italicfont($value): self
	{

		$this->arguments['italicfont'] = new Arguments\ItalicFont($value);

		return $this;

	}



}
