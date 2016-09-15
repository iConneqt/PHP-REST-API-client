<?php

namespace Iconneqt\Api\Rest\Resources;

/**
 * Basic ListField object
 * 
 * @author Martijn W. van der Lee
 */
abstract class AbstractField extends AbstractResource
{

	private $id;
	private $name;
	private $type;

	public function __construct(\Iconneqt\Api\Rest\Iconneqt $iconneqt, $field)
	{
		parent::__construct($iconneqt);

		$this->id = $field->id;
		$this->name = $field->name;
		$this->type = $field->type;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getType()
	{
		return $this->type;
	}

}
