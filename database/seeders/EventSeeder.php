<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::factory(5)
            ->has(Event::factory(10))
            ->create();

        // Для каждого созданного события добавляем случайных участников
        $users->each(function ($user) {
            $events = $user->events;

            $events->each(function ($event) use ($user) {
                // Добавляем случайных участников (например, 3 случайных пользователя) к каждому событию
                $randomUsers = User::inRandomOrder()->take(3)->pluck('id');
                $event->users()->attach($randomUsers, [
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            });
        });

//        User::factory(5)
//            ->has(Event::factory(10))
//            ->create();
    }
}
