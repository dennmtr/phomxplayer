# dennmtr/phOMXPlayer
![myImage](https://img.shields.io/github/license/dennmtr/phomxplayer?style=social)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D_7.3-8892BF.svg)](https://github.com/symfony/symfony)

OMXPlayer wrap shell script, ready for REST/XML-RPC APIs or CLI implementations.

[Official OMXPlayer Documentation](https://github.com/popcornmix/omxplayer#help-and-docs)

## Installation

### Clone

```console

$ git clone https://github.com/dennmtr/phomxplayer.git

```

### Using Composer
The **recommended** way to install phOMXPlayer is through Composer

```console

$ composer require dennmtr/phomxplayer

```

#### Laravel framework

Publish configuration with **artisan** command `optional`

```console

$ php artisan vendor:publish

```

## Prepare Raspberry Pi OS

Add user to **video group** `required`

```console

# usermod -a -G video <username>

```

Add user to **audio group**

```console

# usermod -a -G audio <username>

```

Reserve at least 128MB of system memory to the GPU `required`

```console

# echo "gpu_mem=128" >> /boot/config.txt

```
> **NOTICE**: *Reboot required...*


## Usage

#### Initialize

```php
$player = new OMXPlayer([
  'adev' => 'hdmi',
  'blank' => true
]);

$player->play('sample.mp4');
```

#### Request

```php

echo 'Movie duration: ' . $player->getDuration();

//same as...

$command = new Commands\Duration();

echo 'Movie duration: ' . $command->getFormattedOutput();

```

See [Predefined command list](#predefined-commands)

#### Validate

```php

$input = 0.5;

if (Commands\Volume::validateInput($input)) {
  $command = new Commands\Volume($input);
  echo 'New volume level: ' . $command->getFormattedOutput();
}

```

#### Proper configure

```php

$arguments = [
  'adev' => 'hdmi',
  'blank' => true,
  'no-keys' => true
];

$player = new OMXPlayer($arguments);

$player->adev;                  // Returns the Arguments\Adev instance via magic method if exists or null.
$player->adev->getShellArg();   // Returns '--adev hdmi' string, later passed in omxplayer execution.
$player->adev->getValue();      // Returns 'hdmi' string.
$player->adev = 'local';        // Sets a new adev argument instance with its variant value via magic method.
$player->adev->getValue();      // Returns 'local' string.

$player->map([
  'adev' => 'both',
  'with-info' => false
]);

$player->adev->getValue();      // Returns 'both' string.
$player->with_info->getValue(); // Returns false bool.
$player->blank->getValue();     // Returns true bool.

$player->map([
  'adev' => new Arguments\Adev(Arguments\Adev::HDMI),
  'blank' => new Arguments\Blank(false),
  'with-info' => true,
]);

$player->adev->getValue();      // Returns 'hdmi' string.
$player->getShellArgs(false);    // Returns '--adev hdmi --no-keys --with-info' string.

$input = true;

if (Arguments\Adev::isValid($input)) {
  $player->adev = $input;       // It will never reach here because boolean true is not a valid Adev value.
}

$player->adev = $input;         // It will throw an ArgumentException because boolean true is not a valid Adev value.

```

See [Argument list](#argument-List)

#### Direct call

```php

$dbus_client = new DBusClient();

$player = new OMXPlayer([], $dbus_client); // Optional

if (!empty($player->pid)) {
  $stdout = $dbus_client->call( 'org.freedesktop.DBus.Properties.Get', [
    ['string', 'org.mpris.MediaPlayer2.Player'],
    ['string', 'CanControl'],
  ]); // Assumes an active DBus session. Returns the raw stdout buffer as string
}

```

## Predefined Commands

A list of predefined commands ready to use...

|Command|Param Type|Return Type|Method Alias|Description|
|---|---|---|---|---|
|Action|int `enum`|-|action|Executes a "keyboard" command|
|CanControl|-|bool|canControl|Whether or not the player can be controlled|
|CanGoNext|-|bool|canGoNext|Whether or not the play can skip to the next track|
|CanGoPrevious|-|bool|canGoPrevious|Whether or not the player can skip to the previous track|
|CanPause|-|bool|canPause|Whether or not the player can play|
|CanPlay|-|bool|canPlay|Whether or not the player can seek|
|CanSeek|-|bool|canSeek|Returns the total length of the playing media|
|Duration|-|int|getDuration|Returns the total length of the playing media|
|GetSource|-|string|getSource|The current file or stream that is being played|
|HideSubtitles|-|-|hideSubtitles|Turns off subtitles|
|ListAudio|-|array|listAudio|Returns and array of all known audio streams|
|ListSubtitles|-|array|listSubtitle|Returns a array of all known subtitles|
|ListVideo|-|array|listVideo|Returns and array of all known video streams|
|Mute|-|-|mute|Mute the audio stream. If the volume is already muted, this does nothing|
|Next|-|-|nextChapter|Skip to the next chapter|
|OpenUri|string|string|openUri|Restart and open another URI for playing|
|Pause|-|-|pause|Pause the video. If the video is playing, it will be paused, if it is paused it will stay in pause (no effect)|
|Play|-|-|resume|Play the video. If the video is playing, it has no effect, if it is paused it will play from current position|
|PlaybackStatus|-|bool|playbackStatus|The current state of the player, either "Paused" or "Playing"|
|Position|int `optional`|int|setPosition, getPosition|Returns the current position, seeks to a specific location in the file. This is an absolute seek|
|Previous|-|-|previousChapter|Skip to the previous chapter|
|Rate|float `optional`|float|setRate, getRate|Set the playing rate and return the current rate, or gets the current rate|
|Seek|int|int|seek|Perform a relative seek|
|SelectAudio|int|-|selectAudio|Selects the audio stream at a given index|
|SelectSubtitle|int|-|selectSubtitle|Selects the subtitle at a given index|
|ShowSubtitles|-|-|showSubtitles|Turns on subtitles|
|Stop|-|-|stop|Stops the video|
|SupportedMimeTypes|-|string|getSupportedMimeType|Supported mime types|
|SupportedUriSchemes|-|string|getSupportedUriScheme|Playable URI formats|
|Toggle|-|-|toggle|Toggles the play state. If the video is playing, it will be paused, if it is paused it will start playing|
|Unmute|-|-|unmute|Unmute the audio stream. If the stream is already unmuted, this does nothing|
|Volume|float `optional`|float|setVolumeLevel, getVolumeLevel|Set the volume and return the current volume, return's the current volume|

## Argument List

A list of OMXPlayer shell arguments...

|Argument|Named Key|Param Type|Acceptable Values|Description|
|---|---|---|---|---|
Adev|`adev`|string|`hdmi` `local` `both` `alsa`|Audio out device|
Advanced|`advanced`|bool|-|Enable/disable advanced deinterlace for HD videos (default enabled)|
Aidx|`aidx`|int|-|Audio stream index|
Align|`align`|string|`left` `center` `right`|Subtitle alignment (default: left)|
AllowMvc|`allow-mvc`|bool|-|Allow decoding of both views of MVC stereo stream|
Alpha|`alpha`|int|`0...255`|Set video transparency|
Amp|`amp`|float|`0...1`|Set initial amplification in millibels (default 0)|
AspectMode|`aspect-mode`|string|`letterbox` `fill` `strech`|Letterbox, fill, stretch. Default: letterbox|
Avdict|`avdict`|string|-|Options passed to demuxer, e.g., 'rtsp_transport:tcp,...'|
Blank|`blank`|bool|-|Set the video background color to black|
Cookie|`cookie`|string|-|Send specified cookie as part of HTTP requests|
Deinterlace|`deinterlace`|bool|-|Force deinterlacing|
Display|`display`|int|-|Set display to output to|
FontSize|`font-size`|int|-|Font size in 1/1000 screen height (default: 55)|
Font|`font`|string|-|Subtitle font absolute file path|
Fps|`fps`|int|`16...120`|Set fps of video where timestamps are not present|
HdmiClockSync|`hdmiclocksync`|bool|-|Display refresh rate to match video (default)|
Hw|`hw`|bool|-|Hw audio decoding|
ItalicFont|`italic-font`|string|-|Subtitle font absolute file path|
Lavfdopts|`lavfdopts`|string|-|Options passed to libavformat, e.g. 'probesize:250000,...'|
Layer|`layer`|int|-|Set video render layer number (higher numbers are on top)|
Layout|`layout`|string|`x.x`|Set output speaker layout (e.g. 5.1)|
Lines|`lines`|int|-|Number of lines in the subtitle buffer (default: 3)|
Live|`live`|bool|-|Set for live tv or vod type stream|
Loop|`loop`|bool|-|Loop file. Ignored if file not seekable|
Mode3D|`3d`|string|`FP` `TB` `SBS`|Switch tv into 3d mode|
NativeDeinterlace|`nativedeinterlace`|bool|-|let display handle interlace|
NoBoostOnDownmix|`no-boost-on-downmix`|bool|-|Don't boost volume when downmixing|
NoDeinterlace|`nodeinterlace`|bool|-|Force no deinterlacing|
NoGhostBox|`no-ghost-box`|bool|-|No semitransparent boxes behind subtitles|
NoHdmiClockSync|`nohdmiclocksync`|bool|-|Do not adjust display refresh rate to match video|
NoOsd|`no-osd`|bool|-|Do not display status information on screen|
Orientation|`orientation`|int|`0` `90` `180` `270`|Set orientation of video|
Passthrough|`passthrough`|bool|-|Audio passthrough|
Pos|`pos`|int|-|Start position|
Refresh|`refresh`|bool|-|Adjust framerate/resolution to video|
Sid|`sid`|int|-|Show subtitle with index|
Subtitles|`subtitles`|string|-|External subtitles in UTF-8 srt format|
Threshold|`threshold`|int|-|Amount of buffered data required to finish buffering [s]|
Timeout|`timeout`|int|-|Timeout for stalled file/network operations (default 10s)|
UserAgent|`user-agent`|string|-|Send specified User-Agent as part of HTTP requests|
Vol|`vol`|float|`0...1`|set initial volume in millibels (default 0)|
WithInfo|`with-info`|bool|-|dump stream format before playback|

## Support

<dennmtr+phomxplayer@gmail.com>
