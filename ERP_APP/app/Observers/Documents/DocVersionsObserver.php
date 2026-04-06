<?php

namespace App\Observers\Documents;

use App\Models\Documents\DocVersions;

class DocVersionsObserver
{
    /**
     * Handle the DocVersions "created" event.
     */
    public function created(DocVersions $modelVar): void
    {
        // ...
    }

    /**
     * Handle the DocVersions "updated" event.
     */
    public function updated(DocVersions $modelVar): void
    {
        // ...
    }

    /**
     * Handle the DocVersions "deleted" event.
     */
    public function deleted(DocVersions $modelVar): void
    {
        // ...
    }

    /**
     * Handle the DocVersions "restored" event.
     */
    public function restored(DocVersions $modelVar): void
    {
        // ...
    }

    /**
     * Handle the DocVersions "forceDeleted" event.
     */
    public function forceDeleted(DocVersions $modelVar): void
    {
        // ...
    }
}
