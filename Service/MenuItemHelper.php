<?php

namespace Goleadsit\AdminBundle\Service;

use Goleadsit\AdminBundle\Model\MenuItemModel;

class MenuItemHelper {

    /**
     * Convierte un menuArray en un array de MenuItemModel
     *
     * @param array $menu
     */
    public function parseMenu(array $menu) {
        $menuItemModelArray = [];

        foreach($menu as $key => $menuItem) {
            $menuItemModelArray[$key] = $this->menuItemArrayToMenuItemModelArray($menuItem);
            $menuItemModelArray[$key]->setChilds($this->setMenuItemChilds($menuItem));
        }

        return $menuItemModelArray;
    }

    /**
     * Convierte un array en un MenuItemModel
     *
     * @param array $menuItem
     *
     * @return \Goleadsit\AdminBundle\Model\MenuItemModel
     */
    private function menuItemArrayToMenuItemModelArray(array $menuItem): MenuItemModel {
        return new MenuItemModel(
            $menuItem['label'],
            $menuItem['route'],
            $menuItem['icon'],
            $menuItem['options']
        );
    }

    /**
     * Establece los hijos para un MenuItemModel
     *
     * @param array $menuItemArray
     *
     * @return array
     */
    private function setMenuItemChilds(array $menuItemArray) {
        $childs = [];

        if(!empty($menuItemArray['childs'])) {
            foreach($menuItemArray['childs'] as $key => $itemArray) {
                $childs[$key] = $this->menuItemArrayToMenuItemModelArray($itemArray);
                $childs[$key]->setChilds($this->setMenuItemChilds($itemArray));
            }
        }

        return $childs;
    }
}
