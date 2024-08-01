<?php 

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;

class WebsiteDeleting
{
    use Dispatchable;

    public $record;

    public function __construct($record)
    {
        $this->record = $record;
    }
}

?>