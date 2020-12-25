<?php
require_once 'vendor/autoload.php';

class IntegrationTest extends IntegrationTestCase{

    public function test_status_index()
    {
        $response = $this->make_request("GET", "/");
        $this->assertEquals(200, $response->getStatusCode());

    } 

 
}