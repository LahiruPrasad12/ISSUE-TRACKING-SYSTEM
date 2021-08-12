<?php

namespace App\Observers;

use App\Models\Subcategories;
use Illuminate\Support\Facades\Log;

class SubcategoriesObserver
{
    /**
     * Handle the Subcategories "created" event.
     *
     * @param  \App\Models\Subcategories  $subcategories
     * @return void
     */
    public function created(Subcategories $subcategories)
    {
        echo 'Subcategories added';
        Log::info('Subcategories added'.$subcategories);
    }

    /**
     * Handle the Subcategories "updated" event.
     *
     * @param  \App\Models\Subcategories  $subcategories
     * @return void
     */
    public function updated(Subcategories $subcategories)
    {
        echo 'Subcategories updated';
    }

    /**
     * Handle the Subcategories "deleted" event.
     *
     * @param  \App\Models\Subcategories  $subcategories
     * @return void
     */
    public function deleted(Subcategories $subcategories)
    {
        echo 'Subcategories deleted';
    }

    /**
     * Handle the Subcategories "restored" event.
     *
     * @param  \App\Models\Subcategories  $subcategories
     * @return void
     */
    public function restored(Subcategories $subcategories)
    {
        echo 'Subcategories restored';
    }

    /**
     * Handle the Subcategories "force deleted" event.
     *
     * @param  \App\Models\Subcategories  $subcategories
     * @return void
     */
    public function forceDeleted(Subcategories $subcategories)
    {
        echo 'Subcategories forceDeleted';
    }
}
