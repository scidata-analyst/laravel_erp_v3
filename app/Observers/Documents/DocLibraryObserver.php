<?php

namespace App\Observers\Documents;

use App\Models\Documents\DocLibrary;

class DocLibraryObserver
{
    /**
     * Handle the DocLibrary "created" event.
     */
    public function created(DocLibrary $docLibrary): void
    {
        //
    }

    /**
     * Handle the DocLibrary "updated" event.
     */
    public function updated(DocLibrary $docLibrary): void
    {
        //
    }

    /**
     * Handle the DocLibrary "deleted" event.
     */
    public function deleted(DocLibrary $docLibrary): void
    {
        //
    }

    /**
     * Handle the DocLibrary "restored" event.
     */
    public function restored(DocLibrary $docLibrary): void
    {
        //
    }

    /**
     * Handle the DocLibrary "force deleted" event.
     */
    public function forceDeleted(DocLibrary $docLibrary): void
    {
        //
    }
}
