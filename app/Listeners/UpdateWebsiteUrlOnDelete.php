<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\WebsiteDeleting;

class UpdateWebsiteUrlOnDelete
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(WebsiteDeleting $event): void
    {
        // Access the record being deleted
        $recordBeingDeleted = $event->record;

        // Update the website_url to include "delete-" at the beginning
        $recordBeingDeleted->update([
            'website_url' => 'delete-' . $recordBeingDeleted->website_url,
        ]);
    }
}
