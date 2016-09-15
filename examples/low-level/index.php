<?php

/**
 * This example demonstrates getting information about subscriber lists
 */

require_once dirname(__DIR__) . '/common.php';

$iconneqt = new Iconneqt\Api\Rest\Client\Client(EXAMPLE_URL, EXAMPLE_USERNAME, EXAMPLE_PASSWORD);

$results = $iconneqt->get('lists');

var_dump($results);

