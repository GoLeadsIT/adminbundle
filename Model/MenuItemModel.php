<?php

namespace Goleadsit\AdminBundle\Model;

class MenuItemModel {

    /** @var string */
    private $label;

    /** @var string */
    private $route;

    /** @var string */
    private $icon;

    /** @var array */
    private $options;

    /** @var array */
    private $childs;

    /**
     * MenuItemModel constructor.
     *
     * @param string $label
     * @param string $route
     * @param string $icon
     * @param array  $options
     * @param array  $childs
     */
    public function __construct(string $label, string $route = '#', string $icon = 'fa-circle-o', array $options = [], array $childs = []) {
        $this->label = $label;
        $this->route = $route;
        $this->icon = $icon;
        $this->options = $options;
        $this->childs = $childs;
    }

    /**
     * @return string
     */
    public function getLabel(): string {
        return $this->label;
    }

    /**
     * @param string $label
     *
     * @return MenuItemModel
     */
    public function setLabel(string $label): MenuItemModel {
        $this->label = $label;

        return $this;
    }

    /**
     * @return string
     */
    public function getRoute(): string {
        return $this->route;
    }

    /**
     * @param string $route
     *
     * @return MenuItemModel
     */
    public function setRoute(?array $route): MenuItemModel {
        $this->route = $route;

        return $this;
    }

    /**
     * @return string
     */
    public function getIcon(): string {
        return $this->icon;
    }

    /**
     * @param string $icon
     *
     * @return MenuItemModel
     */
    public function setIcon(string $icon): MenuItemModel {
        $this->icon = $icon;

        return $this;
    }

    /**
     * @return array
     */
    public function getOptions(): array {
        return $this->options;
    }

    /**
     * @param array $options
     *
     * @return MenuItemModel
     */
    public function setOptions(array $options): MenuItemModel {
        $this->options = $options;

        return $this;
    }

    /**
     * @return bool
     */
    public function isHeader(): bool {
        if(empty($this->options['is_header']) or $this->options['is_header'] === false) {
            return false;
        }

        return true;
    }

    /**
     * @return bool
     */
    public function isActive(): bool {
        if(empty($this->options['is_active']) or $this->options['is_active'] === false) {
            return false;
        }

        return true;
    }

    /**
     * @return \Goleadsit\AdminBundle\Model\MenuItemModel[]
     */
    public function getChilds(): array {
        return $this->childs;
    }

    /**
     * @param \Goleadsit\AdminBundle\Model\MenuItemModel[] $childs
     *
     * @return MenuItemModel
     */
    public function setChilds(array $childs): MenuItemModel {
        $this->childs = $childs;

        return $this;
    }

    /**
     * Add new Child
     *
     * @param \Goleadsit\AdminBundle\Model\MenuItemModel $menuItemModel
     *
     * @return MenuItemModel
     */
    public function addChild(MenuItemModel $menuItemModel): MenuItemModel {
        $this->childs[] = $menuItemModel;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasChilds(): bool {
        return !empty($this->childs);
    }
}
