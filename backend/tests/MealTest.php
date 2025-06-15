<?php
use PHPUnit\Framework\TestCase;

class MealTest extends TestCase
{
    private $baseUrl = "http://127.0.0.1:5501/backend";

    // Helper function to get API token (assuming you have a login route)
    private function getToken()
    {
        $ch = curl_init("$this->baseUrl/login");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            'email' => 'testuser@fitnesspal.test',
            'password' => 'fitness123'
        ]));
        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);
        return $data['token'] ?? null;
    }

    public function testGetAllMeals()
    {
        $token = $this->getToken();
        $ch = curl_init("$this->baseUrl/meals");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $token
        ]);
        $response = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $data = json_decode($response, true);
        $this->assertEquals(200, $status);
        $this->assertIsArray($data);
    }

    public function testAddMeal()
    {
        $token = $this->getToken();
        $mealData = [
            "name" => "Test Meal",
            "calories" => 500,
            "protein" => 40,
            "carbs" => 50,
            "fat" => 20
        ];

        $ch = curl_init("$this->baseUrl/meal");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $token,
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($mealData));
        $response = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $data = json_decode($response, true);

        $this->assertEquals(200, $status);
        $this->assertArrayHasKey('data', $data);
        $this->assertEquals('Test Meal', $data['data']['name'] ?? $mealData['name']);
        
        // Return ID for use in other tests
        return $data['data']['id'] ?? null;
    }

    /**
     * @depends testAddMeal
     */
    public function testGetMealById($mealId)
    {
        $token = $this->getToken();
        $ch = curl_init("$this->baseUrl/meal/$mealId");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $token
        ]);
        $response = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $data = json_decode($response, true);

        $this->assertEquals(200, $status);
        $this->assertEquals($mealId, $data['id'] ?? null);
    }

    /**
     * @depends testAddMeal
     */
    public function testUpdateMeal($mealId)
    {
        $token = $this->getToken();
        $updatedData = [
            "name" => "Updated Meal",
            "calories" => 600,
            "protein" => 45,
            "carbs" => 55,
            "fat" => 25
        ];

        $ch = curl_init("$this->baseUrl/meal/$mealId");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $token,
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($updatedData));
        $response = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $data = json_decode($response, true);

        $this->assertEquals(200, $status);
        $this->assertEquals('Updated Meal', $data['data']['name'] ?? null);
    }

    /**
     * @depends testAddMeal
     */
    public function testDeleteMeal($mealId)
    {
        $token = $this->getToken();
        $ch = curl_init("$this->baseUrl/meal/$mealId");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $token
        ]);
        $response = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $data = json_decode($response, true);

        $this->assertEquals(200, $status);
        $this->assertEquals("Meal deleted successfully", $data['message'] ?? null);
    }
}
