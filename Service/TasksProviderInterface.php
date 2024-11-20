<?php

namespace Goleadsit\AdminBundle\Service;

interface TasksProviderInterface {

    /**
     * @return \Goleadsit\AdminBundle\Model\TaskModel[]|null
     */
    public function getTasks(): ?array;
}
