<?php

namespace Goleadsit\AdminBundle\Service;

use Goleadsit\AdminBundle\Model\UserModel;

interface UserProviderInterface {

    /**
     * @return \Goleadsit\AdminBundle\Model\UserModel
     */
    public function getUser(): UserModel;
}
