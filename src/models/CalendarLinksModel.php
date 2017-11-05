<?php
/**
 * Calendar Links plugin for Craft CMS 3.x
 *
 * Generate add to calendar links for Google, iCal and other calendar systems
 *
 * @link      https://superbig.co
 * @copyright Copyright (c) 2017 Superbig
 */

namespace superbig\calendarlinks\models;

use Spatie\CalendarLinks\Link;

use craft\base\Model;

/**
 * @author    Superbig
 * @package   CalendarLinks
 * @since     1.0.0
 */
class CalendarLinksModel extends Model
{
    // Public Properties
    // =========================================================================

    /**
     * @var Link
     */
    public $link = null;

    // Public Methods
    // =========================================================================


    public function address ($providedAddress = '')
    {
        ($this->link->address($providedAddress));

        return $this;
    }

    /**
     * @param null $description
     *
     * @return $this
     */
    public function description ($description = null)
    {
        ($this->link->description($description));

        return $this;
    }


    /**
     * @return string
     */
    public function google ()
    {
        return $this->link->google();
    }

    /**
     * @return mixed
     */
    public function yahoo ()
    {
        return $this->link->yahoo();
    }

    /**
     * @return mixed
     */
    public function ics ()
    {
        return $this->link->ics();
    }

    /**
     * @param Link $link
     *
     * @return $this
     */
    public function setLink (Link $link)
    {
        $this->link = $link;

        return $this;
    }

    public function getLink ()
    {
        return $this->link;
    }

    /**
     * @inheritdoc
     */
    public function rules ()
    {
        return [
            [ 'link', 'default', 'value' => null ],
        ];
    }
}
