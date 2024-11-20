<?php

namespace Goleadsit\AdminBundle\Service;

interface NotificationsProviderInterface {

    /**
     * @return \Goleadsit\AdminBundle\Model\NotificationModel[]|null
     */
    public function getNotifications(): ?array;
}
