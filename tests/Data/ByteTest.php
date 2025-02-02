<?php
/**
 * Class ByteTest
 *
 * @filesource   ByteTest.php
 * @created      24.11.2017
 * @package      xsuchy09\QRCodeTest\Data
 * @author       Smiley <smiley@chillerlan.net>
 * @copyright    2017 Smiley
 * @license      MIT
 */

namespace xsuchy09\QRCodeTest\Data;

use xsuchy09\QRCode\Data\Byte;

class ByteTest extends DatainterfaceTestAbstract
{

	protected $FQCN = Byte::class;
	protected $testdata = '[¯\_(ツ)_/¯]';
	protected $expected = [
		64, 245, 188, 42, 245, 197, 242, 142,
		56, 56, 66, 149, 242, 252, 42, 245,
		208, 236, 17, 236, 17, 236, 17, 236,
		17, 236, 17, 236, 17, 236, 17, 236,
		17, 236, 17, 236, 17, 236, 17, 236,
		17, 236, 17, 236, 17, 236, 17, 236,
		17, 236, 17, 236, 17, 236, 17, 236,
		17, 236, 17, 236, 17, 236, 17, 236,
		17, 236, 17, 236, 17, 236, 17, 236,
		17, 236, 17, 236, 17, 236, 17, 236,
		79, 89, 226, 48, 209, 89, 151, 1,
		12, 73, 42, 163, 11, 34, 255, 205,
		21, 47, 250, 101
	];


}
