<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Comments;
use App\Models\Images;
use App\Models\Issue_Categories;
use App\Models\Issue_Subcategories;
use App\Models\Issues;
use App\Observers\CategoryObserver;
use App\Observers\CommentObserver;
use App\Observers\ImageObserver;
use App\Observers\Issue_CategoryObserver;
use App\Observers\IssuesObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Category::observe(CategoryObserver::class);
        Comments::observe(CommentObserver::class);
        Images::observe(ImageObserver::class);
        Issue_Categories::observe(Issue_CategoryObserver::class);
        Issue_Subcategories::observe(Issue_CategoryObserver::class);
        Issues::observe(IssuesObserver::class);
    }
}
