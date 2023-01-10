<?php
 
namespace Lumav\DaireStudyCheckout\Controller\Index;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

use Magento\Sales\Api\OrderRepositoryInterface;

class Index extends Action
{
    /**
     * @var OrderRepositoryInterface
     */
    protected $salesOrder;


    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $resultJsonFactory;

    /**
     * @param Context                                          $context
     * @param OrderRepositoryInterface                         $salesOrder
     * @param \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
     */
    public function __construct(
        Context $context,
        OrderRepositoryInterface $salesOrder,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
    ) {
        $this->salesOrder = $salesOrder;
        $this->resultJsonFactory = $resultJsonFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $id = (int)$this->getRequest()->getParam('orderID', 0);

        /** @var \Magento\Sales\Model\Order $order */
        $order = $this->salesOrder->get($id);

        $items = [];
        foreach ($order->getItems() as $item) {
            /** @var $item \Magento\Sales\Model\Order\Item */
            $items[] = [
                'sku'     => $item->getSku(),
                'item_id' => $item->getId(),
                'price'   => $item->getPriceInclTax(),
            ];
        }

        $json = [
            'status'         => $order->getStatus(),
            'total'          => $order->getGrandTotal(),
            'total_invoiced' => $order->getTotalInvoiced(),
            'items'          => $items,
        ];
        /** @var \Magento\Framework\Controller\Result\JsonFactory $resultJson */
        $resultJson = $this->resultJsonFactory->create();
        $resultJson->setData($json);
        return $resultJson;
    }
}
