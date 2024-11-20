<?php

namespace Goleadsit\AdminBundle\Service;

use Goleadsit\AdminBundle\Model\UserModel;

class AbstractUserProvider implements UserProviderInterface {

    /**
     * @return \Goleadsit\AdminBundle\Model\UserModel
     */
    public function getUser(): UserModel {
        return new UserModel('1', 'Goleads', 'IT', 'goleadsit@gmail.com');
    }

}
