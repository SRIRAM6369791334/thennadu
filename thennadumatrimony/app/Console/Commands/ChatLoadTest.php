<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Message;
use App\Models\Conversation;
use App\Events\MessageSent;

class ChatLoadTest extends Command
{
    protected $signature = 'chat:load-test {count=1000}';
    protected $description = 'Simulate high load by broadcasting multiple chat messages rapidly';

    public function handle()
    {
        $count = (int) $this->argument('count');
        
        // Find conversation 6 specifically
        $conversation = Conversation::find(6);
        if (!$conversation) {
            $this->error("Conversation ID 6 not found.");
            return 1;
        }

        $this->info("Starting load test: Broadcasting {$count} messages to Conversation ID {$conversation->id}...");
        
        $startTime = microtime(true);
        $success = 0;
        
        $bar = $this->output->createProgressBar($count);
        $bar->start();

        // Use sender 82 as requested
        $senderId = 82;

        for ($i = 1; $i <= $count; $i++) {
            try {
                // Save directly to the database
                $message = Message::create([
                    'conversation_id' => $conversation->id,
                    'sender_id' => $senderId,
                    'message' => "Load test message #{$i}",
                    'is_read' => false
                ]);

                broadcast(new MessageSent($message, $conversation->id))->toOthers();
                $success++;
            } catch (\Exception $e) {
                // Ignore error to keep loop going
            }
            $bar->advance();
        }

        $bar->finish();
        $endTime = microtime(true);
        $duration = round($endTime - $startTime, 2);

        $this->newLine(2);
        $this->info("Load test completed in {$duration} seconds!");
        $this->info("Successfully broadcasted: {$success} / {$count}");
        
        return 0;
    }
}
