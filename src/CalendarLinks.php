<?php
namespace verbb\calendarlinks;

use verbb\calendarlinks\base\PluginTrait;
use verbb\calendarlinks\variables\CalendarLinksVariable;

use craft\base\Plugin;
use craft\web\twig\variables\CraftVariable;

use yii\base\Event;

class CalendarLinks extends Plugin
{
    // Properties
    // =========================================================================

    public string $schemaVersion = '1.0.0';


    // Traits
    // =========================================================================

    use PluginTrait;


    // Public Methods
    // =========================================================================

    public function init(): void
    {
        parent::init();

        self::$plugin = $this;

        $this->_registerVariables();
    }


    // Private Methods
    // =========================================================================

    private function _registerVariables(): void
    {
        Event::on(CraftVariable::class, CraftVariable::EVENT_INIT, function(Event $event) {
            $event->sender->set('calendarLinks', CalendarLinksVariable::class);
        });
    }
}
