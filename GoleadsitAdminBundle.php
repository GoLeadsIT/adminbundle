<?php

namespace Goleadsit\AdminBundle;

use Goleadsit\AdminBundle\DependencyInjection\GoleadsitAdminExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class GoleadsitAdminBundle extends Bundle {

    public function getContainerExtension() {
        if($this->extension === NULL) {
            $this->extension = new GoleadsitAdminExtension();
        }

        return $this->extension;
    }

}
