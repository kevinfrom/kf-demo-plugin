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
        $this->name = __CLASS__;
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
