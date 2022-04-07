<?php

namespace App\Hooks\Action\PostType;

use App\Hooks\Action\Action;
use Headless\Utility\PostType\ReadOnlyPostType;
use Headless\Utility\PostType\RegularPostType;

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
                'case',
                'Case'
            ),
            new RegularPostType(
                'material',
                'Material'
            ),
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
