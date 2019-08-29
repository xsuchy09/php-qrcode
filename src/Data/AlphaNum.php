<?php
/**
 * Class AlphaNum
 *
 * @filesource   AlphaNum.php
 * @created      25.11.2015
 * @package      xsuchy09\QRCode\Data
 * @author       Smiley <smiley@chillerlan.net>
 * @copyright    2015 Smiley
 * @license      MIT
 */

namespace xsuchy09\QRCode\Data;

use xsuchy09\QRCode\QRCode;

use function array_search, ord, sprintf;

/**
 * Alphanumeric mode: 0 to 9, A to Z, space, $ % * + - . / :
 */
class AlphaNum extends QRDataAbstract
{

	/**
	 * @inheritdoc
	 */
	protected $datamode = QRCode::DATA_ALPHANUM;

	/**
	 * @inheritdoc
	 */
	protected $lengthBits = [9, 11, 13];

	/**
	 * @inheritdoc
	 */
	protected function write(string $data): void
	{

		for ($i = 0; $i + 1 < $this->strlen; $i += 2) {
			$this->bitBuffer->put($this->getCharCode($data[$i]) * 45 + $this->getCharCode($data[$i + 1]), 11);
		}

		if ($i < $this->strlen) {
			$this->bitBuffer->put($this->getCharCode($data[$i]), 6);
		}

	}

	/**
	 * @param string $chr
	 *
	 * @return int
	 * @throws \xsuchy09\QRCode\Data\QRCodeDataException
	 */
	protected function getCharCode(string $chr): int
	{
		$i = array_search($chr, $this::ALPHANUM_CHAR_MAP);

		if ($i !== false) {
			return $i;
		}

		throw new QRCodeDataException(sprintf('illegal char: "%s" [%d]', $chr, ord($chr)));
	}

}
