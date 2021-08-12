<?php

namespace App\Observers;

use App\Models\Issues;
use Illuminate\Support\Facades\Log;

class IssuesObserver
{
    /**
     * Handle the Issues "created" event.
     *
     * @param  \App\Models\Issues  $issues
     * @return void
     */
    public function created(Issues $issues)
    {
        echo 'Issues added';
        Log::info('Issues added'.$issues);
    }

    /**
     * Handle the Issues "updated" event.
     *
     * @param  \App\Models\Issues  $issues
     * @return void
     */
    public function updated(Issues $issues)
    {
        echo 'Issues updated';
    }

    /**
     * Handle the Issues "deleted" event.
     *
     * @param  \App\Models\Issues  $issues
     * @return void
     */
    public function deleted(Issues $issues)
    {
        echo 'Issues deleted';
    }

    /**
     * Handle the Issues "restored" event.
     *
     * @param  \App\Models\Issues  $issues
     * @return void
     */
    public function restored(Issues $issues)
    {
        echo 'Issues restored';
    }

    /**
     * Handle the Issues "force deleted" event.
     *
     * @param  \App\Models\Issues  $issues
     * @return void
     */
    public function forceDeleted(Issues $issues)
    {
        echo 'Issues forceDeleted';
    }
}
