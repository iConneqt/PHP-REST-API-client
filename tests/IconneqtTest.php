<?php

/**
 * Tests the Iconneqt entrypoint.
 * Note that this test is woefully incomplete.
 */
class IconneqtTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @group sanity
	 */
	public function testGetLists()
	{
		$iconneqt = new Iconneqt\Api\Rest\Iconneqt(ICONNEQT_URL, ICONNEQT_USERNAME, ICONNEQT_PASSWORD);
		$result = $iconneqt->getLists();
		$this->assertInternalType('array', $result);
	}

}
