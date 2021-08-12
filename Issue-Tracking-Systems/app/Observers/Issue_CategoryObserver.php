<?php

namespace App\Observers;

use App\Models\Issue_Categories;
use Illuminate\Support\Facades\Log;

class Issue_CategoryObserver
{
    /**
     * Handle the Issue_Categories "created" event.
     *
     * @param  \App\Models\Issue_Categories  $issue_Categories
     * @return void
     */
    public function created(Issue_Categories $issue_Categories)
    {
        echo 'Issue_Categories added';
        Log::info('Issue_Categories added'.$issue_Categories);
    }

    /**
     * Handle the Issue_Categories "updated" event.
     *
     * @param  \App\Models\Issue_Categories  $issue_Categories
     * @return void
     */
    public function updated(Issue_Categories $issue_Categories)
    {
        echo 'Issue_Categories updated';
    }

    /**
     * Handle the Issue_Categories "deleted" event.
     *
     * @param  \App\Models\Issue_Categories  $issue_Categories
     * @return void
     */
    public function deleted(Issue_Categories $issue_Categories)
    {
        echo 'Issue_Categories deleted';
    }

    /**
     * Handle the Issue_Categories "restored" event.
     *
     * @param  \App\Models\Issue_Categories  $issue_Categories
     * @return void
     */
    public function restored(Issue_Categories $issue_Categories)
    {
        echo 'Issue_Categories restored';
    }

    /**
     * Handle the Issue_Categories "force deleted" event.
     *
     * @param  \App\Models\Issue_Categories  $issue_Categories
     * @return void
     */
    public function forceDeleted(Issue_Categories $issue_Categories)
    {
        echo 'Issue_Categories forceDeleted';
    }
}
