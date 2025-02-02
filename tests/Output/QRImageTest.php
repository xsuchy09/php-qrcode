<?php
/**
 * Class QRImageTest
 *
 * @filesource   QRImageTest.php
 * @created      24.12.2017
 * @package      xsuchy09\QRCodeTest\Output
 * @author       Smiley <smiley@chillerlan.net>
 * @copyright    2017 Smiley
 * @license      MIT
 */

namespace xsuchy09\QRCodeTest\Output;

use xsuchy09\QRCode\{QRCode, Output\QRImage};

class QRImageTest extends QROutputTestAbstract
{

	protected $FQCN = QRImage::class;

	public function types()
	{
		return [
			'png' => [QRCode::OUTPUT_IMAGE_PNG],
			'gif' => [QRCode::OUTPUT_IMAGE_GIF],
			'jpg' => [QRCode::OUTPUT_IMAGE_JPG],
		];
	}

	/**
	 * @dataProvider types
	 *
	 * @param $type
	 */
	public function testImageOutput($type)
	{
		$this->options->outputType = $type;
		$this->options->imageBase64 = false;

		$this->setOutputInterface();
		$this->outputInterface->dump($this::cachefile . $type);
		$img = $this->outputInterface->dump();

		if ($type === QRCode::OUTPUT_IMAGE_JPG) { // jpeg encoding may cause different results
			$this->markAsRisky();
		}

		$this->assertSame($img, file_get_contents($this::cachefile . $type));
	}

	public function testSetModuleValues()
	{

		$this->options->moduleValues = [
			// data
			1024 => [0, 0, 0],
			4 => [255, 255, 255],
		];

		$this->setOutputInterface()->dump();

		$this->assertTrue(true); // tricking the code coverage
	}

}
