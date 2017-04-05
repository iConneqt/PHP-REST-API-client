<?php

namespace Iconneqt\Api\Rest\Client;

use Iconneqt\Api\Rest\Client\StatusCodeException;

/**
 * Low-level connection to the Iconneqt REST API
 *
 * @copyright (c) 2016, Advanced CRMMail Technology B.V., Netherlands
 * @license MIT
 * @author Martijn W. van der Lee
 */
class Client
{

	const GET = 'GET';
	const POST = 'POST';
	const PATCH = 'PATCH';
	const PUT = 'PUT';
	const DELETE = 'DELETE';

	private $url;
	private $username;
	private $token;

	public function __construct($url, $username, $token)
	{
		$this->url = $url;
		$this->username = $username;
		$this->token = $token;
	}

	/**
	 * Perform an API call
	 * @param string $method one of the predefined constants
	 * @param string $path the API endpoint to use, minus slashes
	 * @param array|null $post_data map of post data
	 * @param boolean $associative_return set to true to return an associative array, otherwise an object will be returned.
	 * @return mixed
	 * @throws Exception
	 * @throws StatusCodeException
	 */
	public function call($method, $path, $post_data = null, $associative_return = false)
	{
		$ch = curl_init();

		curl_setopt_array($ch, array(
			CURLOPT_CUSTOMREQUEST => strtoupper($method),
			CURLOPT_URL => $this->url . '/api/v1/' . trim($path, '/'),
			CURLOPT_USERPWD => $this->username . ':' . $this->token,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_HEADER => true,
		));

		if ($post_data) {
			if (is_array($post_data) || is_object($post_data)) {
				curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
			} else {
				curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
				curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data, JSON_NUMERIC_CHECK));
			}
		}

		if (($result = curl_exec($ch)) === false) {
			throw new \Exception(curl_error($ch), curl_errno($ch));
		};

		list($headers, $body) = explode("\r\n\r\n", $result);
		
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if ($httpcode >= 400) {
			preg_match('~HTTP/\S+ ([0-9]{3}) (.+)~m', $headers, $status);
			$error = json_decode($body);
			throw new StatusCodeException(trim($status[2]), $httpcode, isset($error->description) ? $error->description : null);
		}

		curl_close($ch);

		return json_decode($body, $associative_return);
	}

	/**
	 * Perform a GET, return $default if 404 is returned.
	 * @param string $path
	 * @param mixed $default
	 * @param boolean $associative_return
	 * @return mixwed
	 */
	public function get($path, $default = null, $associative_return = false)
	{
		try {
			return $this->call(self::GET, $path, null, $associative_return);
		} catch (StatusCodeException $e) {
			if ($e->getCode() !== 404) {
				throw $e;
			}
		}

		return $default;
	}

	/**
	 * Perform a DELETE, return $default if 404 is returned.
	 * @param string $path
	 * @param mixed $default
	 * @param boolean $associative_return
	 * @return mixwed
	 */
	public function delete($path, $default = null, $associative_return = false)
	{
		try {
			return $this->call(self::DELETE, $path, null, $associative_return);
		} catch (StatusCodeException $e) {
			if ($e->getCode() !== 404) {
				throw $e;
			}
		}

		return $default;
	}

	/**
	 * Perform a PATCH, return $default if 404 is returned.
	 * @param string $path
	 * @param array $data
	 * @param mixed $default
	 * @param boolean $associative_return
	 * @return mixwed
	 */
	public function patch($path, $data = null, $default = null, $associative_return = false)
	{
		try {
			return $this->call(self::PATCH, $path, $data, $associative_return);
		} catch (StatusCodeException $e) {
			if ($e->getCode() !== 404) {
				throw $e;
			}
		}

		return $default;
	}

	/**
	 * Perform a PUT, return $default if 404 is returned.
	 * @param string $path
	 * @param array $data
	 * @param mixed $default
	 * @param boolean $associative_return
	 * @return mixwed
	 */
	public function put($path, $data = null, $default = null, $associative_return = false)
	{
		try {
			return $this->call(self::PUT, $path, $data, $associative_return);
		} catch (StatusCodeException $e) {
			if ($e->getCode() !== 404) {
				throw $e;
			}
		}

		return $default;
	}

	/**
	 * Perform a POST, return $default if 404 is returned.
	 * @param string $path
	 * @param array $data
	 * @param mixed $default
	 * @param boolean $associative_return
	 * @return mixwed
	 */
	public function post($path, $data = null, $default = null, $associative_return = false)
	{
		try {
			return $this->call(self::POST, $path, $data, $associative_return);
		} catch (StatusCodeException $e) {
			if ($e->getCode() !== 404) {
				throw $e;
			}
		}

		return $default;
	}

}
