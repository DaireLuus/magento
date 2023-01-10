<?php

namespace Lumav\DaireStudyUnit3orderinfo\Controller\Index;

use Lumav\DaireStudyUnit3orderinfo\Model\SalesOrderInfo;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\Page;


class Index extends Action
{
    /**
     * @var SalesOrderInfo
     */
    protected $salesOrderInfo;


    /**
     * @var JsonFactory
     */
    protected $resultJsonFactory;

    /**
     * @param Context $context
     * @param SalesOrderInfo $salesOrder
     * @param JsonFactory $resultJsonFactory
     */
    public function __construct(
        Context $context,
        SalesOrderInfo $salesOrder,
        JsonFactory $resultJsonFactory
    ) {
        $this->salesOrderInfo = $salesOrder;
        $this->resultJsonFactory = $resultJsonFactory;
       
        parent::__construct($context);
    }

    /**
     * @return bool
     */
    protected function _isJSONRequest()
    {
        return (int)$this->getRequest()->getParam('json', 0) === 1;
    }

    /**
     * @return ResultInterface
     */
    public function execute()
    {

        $id = (int)$this->getRequest()->getParam('orderID', 0);

        if (true === $this->_isJSONRequest()) {
            /** @var JsonFactory $resultJson */
            $resultJson = $this->resultJsonFactory->create();
            $resultJson->setData($this->salesOrderInfo->getOrder($id));
            return $resultJson;
        }

        /** @var Page resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        return $resultPage;
    }
}
