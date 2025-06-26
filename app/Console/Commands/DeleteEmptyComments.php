<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Comment;

class DeleteEmptyComments extends Command
{
    protected $signature = 'comments:cleanup';
    protected $description = 'Delete comments with empty content';

    public function handle(): void
    {
        $deleted = Comment::whereNull('content')
            ->orWhere('content', '')
            ->delete();

        $this->info("Deleted {$deleted} empty comments.");
    }
}
