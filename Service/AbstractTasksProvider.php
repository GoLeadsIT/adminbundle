<?php

namespace Goleadsit\AdminBundle\Service;

class AbstractTasksProvider implements TasksProviderInterface {

    /**
     * @return \Goleadsit\AdminBundle\Model\TaskModel[]|null
     */
    public function getTasks(): ?array {
        return NULL;
    }

}
