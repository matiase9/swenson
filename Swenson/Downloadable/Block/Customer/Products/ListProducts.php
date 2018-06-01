<?php
/**
 * Copyright © Swenson, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */


namespace Swenson\Downloadable\Block\Customer\Products;

use \Swenson\Downloadable\Model\Link;
use \Magento\Downloadable\Model\Link\Purchased\Item;

class ListProducts extends \Magento\Downloadable\Block\Customer\Products\ListProducts
{

    protected function _construct()
    {
        parent::_construct();
        $purchased = $this->_linksFactory->create()
            ->addFieldToFilter('customer_id', $this->currentCustomer->getCustomerId())
            ->addOrder('created_at', 'desc');
        $this->setPurchased($purchased);
        $purchasedIds = [];
        foreach ($purchased as $_item) {
            $purchasedIds[] = $_item->getId();
        }
        if (empty($purchasedIds)) {
            $purchasedIds = [null];
        }
        $purchasedItems = $this->_itemsFactory->create()->addFieldToFilter(
            'purchased_id',
            ['in' => $purchasedIds]
        )->addFieldToFilter(
            'status',
            ['nin' => [Item::LINK_STATUS_PENDING_PAYMENT, Item::LINK_STATUS_PAYMENT_REVIEW]]
        )->addFieldToFilter(
            'is_visible',Link::LINK_VISIBLE_YES
        )->setOrder(
            'item_id',
            'desc'
        );
        $this->setItems($purchasedItems);
    }
}
