<?php

namespace Lumav\DaireStudyUnit3orderinfo\Block;

use Lumav\DaireStudyUnit3orderinfo\Model\SalesOrderInfo;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;


class OrderInfo extends Template
{

    /**
     * @var SalesOrderInfo
     */
    protected $salesOrderInfo;

    /**
     * @param Context $context
     * @param SalesOrderInfo $salesOrderInfo
     * @param array $data
     */
    public function __construct(
        Context $context,
        SalesOrderInfo $salesOrderInfo,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->salesOrderInfo = $salesOrderInfo;
    }

    /**
     * @return array
     */
    public function getSalesOrder()
    {
        $orderID = (int)$this->getRequest()->getParam('orderID', 0);
        return $this->salesOrderInfo->getOrder($orderID);
    }
}
