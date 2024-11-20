<?php

namespace Goleadsit\AdminBundle\Twig\Extension;

use Goleadsit\AdminBundle\DependencyInjection\ConfigManager;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class TwigExtension extends AbstractExtension {

    /** @var \Twig\Environment */
    private $environment;

    /** @var \Goleadsit\AdminBundle\DependencyInjection\ConfigManager */
    private $configManager;

    /** @var \Symfony\Component\Routing\Generator\UrlGeneratorInterface */
    private $urlGenerator;

    public function __construct(ConfigManager $configManager, Environment $environment, UrlGeneratorInterface $urlGenerator) {
        $this->environment = $environment;
        $this->configManager = $configManager;
        $this->urlGenerator = $urlGenerator;
    }

    public function getFunctions() {
        return [
            new TwigFunction('getBaseTitle', [$this, 'getBaseTitle']),
            new TwigFunction('getBaseSkin', [$this, 'getBaseSkin']),
            new TwigFunction('getNavbarClass', [$this, 'getNavbarClass']),
            new TwigFunction('getNavbarLogosTemplate', [$this, 'getNavbarLogosTemplate']),
            new TwigFunction('getSidebarClass', [$this, 'getSidebarClass']),
            new TwigFunction('getMessagesTemplate', [$this, 'getMessagesTemplate']),
            new TwigFunction('getNotificationsTemplate', [$this, 'getNotificationsTemplate']),
            new TwigFunction('getTasksTemplate', [$this, 'getTasksTemplate']),
            new TwigFunction('getNavbarUserTemplate', [$this, 'getNavbarUserTemplate']),
            new TwigFunction('getSidebarUserTemplate', [$this, 'getSidebarUserTemplate']),
            new TwigFunction('getSidebarMenuTemplate', [$this, 'getSidebarMenuTemplate']),
            new TwigFunction('goleadsitParsePath', [$this, 'goleadsitParsePath']),
        ];
    }

    /**
     * Contenido de la etiqueta <title></title>
     *
     * @return string
     */
    public function getBaseTitle() {
        return $this->configManager->getTitle();
    }

    /**
     * Template css
     *
     * @return string
     */
    public function getBaseSkin() {
        return $this->configManager->getSkin();
    }

    /**
     * Renderiza un template con los logos
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function getNavbarLogosTemplate() {
        return $this->environment->render('@GoleadsitAdmin/blocks/navbar_logos.html.twig', [
            'logoPath' => $this->configManager->getNavbar()['logo_path'],
            'logoMini' => $this->configManager->getNavbar()['logo_mini'],
            'logoLg'   => $this->configManager->getNavbar()['logo_lg'],
        ]);
    }

    /**
     * Determina si la barra de navegación está o no fija
     *
     * @return string
     */
    public function getNavbarClass() {
        return ($this->configManager->getNavbar()['is_fixed']) ? 'fixed' : '';
    }

    /**
     * Determina si la barra lateral está o no expandida
     *
     * @return string
     */
    public function getSidebarClass() {
        return ($this->configManager->getSidebar()['is_collapsed']) ? 'sidebar-collapse' : '';
    }

    /**
     * Renderiza @GoleadsitAdmin/blocks/navbar_messages.html.twig con los mensajes
     *
     * @return string|null
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function getMessagesTemplate() {
        if($this->configManager->getNavbar()['messages']) {
            $messages = $this->configManager->getMessages();

            if(!empty($messages)) {
                return $this->environment->render('@GoleadsitAdmin/blocks/navbar_messages.html.twig', [
                    'messages' => $messages
                ]);
            }
        }

        return NULL;
    }

    /**
     * Renderiza @GoleadsitAdmin/blocks/navbar_notifications.html.twig con las notificaciones
     *
     * @return string|null
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function getNotificationsTemplate() {
        if($this->configManager->getNavbar()['notifications']) {
            $notifications = $this->configManager->getNotifications();

            if(!empty($notifications)) {
                return $this->environment->render('@GoleadsitAdmin/blocks/navbar_notifications.html.twig', [
                    'notifications' => $notifications
                ]);
            }
        }

        return NULL;
    }

    /**
     * Renderiza @GoleadsitAdmin/blocks/navbar_tasks.html.twig con los tasks
     *
     * @return string|null
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function getTasksTemplate() {
        if($this->configManager->getNavbar()['tasks']) {
            $tasks = $this->configManager->getTasks();

            if(!empty($tasks)) {
                return $this->environment->render('@GoleadsitAdmin/blocks/navbar_tasks.html.twig', [
                    'tasks' => $tasks
                ]);
            }
        }

        return NULL;
    }

    public function getNavbarUserTemplate() {
        return $this->environment->render('@GoleadsitAdmin/blocks/navbar_user.html.twig', [
            'user'            => $this->configManager->getUser(),
            'userProfilePath' => $this->configManager->getUserProfilePath(),
            'userLogoutPath'  => $this->configManager->getUserLogoutPath()
        ]);
    }

    public function getSidebarUserTemplate() {
        if($this->configManager->getSidebar()['has_user']) {
            return $this->environment->render('@GoleadsitAdmin/blocks/sidebar_user.html.twig', [
                'user' => $this->configManager->getUser()
            ]);
        }

        return NULL;
    }

    public function getSidebarMenuTemplate() {
        return $this->environment->render('@GoleadsitAdmin/blocks/sidebar_menu.html.twig', [
            'menu' => $this->configManager->getMenu()
        ]);
    }

    public function goleadsitParsePath($path) {
        if(!preg_match('%^((http(s?)://)|(mailto:)|(#))(.*)%', $path)) {
            $routePath = substr($path, 0, strpos($path, '?'));

            if(empty($routePath)) {
                return $this->urlGenerator->generate($path);
            }

            $params = explode('?', substr($path, strpos($path, '?') + 1));
            $routeParams = [];
            foreach($params as $p) {
                $routeParams[substr($p, 0, strpos($p, ':'))] = substr($p, strpos($p, ':') + 1);
            }

            return $this->urlGenerator->generate($routePath, $routeParams);
        }

        return $path;
    }

}
