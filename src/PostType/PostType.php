<?php

namespace App\PostType;

use RuntimeException;

abstract class PostType
{

    protected string $post_type;
    protected string $label;
    protected string $icon;
    protected int $menu_position;

    /**
     * PostType constructor
     *
     * @param string $post_type
     * @param string $label
     * @param string $icon
     * @param int $menu_position
     * @throws RuntimeException
     */
    public function __construct(
        string $post_type,
        string $label,
        string $icon = POST_TYPE_ICON_DEFAULT,
        int $menu_position = POST_TYPE_MENU_POSITION_BELOW_PAGES
    ) {
        if (strlen($post_type) > POST_TYPE_TYPE_MAX_LENGTH) {
            throw new RuntimeException('Post type ' . $post_type . ' exceeds maximum length of ' . POST_TYPE_TYPE_MAX_LENGTH);
        }

        $this->post_type = $post_type;
        $this->label = $label;
        $this->icon = $icon;
        $this->menu_position = $menu_position;
    }

    /**
     * Get post type
     *
     * @return string
     */
    final public function getPostType(): string
    {
        return $this->post_type;
    }

    /**
     * Get label
     *
     * @return string
     */
    final public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * Get icon
     *
     * @return string
     */
    final public function getIcon(): string
    {
        return $this->icon;
    }

    /**
     * Get menu position
     *
     * @return int
     */
    final public function getMenuPosition(): int
    {
        return $this->menu_position;
    }

    /**
     * Set menu position
     *
     * @param int $menu_position
     * @return $this
     */
    final public function setMenuPosition(int $menu_position): self
    {
        $this->menu_position = $menu_position;
        return $this;
    }

    /**
     * Register post type
     *
     * @return void
     */
    abstract public function register(): void;

    /**
     * Get default arguments
     *
     * @return array
     */
    final public function getDefaultArguments(): array
    {
        return [
            'label'         => $this->getLabel(),
            'public'        => true,
            'menu_icon'     => $this->getIcon(),
            'menu_position' => $this->getMenuPosition(),
        ];
    }
}
