<?php

namespace snoblucha\Abo;

/**
 * Class Formatter0100
 * @package snoblucha\Abo
 */
final class Formatter0100 extends DefaultFormatter
{
	/**
	 * @param string $symbol
	 *
	 * @return string
	 */
	public function formatSpecificSymbol($symbol)
	{
		return strlen($symbol) ? $symbol : '0';
	}
}