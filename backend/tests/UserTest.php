<?php

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    // Test that admin can successfully get the user list with valid token
    public function testAdminCanGetUserList()
    {
        $token = $this->loginAsAdmin();

        $ch = curl_init('http://127.0.0.1:5501/backend/users');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $token
        ]);
        $response = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $data = json_decode($response, true);

        $this->assertEquals(200, $status, "Expected HTTP status 200");
        $this->assertIsArray($data, "Response should be an array");
    }

    // Helper method to log in as admin and get JWT token
    private function loginAsAdmin()
    {
        $ch = curl_init('http://127.0.0.1:5501/backend/login');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            'email' => 'admin@example.com',  
            'password' => 'adminpass'       
        ]));
        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);

        if (!isset($data['token'])) {
            $this->fail("Login failed or token not returned");
        }

        return $data['token'];
    }
}
