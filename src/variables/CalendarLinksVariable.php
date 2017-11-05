<?php
/**
 * Calendar Links plugin for Craft CMS 3.x
 *
 * Generate add to calendar links for Google, iCal and other calendar systems
 *
 * @link      https://superbig.co
 * @copyright Copyright (c) 2017 Superbig
 */

namespace superbig\calendarlinks\variables;

use superbig\calendarlinks\CalendarLinks;

use Craft;

/**
 * @author    Superbig
 * @package   CalendarLinks
 * @since     1.0.0
 */
class CalendarLinksVariable
{
    // Public Methods
    // =========================================================================

    /**
     * @param array $options
     *
     * @return string
     *
     */
    public function create ($options = [])
    {
        return CalendarLinks::$plugin->calendarLinksService->create($options);
    }
}
