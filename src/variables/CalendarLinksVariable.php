<?php
namespace verbb\calendarlinks\variables;

use verbb\calendarlinks\CalendarLinks;

use Spatie\CalendarLinks\Link;

class CalendarLinksVariable
{
    // Public Methods
    // =========================================================================

    public function create(array $options = []): Link
    {
        return CalendarLinks::$plugin->getService()->create($options);
    }
}
