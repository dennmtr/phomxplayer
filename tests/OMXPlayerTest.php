<?php

use phOMXPlayer\Arguments;
use phOMXPlayer\Exception;
use phOMXPlayer\OMXPlayer;
use PHPUnit\Framework\TestCase;

final class OMXPlayerTest extends TestCase
{
	/**
	 * @depends testCanPlay
	 */
	public function testCanBeInitializedWithoutArgs()
	{

		$player = new OMXPLayer(null);
		$this->assertEmpty($player->getShellArgs(true));
		$this->assertEmpty($player->getShellArgs(false, false));
		$player->play(TEST_URI);
		$this->assertTrue($player->alive());

	}

	public function testCanSetValidShellArguments(): void
	{

		$args = $this->getValidArgs();
		$player = new OMXPLayer(null);
		$this->assertNull($player->adev);
		$player->adev = $args['adev'];
		$this->assertInstanceOf(Arguments\Adev::class, $player->adev);
		$player->no_keys = $args['no-keys'];
		$this->assertInstanceOf(Arguments\NoKeys::class, $player->no_keys);
		$player->blank = $args['blank'];
		$this->assertInstanceOf(Arguments\Blank::class, $player->blank);
		$player->with_info = $args['with-info'];
		$this->assertInstanceOf(Arguments\WithInfo::class, $player->with_info);
		$player->pos = $args['pos'];
		$this->assertInstanceOf(Arguments\Pos::class, $player->pos);
		$player->fps = $args['fps'];
		$this->assertInstanceOf(Arguments\Fps::class, $player->fps);
		$player->aidx = $args['aidx'];
		$this->assertInstanceOf(Arguments\Aidx::class, $player->aidx);
		$player->sid = $args['sid'];
		$this->assertInstanceOf(Arguments\Sid::class, $player->sid);
		$player->passthrough = $args['passthrough'];
		$this->assertInstanceOf(Arguments\Passthrough::class, $player->passthrough);
		$player->deinterlace = $args['deinterlace'];
		$this->assertInstanceOf(Arguments\Deinterlace::class, $player->deinterlace);
		$player->nodeinterlace = $args['nodeinterlace'];
		$this->assertInstanceOf(Arguments\NoDeinterlace::class, $player->nodeinterlace);
		$player->nativedeinterlace = $args['nativedeinterlace'];
		$this->assertInstanceOf(Arguments\NativeDeinterlace::class, $player->nativedeinterlace);
		$player->hw = $args['hw'];
		$this->assertInstanceOf(Arguments\Hw::class, $player->hw);
		$player->allow_mvc = $args['allow-mvc'];
		$this->assertInstanceOf(Arguments\AllowMvc::class, $player->allow_mvc);
		$player->hdmiclocksync = $args['hdmiclocksync'];
		$this->assertInstanceOf(Arguments\HdmiClockSync::class, $player->hdmiclocksync);
		$player->nohdmiclocksync = $args['nohdmiclocksync'];
		$this->assertInstanceOf(Arguments\NoHdmiClockSync::class, $player->nohdmiclocksync);
		$player->refresh = $args['refresh'];
		$this->assertInstanceOf(Arguments\Refresh::class, $player->refresh);
		$player->loop = $args['loop'];
		$this->assertInstanceOf(Arguments\Loop::class, $player->loop);
		$player->no_boost_on_downmix = $args['no-boost-on-downmix'];
		$this->assertInstanceOf(Arguments\NoBoostOnDownmix::class, $player->no_boost_on_downmix);
		$player->no_osd = $args['no-osd'];
		$this->assertInstanceOf(Arguments\NoOsd::class, $player->no_osd);
		$player->no_ghost_box = $args['no-ghost-box'];
		$this->assertInstanceOf(Arguments\NoGhostBox::class, $player->no_ghost_box);
		$player->live = $args['live'];
		$this->assertInstanceOf(Arguments\Live::class, $player->live);
		$player->advanced = $args['advanced'];
		$this->assertInstanceOf(Arguments\Advanced::class, $player->advanced);
		$player->mode3d = $args['mode3d'];
		$this->assertInstanceOf(Arguments\Mode3D::class, $player->mode3d);
		$player->amp = $args['amp'];
		$this->assertInstanceOf(Arguments\Amp::class, $player->amp);
		$player->vol = $args['vol'];
		$this->assertInstanceOf(Arguments\Vol::class, $player->vol);
		$player->subtitles = $args['subtitles'];
		$this->assertInstanceOf(Arguments\Subtitles::class, $player->subtitles);
		$player->font = $args['font'];
		$this->assertInstanceOf(Arguments\Font::class, $player->font);
		$player->font_size = $args['font-size'];
		$this->assertInstanceOf(Arguments\FontSize::class, $player->font_size);
		$player->align = $args['align'];
		$this->assertInstanceOf(Arguments\Align::class, $player->align);
		$player->lines = $args['lines'];
		$this->assertInstanceOf(Arguments\Lines::class, $player->lines);
		$player->aspect_mode = $args['aspect-mode'];
		$this->assertInstanceOf(Arguments\AspectMode::class, $player->aspect_mode);
		$player->threshold = $args['threshold'];
		$this->assertInstanceOf(Arguments\Threshold::class, $player->threshold);
		$player->timeout = $args['timeout'];
		$this->assertInstanceOf(Arguments\Timeout::class, $player->timeout);
		$player->orientation = $args['orientation'];
		$this->assertInstanceOf(Arguments\Orientation::class, $player->orientation);
		$player->layout = $args['layout'];
		$this->assertInstanceOf(Arguments\Layout::class, $player->layout);
		$player->layer = $args['layer'];
		$this->assertInstanceOf(Arguments\Layer::class, $player->layer);
		$player->alpha = $args['alpha'];
		$this->assertInstanceOf(Arguments\Alpha::class, $player->alpha);
		$player->display = $args['display'];
		$this->assertInstanceOf(Arguments\Display::class, $player->display);
		$player->cookie = $args['cookie'];
		$this->assertInstanceOf(Arguments\Cookie::class, $player->cookie);
		$player->user_agent = $args['user-agent'];
		$this->assertInstanceOf(Arguments\UserAgent::class, $player->user_agent);
		$player->lavfdopts = $args['lavfdopts'];
		$this->assertInstanceOf(Arguments\Lavfdopts::class, $player->lavfdopts);
		$player->avdict = $args['avdict'];
		$this->assertInstanceOf(Arguments\Avdict::class, $player->avdict);
		$player->italic_font = $args['italic-font'];
		$this->assertInstanceOf(Arguments\ItalicFont::class, $player->italic_font);
		$this->assertNotEmpty($player->getShellArgs(true));

	}

	protected function getValidArgs(): array
	{

		return [
			'aidx' => 1,
			'adev' => 'hdmi',
			'with-info' => true,
			'passthrough' => true,
			'deinterlace' => true,
			'nodeinterlace' => true,
			'nativedeinterlace' => true,
			'advanced' => 1,
			'hw' => true,
			'mode3d' => 'FP',
			'allow-mvc' => true,
			'hdmiclocksync' => true,
			'nohdmiclocksync' => true,
			'sid' => 1,
			'refresh' => true,
			'pos' => 0,
			'blank' => true,
			'loop' => true,
			'no-boost-on-downmix' => true,
			'vol' => 0.5,
			'amp' => 0.5,
			'no-osd' => true,
			'no-keys' => true,
			'subtitles' => '/dev/stdout',
			'font' => '/dev/stdout',
			'italic-font' => '/dev/stdout',
			'font-size' => 55,
			'align' => 'center',
			'no-ghost-box' => true,
			'lines' => 1,
			'aspect-mode' => 'letterbox',
			'threshold' => 0,
			'timeout' => 0,
			'orientation' => 0,
			'fps' => 16,
			'live' => true,
			'layout' => '5.1',
			'alpha' => 0,
			'layer' => 0,
			'display' => 7,
			'cookie' => 'foo',
			'user-agent' => 'foo',
			'lavfdopts' => 'foo',
			'avdict' => 'foo',
		];

	}

	/**
	 * @depends testCanSetValidShellArguments
	 */
	public function testCannotBeInitializedFromInValidShellArguments(): void
	{

		$player = new OMXPLayer(null);
		$this->expectException(Exception\ArgumentException::class);
		$player->blank = 'true';

	}

	/**
	 * @depends testCannotBeInitializedFromInValidShellArguments
	 */
	public function testCanPlay(): void
	{

		$player = new OMXPLayer();
		$player->play(TEST_URI);
		$this->assertTrue($player->alive());

	}

}
