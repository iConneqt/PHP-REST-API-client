<?php

namespace Iconneqt\Api\Rest\Resources;

/**
 * Basic ListField object
 * 
 * @copyright (c) 2016, Advanced CRMMail Technology B.V., Netherlands
 * @license MIT
 * @author Martijn W. van der Lee 
 */
class ListField extends AbstractField
{

	private $date;
	private $userid;
	private $default;
	private $required;
	private $settings;
	private $role;
	private $tuple;	// only available for administrators

	public function __construct(\Iconneqt\Api\Rest\Iconneqt $iconneqt, $field)
	{
		parent::__construct($iconneqt, $field);

		$this->date = new \DateTime($field->date);
		$this->userid = $field->user;
		$this->default = $field->default;
		$this->required = $field->required;
		$this->settings = $field->settings;
		$this->role = $field->role;
		$this->tuple = isset($field->tuple) ? (int) $field->tuple : null;
	}

	public function getDate()
	{
		return $this->date;
	}

	public function getUserId()
	{
		return $this->userid;
	}

	public function getDefault()
	{
		return $this->default;
	}

	public function isRequired()
	{
		return $this->required;
	}

	public function getSettings()
	{
		return $this->settings;
	}

	public function getRole()
	{
		return $this->role;
	}

	public function getTuple()
	{
		return $this->tuple;
	}

}
