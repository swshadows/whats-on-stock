<?php

class Item
{
	private string $name;
	private int $qty;

	public function __construct($em, $ps)
	{
		$this->name = $em;
		$this->qty = $ps;
	}

	// Getters
	public function get_name()
	{
		return $this->name;
	}
	public function get_qty()
	{
		return $this->qty;
	}

	// Setters
	public function set_name($var)
	{
		$this->name = $var;
	}
	public function set_qty($var)
	{
		$this->qty = $var;
	}

	// Valida o nome do item
	public function validate_name()
	{
		if (strlen($this->name) > 0) {
			return true;
		} else {
			return false;
		}
	}
}
