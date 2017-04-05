<?php

namespace Iconneqt\Api\Rest\Client;

/**
 * Exception thrown when unexpected status code is returned from the API
 * 
 * @copyright (c) 2016, Advanced CRMMail Technology B.V., Netherlands
 * @license MIT
 * @author Martijn W. van der Lee 
 */
class StatusCodeException extends \Exception
{
	private $description = null;
	
	/**
	 * (PHP 5 &gt;= 5.1.0, PHP 7)<br/>
	 * Construct the exception
	 * @link http://php.net/manual/en/exception.construct.php
	 * @param string $message [optional] <p>
	 * The Exception message to throw.
	 * </p>
	 * @param int $code [optional] <p>
	 * The Exception code.
	 * </p>
	 * @param Throwable $previous [optional] <p>
	 * The previous exception used for the exception chaining.
	 * </p>
	 */
	public function __construct($message = "", $code = 0, $description = null, Throwable $previous = null) {
		$this->description = $description;
		
		parent::__construct($message, $code, $previous);
	}
		
	/**
	 * (PHP 5 &gt;= 5.1.0, PHP 7)<br/>
	 * String representation of the exception
	 * @link http://php.net/manual/en/exception.tostring.php
	 * @return string the string representation of the exception.
	 */
	public function __toString() {
		$string = $this->getCode() . ' ' . $this->getMessage();
		
		if ($this->description) {
			$string .= ': ' . $this->description;
		}
		
		return $string;
	}
	
}
