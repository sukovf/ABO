<?php

namespace snoblucha\Abo;

/**
 * Class Group
 * @package snoblucha\Abo
 */
class Group
{
	private $account_number = null;
	private $account_pre_number = null;

	/** @var Item[] */
	private $items = [];

	private $dueDate = null;

	/**
	 * @param string $senderBank
	 *
	 * @return string
	 */
	public function generate($senderBank = '')
	{
		$res = "2 ";
		if($this->account_number != null) {
			$res .= Abo::account($this->account_number, $this->account_pre_number) . " ";
		} 
		if($this->dueDate == null) $this->setDate(); //date is not set, so today is the day
		$res .= sprintf("%014d %s", $this->getAmount(), $this->dueDate);		
		$res .= "\r\n";
		foreach ($this->items as $item) {
			$res .= $item->generate($this->account_number != null, $senderBank);
		}
		$res .= "3 +\r\n";
		return $res;
	}
	
	/**
	 * 
	 * Set date of the execution
	 * @param unknown_type $date
	 */
	public function setDate($date = null){
		if($date == null) $date = date('dmy');
		$this->dueDate = $date;
		return $this;
	}
	
	/**
	 * Set the account for the full group. The account will not be rendered in intems
	 * Optional item! Account that is used on one side (Our) 
	 * @param int $number
	 * @param int $pre
	 */
	public function setAccount($number, $pre = null) {
		$this->account_number = $number;
		$this->account_pre_number = $pre;
	}
	
	/**
	 * 
	 * adds abo_item to group. and returns it for set up/
	 * @return Item
	 */
	public function addItem($account_number, $amount, $variable_sym){
		$item = new Item($account_number, $amount, $variable_sym);
		$this->items[] = $item;
		return $item;		
	}
	
	/**
	 * Get the amount in halere
	 * @return int 
	 */
	public function getAmount(){
		$res = 0;
		foreach ($this->items as $item) {
			$res += $item->getAmount();
		}
		return $res;
	}
}
