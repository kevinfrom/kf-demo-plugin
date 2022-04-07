<?php

namespace App\PostType;

class RegularPostType extends PostType
{

    /**
     * @inheritDoc
     */
    public function register(): void
    {
        register_post_type($this->getPostType(), array_merge($this->getDefaultArguments(), [
            'supports' => ['title'],
        ]));
    }
}
