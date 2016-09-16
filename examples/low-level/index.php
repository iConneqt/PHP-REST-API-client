<?php

/**
 * This example demonstrates getting information about subscriber lists
 */

require_once dirname(__DIR__) . '/common.php';

$client = new Iconneqt\Api\Rest\Client\Client(ICONNEQT_URL, ICONNEQT_USERNAME, ICONNEQT_PASSWORD);

$results = $client->get('lists');

var_dump($results);

