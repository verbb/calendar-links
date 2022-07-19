# Calendar Links plugin for Craft CMS
Generate add to calendar links for Google, iCal and other calendar systems.

## Installation
You can install Calendar Links via the plugin store, or through Composer.

### Craft Plugin Store
To install **Calendar Links**, navigate to the _Plugin Store_ section of your Craft control panel, search for `Calendar Links`, and click the _Try_ button.

### Composer
You can also add the package to your project using Composer.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:
    
        composer require verbb/calendar-links

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for Calendar Links.

## Usage

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

{# Generate a data uri for an ics file (for iCal & Outlook) #}
<a href="{{ link.ics() }}">iCal & Outlook</a>
```

## IE/Edge compatbility
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

## Credits
Originally created by the team at [Superbig](https://superbig.co/).

## Show your Support
Calendar Links is licensed under the MIT license, meaning it will always be free and open source – we love free stuff! If you'd like to show your support to the plugin regardless, [Sponsor](https://github.com/sponsors/verbb) development.

<h2></h2>

<a href="https://verbb.io" target="_blank">
    <img width="100" src="https://verbb.io/assets/img/verbb-pill.svg">
</a>
