<?php

namespace snoblucha\Abo;

/**
 * Class Formatter6800
 * @package snoblucha\Abo
 */
final class Formatter6800 extends DefaultFormatter
{
	/**
	 * @param string $symbol
	 *
	 * @return string
	 */
	public function formatSpecificSymbol($symbol)
	{
		return strlen($symbol) ? $symbol : '';
	}
}