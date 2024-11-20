<?php

namespace Goleadsit\AdminBundle\Service;

class AbstractMessagesProvider implements MessagesProviderInterface {

    /**
     * @return \Goleadsit\AdminBundle\Model\MessageModel[] | null
     */
    public function getMessages(): ?array {
        return NULL;
    }

}
