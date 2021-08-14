<?php

namespace App\Observers;

use App\Models\Comments;

class CommentObserver
{
    /**
     * Handle the Comments "created" event.
     *
     * @param  \App\Models\Comments  $comments
     * @return void
     */
    public function created(Comments $comments)
    {
        echo 'Comments created';
    }

    /**
     * Handle the Comments "updated" event.
     *
     * @param  \App\Models\Comments  $comments
     * @return void
     */
    public function updated(Comments $comments)
    {
        echo 'Comments updated';
    }

    /**
     * Handle the Comments "deleted" event.
     *
     * @param  \App\Models\Comments  $comments
     * @return void
     */
    public function deleted(Comments $comments)
    {
        echo 'Comments deleted';
    }

    /**
     * Handle the Comments "restored" event.
     *
     * @param  \App\Models\Comments  $comments
     * @return void
     */
    public function restored(Comments $comments)
    {
        echo 'Comments restored';
    }

    /**
     * Handle the Comments "force deleted" event.
     *
     * @param  \App\Models\Comments  $comments
     * @return void
     */
    public function forceDeleted(Comments $comments)
    {
        echo 'Comments forceDeleted';
    }
}
