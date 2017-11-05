# Calendar Links plugin for Craft CMS 3.x

Generate add to calendar links for Google, iCal and other calendar systems

![Screenshot](resources/img/icon.png)

## Requirements

This plugin requires Craft CMS 3.0.0-beta.23 or later.

## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require superbig/craft3-calendarlinks

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for Calendar Links.

## Using Calendar Links

```twig
{% set link = craft.calendarLinks.create({
    text: 'Release party',
    from: now|date_modify('+1 hour'),
    to: now|date_modify('+3 hours'),
}) %}

{# You can add a description #}
{% do link.description('There will be cakes etc.') %}

{# And a address #}
{% do link.description('There will be cakes etc.') %}

<a href="{{ link.ics() }}">Ical</a>
<a href="{{ link.google() }}">Google</a>
<a href="{{ link.yahoo() }}">Yahoo</a>
```

## Credits

[Add calendar icon by Ben Davis](https://thenounproject.com/term/add-calendar/770071)

Brought to you by [Superbig](https://superbig.co)
