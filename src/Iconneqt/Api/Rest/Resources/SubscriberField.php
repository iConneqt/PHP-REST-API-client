<?php

namespace Iconneqt\Api\Rest\Resources;

/**
 * Basic ListField object
 * 
 * @author Martijn W. van der Lee
 */
class SubscriberField extends AbstractField
{

	private $data;
	private $value;

	public function __construct(\Iconneqt\Api\Rest\Iconneqt $iconneqt, $field)
	{
		parent::__construct($iconneqt, $field);

		$this->data = $field->data;
		$this->value = $field->value;
	}

	public function getData()
	{
		return $this->data;
	}

	public function getValue()
	{
		return $this->value;
	}

}
