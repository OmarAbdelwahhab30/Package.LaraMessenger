<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Omarabdulwahhab\Laramessenger\CoreServices\MessageManager;
use Tests\TestCase;

class MessageManagerTest extends TestCase
{
    use DatabaseMigrations;

    public function test_editing_message_is_done_correctly(): void
    {
        $message = $this->getAnyMessage();

        $bool = MessageManager::editMessage($message->id, 'How are you ?!');

        $this->assertTrue($bool);

        $this->assertDatabaseHas('messages', [
            'id' => $message->id,
            'content' => 'How are you ?!',
            'type' => 'text',
        ]);
    }


    public function test_deletion_message_is_done_correctly(): void
    {
        $message = $this->getAnyMessage();

        $bool = MessageManager::deleteMessage($message->id);

        $this->assertTrue($bool);

        $this->assertDatabaseMissing('messages', [
            'id' => $message->id
        ]);
    }

    public function test_deletion_group_of_messages_is_done_correctly(): void
    {
        $ids = array_column($this->getGroupOfMessagesIds(),"id");

        $bool = MessageManager::deleteMessages($ids);

        $this->assertTrue($bool);

        foreach ($ids as $id) {
            $this->assertDatabaseMissing('messages', ['id' => $id]);
        }
    }
}
