<?php

namespace snoblucha\Abo;

/**
 * Class AboDefaultFormatter
 * @package snoblucha\Abo
 */
class DefaultFormatter
{
	/**
	 * @param string $symbol
	 *
	 * @return string
	 */
	public function formatVariableSymbol($symbol)
	{
		return $symbol;
	}

	/**
	 * @param string $symbol
	 *
	 * @return string
	 */
	public function formatSpecificSymbol($symbol)
	{
		return strlen($symbol) ? $symbol : ' ';
	}

	/**
	 * @param string $symbol
	 *
	 * @return string
	 */
	public function formatConstantSymbol($symbol)
	{
		return $symbol;
	}
}