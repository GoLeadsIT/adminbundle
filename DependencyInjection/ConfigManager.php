<?php

namespace Goleadsit\AdminBundle\DependencyInjection;

use Goleadsit\AdminBundle\Model\UserModel;
use Goleadsit\AdminBundle\Service\MenuItemHelper;
use Goleadsit\AdminBundle\Service\MessagesProviderInterface;
use Goleadsit\AdminBundle\Service\NotificationsProviderInterface;
use Goleadsit\AdminBundle\Service\TasksProviderInterface;
use Goleadsit\AdminBundle\Service\UserProviderInterface;

class ConfigManager {

    /**
     * @var MenuItemHelper
     */
    private $menuItemHelper;

    /** @var array */
    private $config;

    /** @var array */
    private $navbar;

    /** @var array */
    private $sidebar;

    /** @var array */
    private $providers;

    /** @var array */
    private $menu;

    public function __construct(MenuItemHelper $menuItemHelper,
                                MessagesProviderInterface $messagesProvider,
                                NotificationsProviderInterface $notificationsProvider,
                                TasksProviderInterface $tasksProvider,
                                UserProviderInterface $userProvider,
                                array $config,
                                array $navbar,
                                array $sidebar,
                                array $menu) {
        $this->menuItemHelper = $menuItemHelper;

        $this->providers['messages'] = $messagesProvider;
        $this->providers['notifications'] = $notificationsProvider;
        $this->providers['tasks'] = $tasksProvider;
        $this->providers['user'] = $userProvider;

        $this->config = $config;
        $this->navbar = $navbar;
        $this->sidebar = $sidebar;
        $this->menu = $this->menuItemHelper->parseMenu($menu);
    }

    /**
     * @return string
     */
    public function getSkin(): string {
        return $this->config['skin'];
    }

    /**
     * @return string
     */
    public function getTitle(): string {
        return $this->config['title'];
    }

    /**
     * @return string
     */
    public function getUserProfilePath() {
        return $this->config['user_profile_path'];
    }

    /**
     * @return string
     */
    public function getUserLogoutPath() {
        return $this->config['user_logout_path'];
    }

    /**
     * @return array
     */
    public function getNavbar(): array {
        return $this->navbar;
    }

    /**
     * @return array
     */
    public function getSidebar(): array {
        return $this->sidebar;
    }

    /**
     * @return \Goleadsit\AdminBundle\Model\MessageModel[] | null
     */
    public function getMessages(): ?array {
        return $this->providers['messages']->getMessages();
    }

    /**
     * @return \Goleadsit\AdminBundle\Model\NotificationModel[] | null
     */
    public function getNotifications(): ?array {
        return $this->providers['notifications']->getNotifications();
    }

    /**
     * @return \Goleadsit\AdminBundle\Model\TaskModel[] | null
     */
    public function getTasks(): ?array {
        return $this->providers['tasks']->getTasks();
    }

    /**
     * @return \Goleadsit\AdminBundle\Model\UserModel
     */
    public function getUser(): UserModel {
        return $this->providers['user']->getUser();
    }

    /**
     * @return \Goleadsit\AdminBundle\Model\MenuItemModel[]
     */
    public function getMenu(): array {
        return $this->menu;
    }

}
