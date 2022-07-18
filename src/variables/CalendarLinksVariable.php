<?php
namespace verbb\calendarlinks\variables;

use verbb\calendarlinks\CalendarLinks;
use verbb\calendarlinks\models\CalendarLink;

class CalendarLinksVariable
{
    // Public Methods
    // =========================================================================

    public function create(array $options = []): CalendarLink
    {
        return CalendarLinks::$plugin->getService()->create($options);
    }
}
