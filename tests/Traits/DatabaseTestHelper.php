<?php

namespace Tests\Traits;

use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Carbon;

trait DatabaseTestHelper
{

    private function createUsers()
    {
        return User::insert([
            ['id' => 571, 'name' => 'User 571', 'email' => 'user571@example.com', 'password' => bcrypt('password123')],
            ['id' => 572, 'name' => 'User 572', 'email' => 'user572@example.com', 'password' => bcrypt('password123')],
            ['id' => 573, 'name' => 'User 573', 'email' => 'user573@example.com', 'password' => bcrypt('password123')],
            ['id' => 574, 'name' => 'User 574', 'email' => 'user574@example.com', 'password' => bcrypt('password123')],
            ['id' => 575, 'name' => 'User 575', 'email' => 'user575@example.com', 'password' => bcrypt('password123')],
            ['id' => 576, 'name' => 'User 576', 'email' => 'user576@example.com', 'password' => bcrypt('password123')],
            ['id' => 577, 'name' => 'User 577', 'email' => 'user577@example.com', 'password' => bcrypt('password123')],
            ['id' => 578, 'name' => 'User 578', 'email' => 'user578@example.com', 'password' => bcrypt('password123')],
            ['id' => 579, 'name' => 'User 579', 'email' => 'user579@example.com', 'password' => bcrypt('password123')],
            ['id' => 580, 'name' => 'User 580', 'email' => 'user580@example.com', 'password' => bcrypt('password123')],
            ['id' => 581, 'name' => 'User 581', 'email' => 'user581@example.com', 'password' => bcrypt('password123')],
            ['id' => 582, 'name' => 'User 582', 'email' => 'user582@example.com', 'password' => bcrypt('password123')],
        ]);
    }

    private function createChats()
    {

        Chat::insert([
            ['id' => 275, 'first_user' => 573, 'second_user' => 574, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 276, 'first_user' => 575, 'second_user' => 576, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 277, 'first_user' => 577, 'second_user' => 578, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 278, 'first_user' => 579, 'second_user' => 580, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 279, 'first_user' => 581, 'second_user' => 582, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 280, 'first_user' => 571, 'second_user' => 572, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }

    private function createMessages()
    {

        Message::insert([

            ['chat_id' => 280, 'from_user' => 571, 'to_user' => 572, 'content' => 'إزيك يا صاحبي؟', 'type' => 'text', 'created_at' => '2024-03-16 12:07:00', 'updated_at' => '2024-03-16 12:07:00'],
            ['chat_id' => 280, 'from_user' => 572, 'to_user' => 571, 'content' => 'الحمد لله، أخبارك؟', 'type' => 'text', 'created_at' => '2024-03-16 12:07:10', 'updated_at' => '2024-03-16 12:07:10'],
            ['chat_id' => 280, 'from_user' => 571, 'to_user' => 572, 'content' => 'عامل إيه في الشغل؟', 'type' => 'text', 'created_at' => '2024-03-16 12:07:20', 'updated_at' => '2024-03-16 12:07:20'],
            ['chat_id' => 280, 'from_user' => 572, 'to_user' => 571, 'content' => 'ماشي الحال، ضغط جامد بس تمام.', 'type' => 'text', 'created_at' => '2024-03-16 12:07:30', 'updated_at' => '2024-03-16 12:07:30'],
            ['chat_id' => 280, 'from_user' => 571, 'to_user' => 572, 'content' => 'طب فاضي النهاردة نخرج؟', 'type' => 'text', 'created_at' => '2024-03-16 12:07:40', 'updated_at' => '2024-03-16 12:07:40'],
            ['chat_id' => 280, 'from_user' => 572, 'to_user' => 571, 'content' => 'خليني أشوف، ممكن أكون مشغول شوية.', 'type' => 'text', 'created_at' => '2024-03-16 12:07:50', 'updated_at' => '2024-03-16 12:07:50'],

            ['chat_id' => 275, 'from_user' => 573, 'to_user' => 574, 'content' => 'عامل إيه يا صاحبي؟', 'type' => 'text', 'created_at' => '2024-03-16 12:08:00', 'updated_at' => '2024-03-16 12:08:00'],
            ['chat_id' => 275, 'from_user' => 574, 'to_user' => 573, 'content' => 'كل شيء تمام، إنت أخبارك؟', 'type' => 'text', 'created_at' => '2024-03-16 12:08:10', 'updated_at' => '2024-03-16 12:08:10'],
            ['chat_id' => 275, 'from_user' => 573, 'to_user' => 574, 'content' => 'جاهز لماتش الكورة بكرة؟', 'type' => 'text', 'created_at' => '2024-03-16 12:08:20', 'updated_at' => '2024-03-16 12:08:20'],
            ['chat_id' => 275, 'from_user' => 574, 'to_user' => 573, 'content' => 'أكيد، لازم نكسب المرة دي!', 'type' => 'text', 'created_at' => '2024-03-16 12:08:30', 'updated_at' => '2024-03-16 12:08:30'],

            ['chat_id' => 276, 'from_user' => 575, 'to_user' => 576, 'content' => 'إيه رأيك في الفيلم اللي شفناه؟', 'type' => 'text', 'created_at' => '2024-03-16 12:09:00', 'updated_at' => '2024-03-16 12:09:00'],
            ['chat_id' => 276, 'from_user' => 576, 'to_user' => 575, 'content' => 'كان جامد جدًا، خصوصًا الأكشن فيه!', 'type' => 'text', 'created_at' => '2024-03-16 12:09:10', 'updated_at' => '2024-03-16 12:09:10'],
            ['chat_id' => 276, 'from_user' => 575, 'to_user' => 576, 'content' => 'بالظبط! لازم نشوف الجزء التاني لما ينزل.', 'type' => 'text', 'created_at' => '2024-03-16 12:09:20', 'updated_at' => '2024-03-16 12:09:20'],

            ['chat_id' => 277, 'from_user' => 577, 'to_user' => 578, 'content' => 'ذاكرت كويس للامتحان؟', 'type' => 'text', 'created_at' => '2024-03-16 12:10:00', 'updated_at' => '2024-03-16 12:10:00'],
            ['chat_id' => 277, 'from_user' => 578, 'to_user' => 577, 'content' => 'آه، بس خايف من الأسئلة الصعبة.', 'type' => 'text', 'created_at' => '2024-03-16 12:10:10', 'updated_at' => '2024-03-16 12:10:10'],
            ['chat_id' => 277, 'from_user' => 577, 'to_user' => 578, 'content' => 'متقلقش، هتعدي إن شاء الله.', 'type' => 'text', 'created_at' => '2024-03-16 12:10:20', 'updated_at' => '2024-03-16 12:10:20'],

            ['chat_id' => 278, 'from_user' => 579, 'to_user' => 580, 'content' => 'هنتمرن امتى النهاردة؟', 'type' => 'text', 'created_at' => '2024-03-16 12:11:00', 'updated_at' => '2024-03-16 12:11:00'],
            ['chat_id' => 278, 'from_user' => 580, 'to_user' => 579, 'content' => 'بعد الشغل مباشرة.', 'type' => 'text', 'created_at' => '2024-03-16 12:11:10', 'updated_at' => '2024-03-16 12:11:10'],
            ['chat_id' => 278, 'from_user' => 579, 'to_user' => 580, 'content' => 'تمام، هشوفك هناك.', 'type' => 'text', 'created_at' => '2024-03-16 12:11:20', 'updated_at' => '2024-03-16 12:11:20'],
        ]);
    }

    public function createTestData()
    {
        $this->createUsers();
        $this->createChats();
        $this->createMessages();
    }

    public function returnFirstChat(){
        return Chat::first();
    }

    public function getTwoUsers(){
        return User::latest()->take(2)->get();
    }

    public function getAnyMessage(){
        return Message::first();
    }

    public function getGroupOfMessagesIds(){
        return Message::latest()->select('id')->take(3)->get()->toArray();
    }
}
