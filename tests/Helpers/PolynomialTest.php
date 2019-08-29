<?php
/**
 * Class PolynomialTest
 *
 * @filesource   PolynomialTest.php
 * @created      09.02.2016
 * @package      xsuchy09\QRCodeTest\Helpers
 * @author       Smiley <smiley@chillerlan.net>
 * @copyright    2015 Smiley
 * @license      MIT
 */

namespace xsuchy09\QRCodeTest\Helpers;

use xsuchy09\QRCode\Helpers\Polynomial;
use xsuchy09\QRCode\QRCodeException;
use xsuchy09\QRCodeTest\QRTestAbstract;

class PolynomialTest extends QRTestAbstract
{

	/**
	 * @var \xsuchy09\QRCode\Helpers\Polynomial
	 */
	protected $polynomial;

	protected function setUp(): void
	{
		$this->polynomial = new Polynomial;
	}

	public function testGexp()
	{
		$this->assertSame(142, $this->polynomial->gexp(-1));
		$this->assertSame(133, $this->polynomial->gexp(128));
		$this->assertSame(2, $this->polynomial->gexp(256));
	}

	public function testGlogException()
	{
		$this->expectException(QRCodeException::class);
		$this->expectExceptionMessage('log(0)');

		$this->polynomial->glog(0);
	}
}
