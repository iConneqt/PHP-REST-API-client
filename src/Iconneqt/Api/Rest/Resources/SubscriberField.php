<?php

namespace Iconneqt\Api\Rest\Resources;

/**
 * Basic ListField object
 * 
 * @copyright (c) 2016, Advanced CRMMail Technology B.V., Netherlands
 * @license MIT
 * @author Martijn W. van der Lee 
 */
class SubscriberField extends AbstractField implements \JsonSerializable
{

	private $data;
	private $value;

	public function __construct(\Iconneqt\Api\Rest\Iconneqt $iconneqt, $field)
	{
		parent::__construct($iconneqt, $field);

		$this->data = $field->data;
		$this->value = $field->value;
	}

	public function jsonSerialize()
	{
		return [
			'data' => $this->data,
			'value' => $this->value,
		];
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
