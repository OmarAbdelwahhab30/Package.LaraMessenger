<?php

namespace Tests\Feature;

use App\Events\SendMessageEvent;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Event;
use Mockery\Mock;
use Omarabdulwahhab\Laramessenger\CoreServices\LaraMessenger;
use Tests\TestCase;

class SendingMessagesTest extends TestCase
{

    use DatabaseMigrations;

    public function test_sending_text_Without_broadcasting(): void
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $config = LaraMessenger::builder()
            ->setSenderID($user1->id)
            ->setReceiverID($user2->id)
            ->setMessageType('text')
            ->setMessage('Hello From User 1')
            ->build();

        $message = $config->send();

        $this->assertDatabaseHas('messages', Arr::except($message->toArray(), ['created_at', 'updated_at']));

        $this->assertDatabaseHas('chat', [
            'id' => $message->chat_id,
            'first_user' => $config->getSenderID(),
            'second_user' => $config->getReceiverID(),
        ]);
    }

    public function test_sending_file_Without_broadcasting(): void
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $file = UploadedFile::fake()->image('avatar.jpg');

        $config = LaraMessenger::builder()
            ->setSenderID($user1->id)
            ->setReceiverID($user2->id)
            ->setMessageType('file')
            ->setMessage($file)
            ->build();

        $message = $config->send();

        $file = str_replace([asset("storage/"), '/', '\\'], '', $message->content);
        $this->assertDatabaseHas('messages', [
            "from_user" => $message->from_user,
            "to_user" => $message->to_user,
            "content" => $file,
            "type" => $message->type,
            "chat_id" => $message->chat_id,
            'id' => $message->id
        ]);


        $this->assertDatabaseHas('chat', [
            'id' => $message->chat_id,
            'first_user' => $config->getSenderID(),
            'second_user' => $config->getReceiverID(),
        ]);

        $this->assertFileExists(storage_path('app/public/chat') . DIRECTORY_SEPARATOR . $file);
    }

    public function test_sending_voice_Without_broadcasting(): void
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $file = UploadedFile::fake()->create('voice.mp3', 500, 'audio/mpeg');

        $config = LaraMessenger::builder()
            ->setSenderID($user1->id)
            ->setReceiverID($user2->id)
            ->setMessageType('file')
            ->setMessage($file)
            ->build();

        $message = $config->send();

        $file = str_replace([asset("storage/"), '/', '\\'], '', $message->content);
        $this->assertDatabaseHas('messages', [
            "from_user" => $message->from_user,
            "to_user" => $message->to_user,
            "content" => $file,
            "type" => $message->type,
            "chat_id" => $message->chat_id,
            'id' => $message->id
        ]);


        $this->assertDatabaseHas('chat', [
            'id' => $message->chat_id,
            'first_user' => $config->getSenderID(),
            'second_user' => $config->getReceiverID(),
        ]);

        $this->assertFileExists(storage_path('app/public/chat') . DIRECTORY_SEPARATOR . $file);
    }


    public function test_sending_text_With_broadcasting(): void
    {
        Event::fake();

        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $config = LaraMessenger::builder()
            ->setSenderID($user1->id)
            ->setReceiverID($user2->id)
            ->setMessageType('text')
            ->setMessage('Hello From User 1')
            ->build();

        $message = $config->broadcast();

        Event::assertDispatched(SendMessageEvent::class, function ($e) use ($message) {
            return $e->message->id === $message->id;
        });

        $this->assertDatabaseHas('messages', Arr::except($message->toArray(), ['created_at', 'updated_at']));

        $this->assertDatabaseHas('chat', [
            'id' => $message->chat_id,
            'first_user' => $config->getSenderID(),
            'second_user' => $config->getReceiverID(),
        ]);
    }

    public function test_sending_file_With_broadcasting(): void
    {
        Event::fake();

        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $file = UploadedFile::fake()->image('avatar.jpg');

        $config = LaraMessenger::builder()
            ->setSenderID($user1->id)
            ->setReceiverID($user2->id)
            ->setMessageType('file')
            ->setMessage($file)
            ->build();

        $message = $config->broadcast();

        Event::assertDispatched(SendMessageEvent::class, function ($e) use ($message) {
            return $e->message->id === $message->id;
        });

        $file = str_replace([asset("storage/"), '/', '\\'], '', $message->content);
        $this->assertDatabaseHas('messages', [
            "from_user" => $message->from_user,
            "to_user" => $message->to_user,
            "content" => $file,
            "type" => $message->type,
            "chat_id" => $message->chat_id,
            'id' => $message->id
        ]);


        $this->assertDatabaseHas('chat', [
            'id' => $message->chat_id,
            'first_user' => $config->getSenderID(),
            'second_user' => $config->getReceiverID(),
        ]);

        $this->assertFileExists(storage_path('app/public/chat') . DIRECTORY_SEPARATOR . $file);
    }

    public function test_sending_voice_With_broadcasting(): void
    {
        Event::fake();

        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $file = UploadedFile::fake()->create('voice.mp3', 500, 'audio/mpeg');

        $config = LaraMessenger::builder()
            ->setSenderID($user1->id)
            ->setReceiverID($user2->id)
            ->setMessageType('file')
            ->setMessage($file)
            ->build();

        $message = $config->broadcast();

        Event::assertDispatched(SendMessageEvent::class, function ($e) use ($message) {
            return $e->message->id === $message->id;
        });

        $file = str_replace([asset("storage/"), '/', '\\'], '', $message->content);

        $this->assertDatabaseHas('messages', [
            "from_user" => $message->from_user,
            "to_user" => $message->to_user,
            "content" => $file,
            "type" => $message->type,
            "chat_id" => $message->chat_id,
            'id' => $message->id
        ]);


        $this->assertDatabaseHas('chat', [
            'id' => $message->chat_id,
            'first_user' => $config->getSenderID(),
            'second_user' => $config->getReceiverID(),
        ]);

        $this->assertFileExists(storage_path('app/public/chat') . DIRECTORY_SEPARATOR . $file);
    }
}
