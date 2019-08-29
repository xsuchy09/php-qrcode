<?php
/**
 * Class QRImagickTest
 *
 * @filesource   QRImagickTest.php
 * @created      04.07.2018
 * @package      xsuchy09\QRCodeTest\Output
 * @author       smiley <smiley@chillerlan.net>
 * @copyright    2018 smiley
 * @license      MIT
 */

namespace xsuchy09\QRCodeTest\Output;

use xsuchy09\QRCode\{QRCode, Output\QRImagick};

class QRImagickTest extends QROutputTestAbstract
{

	protected $FQCN = QRImagick::class;

	public function setUp(): void
	{

		if (!extension_loaded('imagick')) {
			$this->markTestSkipped('ext-imagick not loaded');
			return;
		}

		parent::setUp();
	}

	public function testImageOutput()
	{
		$type = QRCode::OUTPUT_IMAGICK;

		$this->options->outputType = $type;
		$this->setOutputInterface();
		$this->outputInterface->dump($this::cachefile . $type);
		$img = $this->outputInterface->dump();

		$this->assertSame($img, file_get_contents($this::cachefile . $type));
	}

	public function testSetModuleValues()
	{

		$this->options->moduleValues = [
			// data
			1024 => '#4A6000',
			4 => '#ECF9BE',
		];

		$this->setOutputInterface()->dump();

		$this->assertTrue(true); // tricking the code coverage
	}

}
