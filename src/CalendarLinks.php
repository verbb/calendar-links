<?php
namespace verbb\calendarlinks;

use verbb\calendarlinks\base\PluginTrait;
use verbb\calendarlinks\variables\CalendarLinksVariable;

use Craft;
use craft\base\Plugin;
use craft\web\twig\variables\CraftVariable;

use yii\base\Event;

class CalendarLinks extends Plugin
{
    // Properties
    // =========================================================================

    public $schemaVersion = '1.0.0';


    // Traits
    // =========================================================================

    use PluginTrait;


    // Public Methods
    // =========================================================================

    public function init(): void
    {
        parent::init();

        self::$plugin = $this;

        $this->_setPluginComponents();
        $this->_setLogging();
        $this->_registerVariables();
    }


    // Private Methods
    // =========================================================================

    private function _registerVariables()
    {
        Event::on(CraftVariable::class, CraftVariable::EVENT_INIT, function(Event $event) {
            $event->sender->set('calendarLinks', CalendarLinksVariable::class);
        });
    }
}
