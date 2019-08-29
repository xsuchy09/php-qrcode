<?php
/**
 * Class QROutputAbstract
 *
 * @filesource   QROutputAbstract.php
 * @created      09.12.2015
 * @package      xsuchy09\QRCode\Output
 * @author       Smiley <smiley@chillerlan.net>
 * @copyright    2015 Smiley
 * @license      MIT
 */

namespace xsuchy09\QRCode\Output;

use xsuchy09\QRCode\{Data\QRMatrix, QRCode};
use chillerlan\Settings\SettingsContainerInterface;

use function call_user_func, dirname, file_put_contents, get_called_class, in_array, is_writable, sprintf;

/**
 * common output abstract
 */
abstract class QROutputAbstract implements QROutputInterface
{

	/**
	 * @var int
	 */
	protected $moduleCount;

	/**
	 * @param \xsuchy09\QRCode\Data\QRMatrix $matrix
	 */
	protected $matrix;

	/**
	 * @var \xsuchy09\QRCode\QROptions
	 */
	protected $options;

	/**
	 * @var string
	 */
	protected $outputMode;

	/**
	 * @var string;
	 */
	protected $defaultMode;

	/**
	 * @var int
	 */
	protected $scale;

	/**
	 * @var int
	 */
	protected $length;

	/**
	 * @var array
	 */
	protected $moduleValues;

	/**
	 * QROutputAbstract constructor.
	 *
	 * @param \chillerlan\Settings\SettingsContainerInterface $options
	 * @param \xsuchy09\QRCode\Data\QRMatrix                  $matrix
	 */
	public function __construct(SettingsContainerInterface $options, QRMatrix $matrix)
	{
		$this->options = $options;
		$this->matrix = $matrix;
		$this->moduleCount = $this->matrix->size();
		$this->scale = $this->options->scale;
		$this->length = $this->moduleCount * $this->scale;

		$class = get_called_class();

		if (isset(QRCode::OUTPUT_MODES[$class]) && in_array($this->options->outputType, QRCode::OUTPUT_MODES[$class])) {
			$this->outputMode = $this->options->outputType;
		}

		$this->setModuleValues();
	}

	/**
	 * Sets the initial module values (clean-up & defaults)
	 *
	 * @return void
	 */
	abstract protected function setModuleValues(): void;

	/**
	 * @param string $data
	 * @param string $file
	 *
	 * @return bool
	 * @throws \xsuchy09\QRCode\Output\QRCodeOutputException
	 * @see file_put_contents()
	 *
	 */
	protected function saveToFile(string $data, string $file): bool
	{

		if (!is_writable(dirname($file))) {
			throw new QRCodeOutputException(sprintf('Could not write data to cache file: %s', $file));
		}

		return (bool)file_put_contents($file, $data);
	}

	/**
	 * @param string|null $file
	 *
	 * @return string|mixed
	 */
	public function dump(string $file = null)
	{
		$data = call_user_func([$this, $this->outputMode ?? $this->defaultMode]);
		$file = $file ?? $this->options->cachefile;

		if ($file !== null) {
			$this->saveToFile($data, $file);
		}

		return $data;
	}

}
