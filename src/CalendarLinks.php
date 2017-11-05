<?php
/**
 * Calendar Links plugin for Craft CMS 3.x
 *
 * Generate add to calendar links for Google, iCal and other calendar systems
 *
 * @link      https://superbig.co
 * @copyright Copyright (c) 2017 Superbig
 */

namespace superbig\calendarlinks;

use superbig\calendarlinks\services\CalendarLinksService as CalendarLinksServiceService;
use superbig\calendarlinks\variables\CalendarLinksVariable;

use Craft;
use craft\base\Plugin;
use craft\web\twig\variables\CraftVariable;

use yii\base\Event;

/**
 * Class CalendarLinks
 *
 * @author    Superbig
 * @package   CalendarLinks
 * @since     1.0.0
 *
 * @property  CalendarLinksServiceService $calendarLinksService
 */
class CalendarLinks extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var CalendarLinks
     */
    public static $plugin;

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init ()
    {
        parent::init();
        self::$plugin = $this;

        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function (Event $event) {
                /** @var CraftVariable $variable */
                $variable = $event->sender;
                $variable->set('calendarLinks', CalendarLinksVariable::class);
            }
        );

        Craft::info(
            Craft::t(
                'calendar-links',
                '{name} plugin loaded',
                [ 'name' => $this->name ]
            ),
            __METHOD__
        );
    }
}
