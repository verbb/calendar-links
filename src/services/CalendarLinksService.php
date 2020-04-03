<?php
/**
 * Calendar Links plugin for Craft CMS 3.x
 *
 * Generate add to calendar links for Google, iCal and other calendar systems
 *
 * @link      https://superbig.co
 * @copyright Copyright (c) 2017 Superbig
 */

namespace superbig\calendarlinks\services;

use Spatie\CalendarLinks\Link;

use Craft;
use craft\base\Component;

use superbig\calendarlinks\models\CalendarLinksModel;

/**
 * @author    Superbig
 * @package   CalendarLinks
 * @since     1.0.0
 */
class CalendarLinksService extends Component
{
    // Public Methods
    // =========================================================================

    /*
     * @return mixed
     */
    /**
     * @param array $options
     *
     * @return mixed
     */
    public function create ($options = [])
    {
        $default = [
            'text' => 'No text',
            'from' => (new \DateTime())->modify('00:00'),
            'to'   => (new \DateTime())->modify('midnight'),
            'allDay' => false,
        ];

        $options = array_merge($default, $options);
        $link    = Link::create($options['text'], $options['from'], $options['to'], $options['allDay']);

        if ( !empty($options['description']) ) {
            $link->description($options['description']);
        }

        if ( !empty($options['address']) ) {
            $link->address($options['address']);
        }

        $model = new CalendarLinksModel([ 'link' => $link ]);

        return $model;
    }
}
