<?php

namespace Goleadsit\AdminBundle\Model;

class NotificationModel {

    /** @var string */
    private $message;

    /** @var string */
    private $icon;

    /** @var string */
    private $color;

    /**
     * NotificationModel constructor.
     *
     * @param string $message
     * @param string $icon
     * @param string $color
     */
    public function __construct(string $message, string $icon = 'fa-lightbulb-o', string $color = '#3c8dbc') {
        $this->message = $message;
        $this->icon = $icon;
        $this->color = $color;
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
     * @return NotificationModel
     */
    public function setMessage(string $message): NotificationModel {
        $this->message = $message;

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
     * @return NotificationModel
     */
    public function setIcon(string $icon): NotificationModel {
        $this->icon = $icon;

        return $this;
    }

    /**
     * @return string
     */
    public function getColor(): string {
        return $this->color;
    }

    /**
     * @param string $color
     *
     * @return NotificationModel
     */
    public function setColor(string $color): NotificationModel {
        $this->color = $color;

        return $this;
    }
}
