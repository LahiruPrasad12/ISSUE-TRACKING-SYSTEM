<?php

namespace App\Observers;

use App\Models\Images;
use Illuminate\Support\Facades\Log;

class ImageObserver
{
    /**
     * Handle the Images "created" event.
     *
     * @param  \App\Models\Images  $images
     * @return void
     */
    public function created(Images $images)
    {
        echo 'Images added';
        Log::info('Images added'.$images);
    }

    /**
     * Handle the Images "updated" event.
     *
     * @param  \App\Models\Images  $images
     * @return void
     */
    public function updated(Images $images)
    {
        echo 'Images updated';
    }

    /**
     * Handle the Images "deleted" event.
     *
     * @param  \App\Models\Images  $images
     * @return void
     */
    public function deleted(Images $images)
    {
        echo 'Images deleted';
    }

    /**
     * Handle the Images "restored" event.
     *
     * @param  \App\Models\Images  $images
     * @return void
     */
    public function restored(Images $images)
    {
        echo 'Images restored';
    }

    /**
     * Handle the Images "force deleted" event.
     *
     * @param  \App\Models\Images  $images
     * @return void
     */
    public function forceDeleted(Images $images)
    {
        echo 'Images forceDeleted';
    }
}
