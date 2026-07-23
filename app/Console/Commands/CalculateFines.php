<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Borrow;
use App\Models\LibrarySetting;
use Carbon\Carbon;

class CalculateFines extends Command
{
    protected $signature = 'fines:calculate';
    protected $description = 'Calculate fines for overdue books';

    public function handle()
    {
        $this->info('Starting fine calculation...');
        $now = Carbon::now();
        $finePerDay = (float) LibrarySetting::where('key', 'fine_per_day')->value('value') ?? 1.00;

        $overdueBorrows = Borrow::whereIn('status', ['borrowed', 'overdue'])
                                ->where('due_date', '<', $now->toDateString())
                                ->get();

        foreach ($overdueBorrows as $borrow) {
            $daysOverdue = $now->startOfDay()->diffInDays(Carbon::parse($borrow->due_date)->startOfDay());
            if ($daysOverdue > 0) {
                $fineAmount = $daysOverdue * $finePerDay;
                $borrow->update([
                    'status' => 'overdue',
                    'fine_amount' => $fineAmount,
                    'fine_status' => 'unpaid'
                ]);
            }
        }

        $this->info('Fines calculated for ' . $overdueBorrows->count() . ' borrows.');
    }
}
