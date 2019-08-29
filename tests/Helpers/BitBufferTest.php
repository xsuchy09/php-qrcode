<?php
/**
 * Class BitBufferTest
 *
 * @filesource   BitBufferTest.php
 * @created      08.02.2016
 * @package      xsuchy09\QRCodeTest\Helpers
 * @author       Smiley <smiley@chillerlan.net>
 * @copyright    2015 Smiley
 * @license      MIT
 */

namespace xsuchy09\QRCodeTest\Helpers;

use xsuchy09\QRCode\{QRCode, Helpers\BitBuffer};
use xsuchy09\QRCodeTest\QRTestAbstract;

class BitBufferTest extends QRTestAbstract
{

	/**
	 * @var \xsuchy09\QRCode\Helpers\BitBuffer
	 */
	protected $bitBuffer;

	protected function setUp(): void
	{
		$this->bitBuffer = new BitBuffer;
	}

	public function bitProvider()
	{
		return [
			'number' => [QRCode::DATA_NUMBER, 16],
			'alphanum' => [QRCode::DATA_ALPHANUM, 32],
			'byte' => [QRCode::DATA_BYTE, 64],
			'kanji' => [QRCode::DATA_KANJI, 128],
		];
	}

	/**
	 * @dataProvider bitProvider
	 */
	public function testPut($data, $value)
	{
		$this->bitBuffer->put($data, 4);
		$this->assertSame($value, $this->bitBuffer->buffer[0]);
		$this->assertSame(4, $this->bitBuffer->length);
	}

	public function testClear()
	{
		$this->bitBuffer->clear();
		$this->assertSame([], $this->bitBuffer->buffer);
		$this->assertSame(0, $this->bitBuffer->length);
	}

}
