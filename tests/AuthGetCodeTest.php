<?php

namespace Tests;

class AuthGetCodeTest extends TestCase
{

    private $route = '/api/auth/get-code';

    public function testRequestMethod()
    {

        $response = $this->call('GET', $this->route);
        $this->assertEquals(405, $response->status());

    }

    public function testRequestValidation()
    {

        $response = $this->call('POST', $this->route, []);
        $this->assertEquals(422, $response->status());
    }

    public function testRequestResponse()
    {

        $response = $this->call('POST', $this->route, ['mobile_number' => '09122305117']);
        $this->assertEquals(200, $response->status());

        $receive = json_decode($response->getContent());
        $this->assertTrue(isset($receive->message));
        $this->assertTrue(isset($receive->data));
        $this->assertTrue(isset($receive->data->auth_code) && strlen($receive->data->auth_code) == 5);
    }
}
