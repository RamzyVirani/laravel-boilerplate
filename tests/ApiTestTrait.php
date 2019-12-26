<?php

namespace Tests;

trait ApiTestTrait
{
    public function assertApiResponse(Array $actualData)
    {
        $this->assertApiSuccess();

        $response     = json_decode($this->response->getContent(), true);
        $responseData = $response['data'];

        $this->assertNotEmpty($responseData['id']);
        $this->assertModelData($actualData, $responseData);
    }

    public function assertApiSuccess()
    {
        $this->assertResponseOk();
        $this->seeJson(['success' => true]);
    }

    public function assertModelData(Array $actualData, Array $expectedData)
    {
        foreach ($actualData as $key => $value) {
            $this->assertEquals($actualData[$key], $expectedData[$key]);
        }
    }

    public function assertResponseOk()
    {
        $this->response->assertOk();
    }

    public function assertResponseStatus($status)
    {
        $this->response->assertStatus($status);
    }

    public function seeJson($json)
    {
        $this->response->assertJson($json);
    }

    public function json($method, $uri, array $data = [], array $headers = [])
    {
        $this->response = parent::json($method, $uri, $data, $headers);
    }
}