<?php
/**
 * Copyright © Swenson, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Swenson\Downloadable\Model;


class Link extends \Magento\Downloadable\Model\Link
{

    const LINK_VISIBLE_YES = 1;

    const LINK_NOT_VISIBLE_NO = 0;

    const KEY_IS_VISIBLE = 'is_visible';


    public function getIsVisible()
    {
        return $this->getData(self::KEY_IS_VISIBLE);
    }


    public function setIsVisible($isVisible)
    {
        return $this->setData(self::KEY_IS_VISIBLE, $isVisible);
    }
}