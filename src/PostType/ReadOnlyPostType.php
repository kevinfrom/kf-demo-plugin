<?php

namespace App\PostType;

class ReadOnlyPostType extends PostType
{

    /**
     * @var string[]
     */
    private array $enabled_capability_keys = [
        'edit_posts',
    ];

    /**
     * Get capabilities
     *
     * @return string[]
     */
    private function getCapabilities(): array
    {
        return [
            'edit_posts'             => "edit_{$this->getPostType()}s",
            'read'                   => 'read',
            'read_post'              => "read_{$this->getPostType()}",
            'read_private_posts'     => "read_private_{$this->getPostType()}s",
            'edit_private_posts'     => "edit_private_{$this->getPostType()}s",
            'edit_others_posts'      => "edit_others_{$this->getPostType()}s",
            'edit_published_posts'   => "edit_published_{$this->getPostType()}s",
            'edit_post'              => "edit_{$this->getPostType()}",
            'create_posts'           => "create_{$this->getPostType()}s",
            'publish_posts'          => "publish_{$this->getPostType()}s",
            'delete_post'            => "delete_{$this->getPostType()}",
            'delete_posts'           => "delete_{$this->getPostType()}s",
            'delete_private_posts'   => "delete_private_{$this->getPostType()}s",
            'delete_published_posts' => "delete_published_{$this->getPostType()}s",
            'delete_others_posts'    => "delete_others_{$this->getPostType()}s",
        ];
    }

    /**
     * Get enabled capabilities
     *
     * @return array
     */
    private function getEnabledCapabilities(): array
    {
        $result = [];

        foreach ($this->getCapabilities() as $key => $capability) {
            if (in_array($key, $this->enabled_capability_keys, true)) {
                $result[] = $capability;
            }
        }

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function register(): void
    {
        register_post_type($this->getPostType(), array_merge($this->getDefaultArguments(), [
            'supports'        => [''],
            'capability_type' => $this->getPostType(),
            'map_meta_cap'    => true,
            'capabilities'    => $this->getCapabilities(),
        ]));

        $user = wp_get_current_user();

        if ($user === null) {
            return;
        }

        $role = get_role('administrator');

        if ($role === null) {
            return;
        }

        foreach ($this->getEnabledCapabilities() as $capability) {
            $role->add_cap($capability);
        }
    }
}
