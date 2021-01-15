<?php

namespace snoblucha\Abo\Account;

use snoblucha\Abo\Group;
use snoblucha\Abo\Item;

class File {

	const UHRADA = 1501;
	const INKASO = 1502;

	private $number = 0;
	private $type = self::UHRADA;
	private $bank = 0;
	private $bankDepartment = 0;

	/** @var Item[] */
	private $items = array();

	public function __construct($type = self::UHRADA){
		$this->type = $type;
	}

	/**
	 *
	 * Generate string,
	 * @param string $senderBank
	 * @return string
	 */
	public function generate($senderBank = '')
	{
		$res = sprintf("1 %04d %03d%03d %04d\r\n",$this->type, $this->number, $this->bankDepartment, $this->bank);
		foreach ($this->items as $item) {
			$res.= $item->generate(true, $senderBank);
		}
		$res .= "5 +\r\n";
		return $res;
	}

	/**
	 *
	 * Set the bank deparment - pobocka. 0 in general
	 * @param int $number
	 * @return File
	 */
	public function setBankDepartment($number){
		$this->bankDepartment = $number;
		return $this;
	}

	/**
	 *
	 * set number of file. Should be called only from abo
	 * @param unknown_type $number
	 * @return File
	 */
	public function setNumber($number) {
		$this->number = $number;
		return $this;
	}

	/**
	 *
	 * Nastavit typ
	 * @param int $type 1501 - uhrady, 1502 - inkasa

	 */
	public function setType($type){
		$this->type = $type;
		return $this;
	}

	/**
	 * nastavit kod banky, ktere se dany soubor tyka(ktere to posilame?)
	 *
	 * @param int/string $bankCode kod banky
	 * @return File
	 */
	public function setBank($bankCode){
		$this->bank = $bankCode;
		return $this;
	}

	/**
	 * Add a group to item and return it to set up
	 *
	 * @return Group
	 */
	public function addGroup(){
		$item = new Group();
		$this->items[] = $item;
		return $item;
	}
}
