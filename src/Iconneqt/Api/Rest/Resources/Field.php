<?php

namespace Iconneqt\Api\Rest\Resources;

/**
 * Basic Field object
 * 
 * @copyright (c) 2017, Advanced CRMMail Technology B.V., Netherlands
 * @license MIT
 * @author Martijn W. van der Lee 
 */
class Field extends AbstractField
{

	private $date;
	private $userid;
	private $default;
	private $required;
	private $settings;

	public function __construct(\Iconneqt\Api\Rest\Iconneqt $iconneqt, $field)
	{
		parent::__construct($iconneqt, $field);

		$this->date = new \DateTime($field->date);
		$this->userid = $field->user;
		$this->default = $field->default;
		$this->required = $field->required;
		$this->settings = $field->settings;
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

}
