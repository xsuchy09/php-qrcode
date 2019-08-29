<?php
/**
 * Class MyCustomOutput
 *
 * @filesource   MyCustomOutput.php
 * @created      24.12.2017
 * @package      xsuchy09\QRCodeExamples
 * @author       Smiley <smiley@chillerlan.net>
 * @copyright    2017 Smiley
 * @license      MIT
 */

namespace xsuchy09\QRCodeExamples;

use xsuchy09\QRCode\Output\QROutputAbstract;

class MyCustomOutput extends QROutputAbstract
{

	protected function setModuleValues(): void
	{
		// TODO: Implement setModuleValues() method.
	}

	public function dump(string $file = null)
	{

		$output = '';

		for ($row = 0; $row < $this->moduleCount; $row++) {
			for ($col = 0; $col < $this->moduleCount; $col++) {
				$output .= (int)$this->matrix->check($col, $row);
			}
		}

		return $output;
	}

}
