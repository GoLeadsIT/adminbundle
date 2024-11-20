<?php

namespace Goleadsit\AdminBundle\Model;

class UserModel {

    /** @var int */
    private $id;

    /** @var string */
    private $nombre;

    /** @var string */
    private $apellidos;

    /** @var string */
    private $email;

    /** @var string|null */
    private $img;

    /** @var \DateTime | null */
    private $createdAt;

    /**
     * UserModel constructor.
     *
     * @param int       $id
     * @param string    $nombre
     * @param string    $apellidos
     * @param string    $email
     * @param string    $img
     * @param \DateTime $createdAt
     */
    public function __construct(int $id, string $nombre, string $apellidos, string $email, string $img = NULL, \DateTime $createdAt = NULL) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->email = $email;
        $this->img = $img;
        $this->createdAt = ($createdAt == NULL) ? new \DateTime() : $createdAt;
    }

    /**
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return UserModel
     */
    public function setId(int $id): UserModel {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getNombre(): string {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     *
     * @return UserModel
     */
    public function setNombre(string $nombre): UserModel {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * @return string
     */
    public function getApellidos(): string {
        return $this->apellidos;
    }

    /**
     * @param string $apellidos
     *
     * @return UserModel
     */
    public function setApellidos(string $apellidos): UserModel {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return UserModel
     */
    public function setEmail(string $email): UserModel {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getImg(): ?string {
        return $this->img;
    }

    /**
     * @param string $img
     *
     * @return UserModel
     */
    public function setImg(string $img): UserModel {
        $this->img = $img;

        return $this;
    }

    /**
     * @return \DateTime | null
     */
    public function getCreatedAt(): ?\DateTime {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     *
     * @return UserModel
     */
    public function setCreatedAt(\DateTime $createdAt): UserModel {
        $this->createdAt = $createdAt;

        return $this;
    }

}
