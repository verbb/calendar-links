<?php
namespace verbb\calendarlinks\services;

use craft\base\Component;

use Spatie\CalendarLinks\Link;

use DateTime;

class Service extends Component
{
    // Public Methods
    // =========================================================================

    public function create(array $options = []): Link
    {
        $default = [
            'text' => 'No text',
            'from' => (new DateTime())->modify('00:00'),
            'to' => (new DateTime())->modify('midnight'),
            'allDay' => false,
        ];

        $options = array_merge($default, $options);
        $link = Link::create($options['text'], $options['from'], $options['to'], $options['allDay']);

        if (!empty($options['description'])) {
            $link->description($options['description']);
        }

        if (!empty($options['address'])) {
            $link->address($options['address']);
        }

        return $link;
    }
}
