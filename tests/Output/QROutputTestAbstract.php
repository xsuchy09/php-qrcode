<?php
/**
 * Class QROutputTestAbstract
 *
 * @filesource   QROutputTestAbstract.php
 * @created      24.12.2017
 * @package      xsuchy09\QRCodeTest\Output
 * @author       Smiley <smiley@chillerlan.net>
 * @copyright    2017 Smiley
 * @license      MIT
 */

namespace xsuchy09\QRCodeTest\Output;

use xsuchy09\QRCode\QROptions;
use xsuchy09\QRCode\Data\Byte;
use xsuchy09\QRCode\Output\{QRCodeOutputException, QROutputInterface};
use xsuchy09\QRCodeTest\QRTestAbstract;

/**
 */
abstract class QROutputTestAbstract extends QRTestAbstract
{

	const cachefile = __DIR__ . '/output_test.';

	/**
	 * @var \xsuchy09\QRCode\Output\QROutputInterface
	 */
	protected $outputInterface;

	/**
	 * @var \xsuchy09\QRCode\QROptions
	 */
	protected $options;

	/**
	 * @var \xsuchy09\QRCode\Data\QRMatrix
	 */
	protected $matrix;

	protected function setUp(): void
	{
		parent::setUp();

		$this->options = new QROptions;
		$this->setOutputInterface();
	}

	protected function setOutputInterface()
	{
		$this->outputInterface = $this->reflection->newInstanceArgs([$this->options, (new Byte($this->options, 'testdata'))->initMatrix(0)]);
		return $this->outputInterface;
	}

	public function testInstance()
	{
		$this->assertInstanceOf(QROutputInterface::class, $this->outputInterface);
	}

	public function testSaveException()
	{
		$this->expectException(QRCodeOutputException::class);
		$this->expectExceptionMessage('Could not write data to cache file: /foo');

		$this->options->cachefile = '/foo';
		$this->setOutputInterface();
		$this->outputInterface->dump();
	}

}
