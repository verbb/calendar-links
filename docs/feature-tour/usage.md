# Usage

```twig
{% set link = craft.calendarLinks.create({
    text: 'Release party',
    from: now | date_modify('+1 hour'),
    to: now | date_modify('+3 hours'),
}) %}

{# You can add a description #}
{% do link.description('There will be cakes etc.') %}

{# And a address #}
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

## IE/Edge compatibility
IE/Edge do not support data:text/calendar URIs (see https://caniuse.com/#feat=datauri).

Use something like this as a workaround, adapted from https://docs.microsoft.com/en-us/previous-versions/windows/internet-explorer/ie-developer/samples/hh779016(v=vs.85)

In your twig file:

```twig
{% set addToCalendarLink = craft.calendarLinks.create(INSERT YOUR OPTIONS HERE) %} 

<a href="{{ addToCalendarLink.ics() }}" class="download-event">Download event</a>

{% js at endBody %}

(function () {
    this.EventHandler = function (linkData, fileData) {
        this.linkData = linkData;
        var links = document.querySelectorAll('.download-event'), i;
        for (i = 0; i < links.length; ++i) {
            links[i].addEventListener("click", getIcs.bind(this, event));
        }
    }

    function isIE() {
        return (window.Blob && window.navigator.msSaveOrOpenBlob);
    }

    function getIcs() {
        if (isIE()) {
            var fileData = [this.linkData.split("%0A").join("\n").replace('data:text/calendar;charset=utf8,\n', '')];
            window.navigator.msSaveOrOpenBlob(new Blob(fileData), 'event.ics');
        } else {
            window.location.href = this.linkData;
        }
        event.preventDefault();
    }
}());

new EventHandler("{{ addToCalendarLink.ics() }}");

{% endjs %}
```