# KF WordPress Demo plugin

Made for testing things in WordPress.

## Autoload classes

All classes in `src/` will be auto-loaded using composer as long as their namespace and naming follows PSR-4 naming.

## Hooks

All Hooks reside in the `\App\Hooks` namespace in the `src/Hooks` directory.

To register a hook, follow the following guide for the different types of hooks.

The `$hook` property must match the expected hook.

Use the `$accepted_args` property to allow for more than any number of arguments.

Use the `$priority` property to control the priority/order of running the filter alongside other filters.

### Filters

Filters are meant for mutating data a given point. Filters are expected to return data.

Register a hook by creating a new class in the `\App\Hooks\Filter` namespace and extend the abstract class `Filter` from
the same namespace.

Example:

```php
<?php

namespace App\Hooks\Filter\Frontend;

use App\Hooks\Filter\Filter;

class SetPageTitle extends Filter {

    public function __construct() {
        $this->hook = 'wp_title';
    }
    
    public function receiver(string $title): string
    {
        return "$title | Lorem ipsum dolor sit amet";
    }
}
```

### Actions

Actions for meant for reacting to some action and not returning any data.

E.g. send an e-mail when a new post is created or a user signs up.

Example:

```php
<?php

namespace App\Hooks\Action\PostType;

use App\Hooks\Action\Action;
use App\PostType\ReadOnlyPostType;
use App\PostType\RegularPostType;

class RegisterCustomPostTypes extends Action
{

    public function __construct()
    {
        $this->hook = 'init';
    }

    public function receiver(): void
    {
        array_map(static fn($postType) => $postType->register(), [
            new RegularPostType(
                'segment',
                'Segment',
            ),
            new ReadOnlyPostType(
                'activecampaignform',
                'ActiveCampaign Form',
                POST_TYPE_ICON_FEEDBACK,
            ),
        ]);
    }
}
```
