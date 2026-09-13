# Usage

Calendar Links creates a link that opens a calendar service with an event ready to save. It does not publish the event to a visitor’s calendar automatically: the visitor reviews and saves it in their calendar application.

Place this example in the Twig template where you want the calendar links. It creates a release party starting one hour from now and ending three hours from now. For a real event, replace `from` and `to` with its start and end date values, using the intended event timezone.

```twig
{% set link = craft.calendarLinks.create({
    text: 'Release party',
    from: now | date_modify('+1 hour'),
    to: now | date_modify('+3 hours'),
}) %}

{# You can add a description #}
{% do link.description('Join us to celebrate the release.') %}

{# Add an address #}
{% do link.address('Bend, Oregon') %}

{# Generate a link to create an event on Google calendar #}
<a href="{{ link.google() }}">Google</a>

{# Generate a link to create an event on Yahoo calendar #}
<a href="{{ link.yahoo() }}">Yahoo</a>

{# Generate a link to create an event on outlook.live.com calendar #}
<a href="{{ link.webOutlook() }}">Web Outlook</a>

{# Generate a link to create an event on outlook.office.com calendar #}
<a href="{{ link.webOffice() }}">Web Office</a>

{# Generate a data uri for an ics file (for iCal & Outlook) #}
<a href="{{ link.ics() }}">iCal & Outlook</a>
```

Open one of the links and check the title, location, start and end times before saving. Calendar applications may display those times in the visitor's timezone, so check the expected conversion when your event and audience are in different locations.

`craft.calendarLinks.create()` returns a link object. Methods such as `google()` and `webOutlook()` turn it into a URL for that service; `ics()` produces calendar file data for a compatible application. Keep the link object until you have generated the destinations you need.

## All-Day Events

For an event without a time of day, pass `allDay: true` alongside the dates:

```twig
{% set link = craft.calendarLinks.create({
    text: 'Studio Open Day',
    from: date('2027-04-10'),
    to: date('2027-04-10'),
    allDay: true,
}) %}

<a href="{{ link.google() }}">Add the Open Day to Google Calendar</a>
```

Check the calendar's date range before saving, particularly for an event spanning several days. Use real date values from your event content in place of the fixed sample dates.
