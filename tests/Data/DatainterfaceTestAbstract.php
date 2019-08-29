<?php
/**
 * Class DatainterfaceTestAbstract
 *
 * @filesource   DatainterfaceTestAbstract.php
 * @created      24.11.2017
 * @package      xsuchy09\QRCodeTest\Data
 * @author       Smiley <smiley@chillerlan.net>
 * @copyright    2017 Smiley
 * @license      MIT
 */

namespace xsuchy09\QRCodeTest\Data;

use xsuchy09\QRCode\QROptions;
use xsuchy09\QRCode\Data\{QRCodeDataException, QRDataInterface, QRMatrix};
use xsuchy09\QRCodeTest\QRTestAbstract;

abstract class DatainterfaceTestAbstract extends QRTestAbstract
{

	/**
	 * @var \xsuchy09\QRCode\Data\QRDataAbstract
	 */
	protected $dataInterface;

	protected $testdata;
	protected $expected;

	protected function setUp(): void
	{
		parent::setUp();

		$this->dataInterface = $this->reflection->newInstanceArgs([new QROptions(['version' => 4])]);
	}

	public function testInstance()
	{
		$this->dataInterface = $this->reflection->newInstanceArgs([new QROptions, $this->testdata]);

		$this->assertInstanceOf(QRDataInterface::class, $this->dataInterface);
	}

	public function testSetData()
	{
		$this->dataInterface->setData($this->testdata);

		$this->assertSame($this->expected, $this->getProperty('matrixdata')->getValue($this->dataInterface));
	}

	public function testInitMatrix()
	{
		$m = $this->dataInterface->setData($this->testdata)->initMatrix(0);

		$this->assertInstanceOf(QRMatrix::class, $m);
	}

	public function testGetMinimumVersion()
	{
		$this->assertSame(1, $this->getMethod('getMinimumVersion')->invoke($this->dataInterface));
	}

	public function testGetMinimumVersionException()
	{
		$this->expectException(QRCodeDataException::class);
		$this->expectExceptionMessage('data exceeds');

		$this->getProperty('strlen')->setValue($this->dataInterface, 13370);
		$this->getMethod('getMinimumVersion')->invoke($this->dataInterface);
	}

}
