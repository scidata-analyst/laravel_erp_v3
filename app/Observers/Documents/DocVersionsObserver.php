<?php

namespace App\Observers\Documents;

use App\Models\Documents\DocVersions;

class DocVersionsObserver
{
    /**
     * Handle the DocVersions "created" event.
     */
    public function created(DocVersions $docVersions): void
    {
        //
    }

    /**
     * Handle the DocVersions "updated" event.
     */
    public function updated(DocVersions $docVersions): void
    {
        //
    }

    /**
     * Handle the DocVersions "deleted" event.
     */
    public function deleted(DocVersions $docVersions): void
    {
        //
    }

    /**
     * Handle the DocVersions "restored" event.
     */
    public function restored(DocVersions $docVersions): void
    {
        //
    }

    /**
     * Handle the DocVersions "force deleted" event.
     */
    public function forceDeleted(DocVersions $docVersions): void
    {
        //
    }
}
