<?php

namespace Tests\Feature;

use App\Models\Chat;
use App\Models\Message;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Omarabdulwahhab\Laramessenger\CoreServices\ChatLoader;
use Tests\TestCase;

class LoadingMessagesTest extends TestCase
{
    use DatabaseMigrations;

    public function test_loading_the_chat_by_chatID()
    {

        $firstChat = $this->returnFirstChat();

        $chat = ChatLoader::LoadChatByChatID($firstChat->id);

        $this->assertNotEmpty($chat);

        $this->assertJson($chat);

        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $chat);

        $this->assertInstanceOf(Chat::class, $chat[0]);

        foreach ($chat[0]->messages as $message) {
            $this->assertInstanceOf(Message::class, $message);
        }

        $this->assertInstanceOf(Chat::class, $chat[0]);
    }

    public function test_chat_loading_performance()
    {
        $firstChat = $this->returnFirstChat();

        $startTime = microtime(true);

        ChatLoader::LoadChatByChatID($firstChat->id);

        $endTime = microtime(true);

        $executionTime = $endTime - $startTime;

        $this->assertLessThan(1, $executionTime, "Chat loading is too slow!");
    }

    public function test_loading_not_found_chat()
    {

        $chat = ChatLoader::LoadChatByChatID(-30);

        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $chat);

        $this->assertEmpty($chat);
    }

    public function test_loading_the_chat_by_UsersIDs()
    {

        $users = $this->getTwoUsers();

        $messages = ChatLoader::LoadChatByUsersID($users[0]->id, $users[1]->id, 'DESC');


        $this->assertNotEmpty($messages);

        $this->assertJson($messages);

        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $messages);

        foreach ($messages as $message) {
            $this->assertInstanceOf(Message::class, $message);
        }
    }

    public function test1_loading_the_chat_by_Scrolling()
    {

        $users = $this->getTwoUsers();

        $messages = ChatLoader::LoadChatByScrolling($users[0]->id, $users[1]->id, null, null);

        $this->assertNotEmpty($messages['Messages']);

        $lastCreatedAt = null;

        foreach ($messages['Messages'] as $message) {
            if ($lastCreatedAt) {

                $this->assertGreaterThanOrEqual(
                    $message->created_at,
                    $lastCreatedAt,
                    "Messages are not in descending order!"
                );
            }
            $lastCreatedAt = $message->created_at;
        }
    }

    public function test2_loading_the_chat_by_Scrolling()
    {
        $users = $this->getTwoUsers();

        $messages = ChatLoader::LoadChatByScrolling($users[0]->id, $users[1]->id, null, 2);

        $this->assertNotEmpty($messages['Messages']);

        $this->assertNotEmpty($messages['LatestMessageID']);

        $this->assertEquals(5, $messages['LatestMessageID']);
    }

    public function test3_loading_the_chat_by_Scrolling()
    {
        $users = $this->getTwoUsers();

        $messages = ChatLoader::LoadChatByScrolling($users[0]->id, $users[1]->id, 5, 2);

        $this->assertNotEmpty($messages['Messages']);

        $this->assertNotEmpty($messages['LatestMessageID']);

        $this->assertEquals(3, $messages['LatestMessageID']);
    }
}
