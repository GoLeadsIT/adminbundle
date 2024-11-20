<?php

namespace Goleadsit\AdminBundle\Service;

interface MessagesProviderInterface {

    /**
     * @return \Goleadsit\AdminBundle\Model\MessageModel[]|null
     */
    public function getMessages(): ?array;
}
