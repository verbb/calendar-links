<?php
namespace verbb\calendarlinks\models;

use Spatie\CalendarLinks\Link;

use craft\base\Model;

class CalendarLink extends Model
{
    // Properties
    // =========================================================================

    /**
     * @var Link
     */
    public $link = null;


    // Public Methods
    // =========================================================================

    public function defineRules(): array
    {
        $rules = parent::defineRules();

        $rules[] = ['link', 'default', 'value' => null];

        return $rules;
    }

    public function address($providedAddress = ''): CalendarLink
    {
        ($this->link->address($providedAddress));

        return $this;
    }

    public function description($description = null): CalendarLink
    {
        ($this->link->description($description));

        return $this;
    }

    public function google(): string
    {
        return $this->link->google();
    }

    public function yahoo(): string
    {
        return $this->link->yahoo();
    }

    public function ics(): string
    {
        return $this->link->ics();
    }

    public function setLink(Link $link): CalendarLink
    {
        $this->link = $link;

        return $this;
    }

    public function getLink(): ?Link
    {
        return $this->link;
    }
}
