<?php

namespace App\Observers\Documents;

use App\Models\Documents\DocLibrary;

class DocLibraryObserver
{
    /**
     * Handle the DocLibrary "created" event.
     */
    public function created(DocLibrary $modelVar): void
    {
        // ...
    }

    /**
     * Handle the DocLibrary "updated" event.
     */
    public function updated(DocLibrary $modelVar): void
    {
        // ...
    }

    /**
     * Handle the DocLibrary "deleted" event.
     */
    public function deleted(DocLibrary $modelVar): void
    {
        // ...
    }

    /**
     * Handle the DocLibrary "restored" event.
     */
    public function restored(DocLibrary $modelVar): void
    {
        // ...
    }

    /**
     * Handle the DocLibrary "forceDeleted" event.
     */
    public function forceDeleted(DocLibrary $modelVar): void
    {
        // ...
    }
}
