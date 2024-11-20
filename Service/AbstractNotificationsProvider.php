<?php

namespace Goleadsit\AdminBundle\Service;

class AbstractNotificationsProvider implements NotificationsProviderInterface {

    /**
     * @return \Goleadsit\AdminBundle\Model\NotificationModel[]|null
     */
    public function getNotifications(): ?array {
        return NULL;
    }

}
