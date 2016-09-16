<?php

/**
 * Tests the Client entrypoint.
 * Note that this test is woefully incomplete.
 */
class ClientTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @group sanity
	 */
	public function testGetLists()
	{
		$client = new Iconneqt\Api\Rest\Client\Client(ICONNEQT_URL, ICONNEQT_USERNAME, ICONNEQT_PASSWORD);
		$result = $client->get('lists');
		$this->assertInternalType('array', $result);
	}

}
