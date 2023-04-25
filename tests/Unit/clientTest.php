<?php

use App\Http\Controllers\ClientController;
use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Tests\TestCase;

class clientTest extends TestCase
{
    use RefreshDatabase;

    public function testStoreMethodAddsNewClientAndRedirects()
    {
        $data = [
            'first_name' => 'Aleksander',
            'last_name' => 'Coop',
            'birthday' => '2000-02-02',
            'gender_id' => '1',
            'description' => 'some text',
            'surname' => 'Sergeevich',
            'phone' => 987654321,
            'email' => 'test@admin.ua',

        ];
        // Arrange
        $request = Request::create('/user/client', 'POST', $data);
        $controller = new ClientController();

        // Act
        $response = $controller->store($request);

        // Assert
        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertDatabaseHas('clients', $data);
        $this->assertEquals(env('APP_URL').'/user/client', $response->headers->get('location'));
    }

    public function testUpdateMethodEditsClientAndRedirects()
    {
        // Arrange
        $client = Client::factory()->create([
            'first_name' => 'Aleksander',
            'last_name' => 'Coop',
            'birthday' => '2000-02-02',
            'gender_id' => '1',
            'description' => 'some text',
            'surname' => 'Sergeevich',
            'phone' => 987654321,
            'email' => 'test@admin.ua',
        ]);
        $request = Request::create("/user/client/$client->id", 'PUT', [
            'first_name' => 'Aleksander1',
            'last_name' => 'Coop1',
            'birthday' => '2000-02-03',
            'gender_id' => '2',
            'description' => 'some text there',
            'surname' => 'Sergeevich1',
            'phone' => 987654322,
            'email' => 'test1@admin.ua',
        ]);
        $controller = new ClientController();

        // Act
        $response = $controller->update($request, $client->id);

        // Assert
        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertDatabaseHas('clients', [
            'id' => $client->id,
            'first_name' => 'Aleksander1',
            'last_name' => 'Coop1',
            'birthday' => '2000-02-03',
            'gender_id' => '2',
            'description' => 'some text there',
            'surname' => 'Sergeevich1',
            'phone' => 987654322,
            'email' => 'test1@admin.ua',
        ]);
        $this->assertEquals(env('APP_URL').'/user/client', $response->headers->get('location'));
    }

    public function testCommentAdd()
    {
        // Create a test client
        $client = Client::factory()->create([
            'id' => 1,
            'first_name' => 'Aleksander1',
            'last_name' => 'Coop1',
            'birthday' => '2000-02-03',
            'gender_id' => '2',
            'description' => 'some text there',
            'surname' => 'Sergeevich1',
            'phone' => 987654322,
            'comment' => 'Test',
            'email' => 'test1@admin.ua']);

        // Create a test request
        $request = new Request([
            'id' => 1,
            'comment' => 'Test comment',
        ]);

        // Call the comment_add method
        $response = $this->post(env('APP_URL').'/client_comment_add', $request->all());

        // Assert that the response is a redirect to /user/client
//        $response->assertRedirect('/user/client');

        // Assert that the comment was added to the client
        $this->assertDatabaseHas('clients', [
            'id' => 1,
            'comment' => 'Test comment',
        ]);
    }
}
