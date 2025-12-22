<?php

namespace App\Console\Commands;

use App\Models\Borrow;
use App\Notifications\OverdueNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckOverdueBooks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'library:check-overdue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for overdue books and notify users/librarians';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $overdueBorrows = Borrow::where('status', 'borrowed')
            ->where('due_date', '<', Carbon::now())
            ->get();

        foreach ($overdueBorrows as $borrow) {
            // Update status to overdue
            $borrow->update(['status' => 'overdue']);

            // Notify user
            $borrow->user->notify(new OverdueNotification($borrow));

            $this->info("Notified User: " . $borrow->user->name . " for book: " . $borrow->book->title);
        }

        $this->info('Checked ' . $overdueBorrows->count() . ' overdue books.');
    }
}
