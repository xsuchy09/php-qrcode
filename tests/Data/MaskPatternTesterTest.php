<?php
/**
 * Class MaskPatternTesterTest
 *
 * @filesource   MaskPatternTesterTest.php
 * @created      24.11.2017
 * @package      xsuchy09\QRCodeTest\Data
 * @author       Smiley <smiley@chillerlan.net>
 * @copyright    2017 Smiley
 * @license      MIT
 */

namespace xsuchy09\QRCodeTest\Data;

use xsuchy09\QRCode\{QROptions, Data\Byte, Data\MaskPatternTester};
use xsuchy09\QRCodeTest\QRTestAbstract;

class MaskPatternTesterTest extends QRTestAbstract
{

	protected $FQCN = MaskPatternTester::class;

	// coverage
	public function testMaskpattern()
	{
		$matrix = (new Byte(new QROptions(['version' => 10]), 'test'))->initMatrix(0, true);

		$this->assertSame(6178, (new MaskPatternTester($matrix))->testPattern());
	}


}
