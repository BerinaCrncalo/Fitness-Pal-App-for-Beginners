<?php
use PHPUnit\Framework\TestCase;

class AuthTest extends TestCase
{
    private $testUserEmail = 'testuser@fitnesspal.test';
    private $testUserPassword = 'fitness123';

    public function testSuccessfulRegistration()
    {
        $response = $this->post('/auth/register', [
            'name' => 'Test User',
            'email' => $this->testUserEmail,
            'password' => $this->testUserPassword
        ]);

        $this->assertEquals(200, $response['status']);
        $this->assertArrayHasKey('data', $response['body']);
    }

    public function testLoginReturnsToken()
    {
        $response = $this->post('/auth/login', [
            'email' => $this->testUserEmail,
            'password' => $this->testUserPassword
        ]);

        $this->assertEquals(200, $response['status']);
        $this->assertArrayHasKey('token', $response['body']);
    }

    private function post($endpoint, $payload)
    {
        $url = 'http://127.0.0.1:5501/backend' . $endpoint; 

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        $response = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return [
            'status' => $status,
            'body' => json_decode($response, true)
        ];
    }
}
