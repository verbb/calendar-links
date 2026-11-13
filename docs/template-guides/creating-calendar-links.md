# Creating Calendar Links

An event page often has “Add to calendar” links, so a visitor can save the event in Google Calendar, Outlook or their computer's calendar app without typing it in. `craft.calendarLinks.create()` builds those links from your event's details. Each link opens the calendar service with the event filled in, ready for the visitor to check and save.

## Adding Calendar Links to an Event Page

This example belongs in the template for an event entry. It assumes the entry type has two Date fields with the handles `startDate` and `endDate` (both showing the time), a Plain Text field called `venue`, and a Plain Text field called `summary`.

```twig
{% if entry.startDate and entry.endDate and entry.endDate >= entry.startDate %}
    {% set calendarLink = craft.calendarLinks.create({
        text: entry.title,
        from: entry.startDate,
        to: entry.endDate,
        description: entry.summary,
        address: entry.venue,
    }) %}

    <h2>Add to Your Calendar</h2>

    <ul>
        <li><a href="{{ calendarLink.google() }}" target="_blank" rel="noopener">Google Calendar</a></li>
        <li><a href="{{ calendarLink.webOutlook() }}" target="_blank" rel="noopener">Outlook.com</a></li>
        <li><a href="{{ calendarLink.webOffice() }}" target="_blank" rel="noopener">Microsoft 365</a></li>
        <li><a href="{{ calendarLink.yahoo() }}" target="_blank" rel="noopener">Yahoo Calendar</a></li>
        <li><a href="{{ calendarLink.ics() }}" download="{{ entry.slug }}.ics">Apple Calendar or Outlook (.ics)</a></li>
    </ul>
{% endif %}
```

For an entry titled “Spring Workshop” on 10 April from 9 am to 12 pm at the Town Hall, each link opens its service with a new event called “Spring Workshop” at that time and place, with the summary as its description. The last link downloads a `spring-workshop.ics` file, which opens in Apple Calendar, Outlook and most other calendar apps.

The check at the top skips the links when either date is empty or the event ends before it starts. Creating a link with an end before its start throws an error, which would stop the page from rendering.

## The Options You Can Pass

`craft.calendarLinks.create(options)` takes one object describing the event.

| Option | Type | What It Does |
| --- | --- | --- |
| `text` | `string` | The event's title. Defaults to `No text`, so always set it. |
| `from` | `DateTime` | When the event starts. Defaults to midnight at the start of today. |
| `to` | `DateTime` | When the event ends. It can't be earlier than `from`. Defaults to midnight at the start of today. |
| `allDay` | `bool` | Whether the event runs for whole days with no time of day. Defaults to `false`. |
| `description` | `string` | Text for the event's description or notes. Leave it out to add none. |
| `address` | `string` | The event's location. Leave it out to add none. |

Pass dates as date values, such as a Date field's value or `date('2027-04-10 09:00')`. A plain string such as `'2027-04-10'` isn't a date value, and passing one causes an error.

Calendar services show the event in the visitor's own timezone. The links are built from the full date and timezone of `from` and `to`, so a 9 am event in Sydney shows as 9 am for a visitor in Sydney and at the matching local time for someone elsewhere.

## Choosing Where Each Link Goes

`create()` returns a link object. Calling one of its methods gives you a URL for a particular calendar service, and you can call as many as you need from the same object.

| Method | What It Returns |
| --- | --- |
| `google()` | A link that opens Google Calendar with the event ready to save. |
| `webOutlook()` | A link that opens Outlook on the web for personal accounts, at outlook.live.com. |
| `webOffice()` | A link that opens Outlook on the web for work and school accounts, at outlook.office.com. |
| `yahoo()` | A link that opens Yahoo Calendar. |
| `ics()` | A `data:` URL holding the event as an `.ics` calendar file, for Apple Calendar, desktop Outlook and other calendar apps. |

Add a `download` attribute to the `.ics` link, as the example does, so the browser saves the file with a sensible name instead of trying to open the data in a tab.

## Linking to All-Day Events

For an event that takes up whole days, such as a conference or a public holiday, set `allDay` to `true` and leave the time out of the dates. `to` is the last day of the event, so a single-day event uses the same date for `from` and `to`.

This example is for an entry type with Date fields called `startDate` and `endDate` that only show the date.

```twig
{% if entry.startDate and entry.endDate and entry.endDate >= entry.startDate %}
    {% set calendarLink = craft.calendarLinks.create({
        text: entry.title,
        from: entry.startDate,
        to: entry.endDate,
        allDay: true,
    }) %}

    <a href="{{ calendarLink.google() }}" target="_blank" rel="noopener">Add {{ entry.title }} to Google Calendar</a>
{% endif %}
```

A conference from 10 to 12 April opens in Google Calendar as an all-day event covering all three days.
