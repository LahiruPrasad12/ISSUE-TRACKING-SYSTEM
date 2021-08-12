<?php

namespace App\Observers;

use App\Models\Issue_Subcategories;
use Illuminate\Support\Facades\Log;

class Issue_SubCategoryObserver
{
    /**
     * Handle the Issue_Subcategories "created" event.
     *
     * @param  \App\Models\Issue_Subcategories  $issue_Subcategories
     * @return void
     */
    public function created(Issue_Subcategories $issue_Subcategories)
    {
        echo 'Issue_Subcategories added';
        Log::info('Issue_Subcategories added'.$issue_Subcategories);
    }

    /**
     * Handle the Issue_Subcategories "updated" event.
     *
     * @param  \App\Models\Issue_Subcategories  $issue_Subcategories
     * @return void
     */
    public function updated(Issue_Subcategories $issue_Subcategories)
    {
        echo 'Issue_Subcategories updated';
    }

    /**
     * Handle the Issue_Subcategories "deleted" event.
     *
     * @param  \App\Models\Issue_Subcategories  $issue_Subcategories
     * @return void
     */
    public function deleted(Issue_Subcategories $issue_Subcategories)
    {
        echo 'Issue_Subcategories deleted';
    }

    /**
     * Handle the Issue_Subcategories "restored" event.
     *
     * @param  \App\Models\Issue_Subcategories  $issue_Subcategories
     * @return void
     */
    public function restored(Issue_Subcategories $issue_Subcategories)
    {
        echo 'Issue_Subcategories restored';
    }

    /**
     * Handle the Issue_Subcategories "force deleted" event.
     *
     * @param  \App\Models\Issue_Subcategories  $issue_Subcategories
     * @return void
     */
    public function forceDeleted(Issue_Subcategories $issue_Subcategories)
    {
        echo 'Issue_Subcategories forceDeleted';
    }
}
