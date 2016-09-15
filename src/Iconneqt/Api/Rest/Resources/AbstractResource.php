<?php

namespace Iconneqt\Api\Rest\Resources;

/**
 * Shared functionality of all resources
 * 
 * @author Martijn W. van der Lee
 */
class AbstractResource
{

	/**
	 * @var \Iconneqt\Api\Rest\Iconneqt
	 */
	protected $iconneqt;

	public function __construct(\Iconneqt\Api\Rest\Iconneqt $iconneqt)
	{
		$this->iconneqt = $iconneqt;
	}

}
