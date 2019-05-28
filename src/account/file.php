<?php

namespace snoblucha\Abo\Account;

use snoblucha\Abo\Abo_group;

class Abo_account_file{
	
	const UHRADA = 1501; 
	const INKASO = 1502;
	 
	private $number = 0;
	private $type = self::UHRADA;
	private $bank = 0;
	private $bankDepartment = 0;
	
	private $items = array();
	
	public function __construct($type = self::UHRADA){
		$this->type = $type;
	}
	
	/**
	 * 
	 * Generate string, 
	 * @return string
	 */
	public function generate(){
		$res = sprintf("1 %04d %03d%03d %04d\r\n",$this->type, $this->number, $this->bankDepartment, $this->bank);
		foreach ($this->items as $item) {
			$res.= $item->generate();			
		}
		$res .= "5 +\r\n";
		return $res;
	}
	
	/**
	 * 
	 * Set the bank deparment - pobocka. 0 in general
	 * @param int $number
	 * @return abo_account_file
	 */
	public function setBankDepartment($number){
		$this->bankDepartment = $number;
		return $this;
	}
	
	/**
	 * 
	 * set number of file. Should be called only from abo
	 * @param unknown_type $number
	 * @return abo_account_file
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
	 * @return abo_account_file
	 */
	public function setBank($bankCode){
		$this->bank = $bankCode;
		return $this;
	}
	
	/**
	 * Add a group to item and return it to set up
	 * 
	 * @return abo_group
	 */
	public function addGroup(){
		$item = new Abo_group();
		$this->items[] = $item;
		return $item;
	}
}
