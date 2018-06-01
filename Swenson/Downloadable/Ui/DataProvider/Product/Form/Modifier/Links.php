<?php
/**
 * Copyright © Swenson, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Swenson\Downloadable\Ui\DataProvider\Product\Form\Modifier;

use Magento\Ui\Component\Container;
use Magento\Ui\Component\Form;
use Swenson\Downloadable\Model\Link;

/**
 * Class adds a grid with links
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Links extends \Magento\Downloadable\Ui\DataProvider\Product\Form\Modifier\Links
{
    /**
     * @return array
     */
    protected function getRecord()
    {
        $record['arguments']['data']['config'] = [
            'componentType' => Container::NAME,
            'isTemplate' => true,
            'is_collection' => true,
            'component' => 'Magento_Ui/js/dynamic-rows/record',
            'dataScope' => '',
        ];
        $recordPosition['arguments']['data']['config'] = [
            'componentType' => Form\Field::NAME,
            'formElement' => Form\Element\Input::NAME,
            'dataType' => Form\Element\DataType\Number::NAME,
            'dataScope' => 'sort_order',
            'visible' => false,
        ];
        $recordActionDelete['arguments']['data']['config'] = [
            'label' => null,
            'componentType' => 'actionDelete',
            'fit' => true,
        ];

        return $this->arrayManager->set(
            'children',
            $record,
            [
                'container_link_title' => $this->getTitleColumn(),
                'container_link_price' => $this->getPriceColumn(),
                'container_file' => $this->getFileColumn(),
                'container_sample' => $this->getSampleColumn(),
                'is_shareable' => $this->getShareableColumn(),
                'max_downloads' => $this->getMaxDownloadsColumn(),
                'position' => $recordPosition,
                'is_visible' => $this->getIsVisible(),
                'action_delete' => $recordActionDelete

            ]
        );
    }

    /**
     * @return array
     */
    protected function getIsVisible()
    {
        $isVisibleField['arguments']['data']['config'] = [
            'label' => __('Is visible'),
            'formElement' => Form\Element\Select::NAME,
            'componentType' => Form\Field::NAME,
            'dataType' => Form\Element\DataType\Number::NAME,
            'dataScope' => 'is_visible',
            'options' => [
                ['value' => Link::LINK_NOT_VISIBLE_NO, 'label' => __('No')],
                ['value' => Link::LINK_VISIBLE_YES, 'label' => __('Yes')]
            ],
        ];

        return $isVisibleField;
    }
}
