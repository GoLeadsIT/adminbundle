<?php

namespace Goleadsit\AdminBundle\Model;

class MessageModel {

    /** @var string */
    private $url;

    /** @var string */
    private $img;

    /** @var string */
    private $name;

    /** @var string */
    private $subject;

    /** @var \DateTime */
    private $date;

    /**
     * MessagesModel constructor.
     *
     * @param string $subject
     * @param string $name
     * @param string $url
     * @param string $img
     */
    public function __construct(string $subject, string $name, string $url = '#', \DateTime $date = NULL, string $img = 'default-user.jpg') {
        $this->subject = $subject;
        $this->name = $name;
        $this->url = $url;
        $this->date = ($date == NULL) ? new \DateTime() : $date;
        $this->img = $img;
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
     * @return MessageModel
     */
    public function setUrl(string $url): MessageModel {
        $this->url = $url;

        return $this;
    }

    /**
     * @return string
     */
    public function getImg(): string {
        return $this->img;
    }

    /**
     * @param string $img
     *
     * @return MessageModel
     */
    public function setImg(string $img): MessageModel {
        $this->img = $img;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return MessageModel
     */
    public function setName(string $name): MessageModel {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getSubject(): string {
        return $this->subject;
    }

    /**
     * @param string $subject
     *
     * @return MessageModel
     */
    public function setSubject(string $subject): MessageModel {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @return \DateTime | null
     */
    public function getDate(): ?\DateTime {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     *
     * @return MessageModel
     */
    public function setDate(\DateTime $date): MessageModel {
        $this->date = $date;

        return $this;
    }

}
