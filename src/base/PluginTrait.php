<?php
namespace verbb\calendarlinks\base;

use verbb\calendarlinks\services\Service;

use Craft;

use yii\log\Logger;

use verbb\base\BaseHelper;

trait PluginTrait
{
    // Static Properties
    // =========================================================================

    public static $plugin;


    // Public Methods
    // =========================================================================

    public static function log($message, $attributes = []): void
    {
        if ($attributes) {
            $message = Craft::t('calendar-links', $message, $attributes);
        }

        Craft::getLogger()->log($message, Logger::LEVEL_INFO, 'calendar-links');
    }

    public static function error($message, $attributes = []): void
    {
        if ($attributes) {
            $message = Craft::t('calendar-links', $message, $attributes);
        }

        Craft::getLogger()->log($message, Logger::LEVEL_ERROR, 'calendar-links');
    }


    // Public Methods
    // =========================================================================

    public function getService(): Service
    {
        return $this->get('service');
    }


    // Private Methods
    // =========================================================================

    private function _setPluginComponents(): void
    {
        $this->setComponents([
            'service' => Service::class,
        ]);

        BaseHelper::registerModule();
    }

    private function _setLogging(): void
    {
        BaseHelper::setFileLogging('calendar-links');
    }

}