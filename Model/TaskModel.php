<?php

namespace Goleadsit\AdminBundle\Model;

class TaskModel {

    /** @var string */
    private $message;

    /** @var string */
    private $url;

    /** @var string */
    private $icon;

    /**
     * TaskModel constructor.
     *
     * @param string $message
     * @param string $url
     * @param string $icon
     */
    public function __construct(string $message, string $url = '#', string $icon = 'fa-ban') {
        $this->message = $message;
        $this->icon = $icon;
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getMessage(): string {
        return $this->message;
    }

    /**
     * @param string $message
     *
     * @return TaskModel
     */
    public function setMessage(string $message): TaskModel {
        $this->message = $message;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string {
        return $this->url;
    }

    /**
     * @param string $url
     *
     * @return TaskModel
     */
    public function setUrl(string $url): TaskModel {
        $this->url = $url;

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
     * @return TaskModel
     */
    public function setIcon(string $icon): TaskModel {
        $this->icon = $icon;

        return $this;
    }

}
