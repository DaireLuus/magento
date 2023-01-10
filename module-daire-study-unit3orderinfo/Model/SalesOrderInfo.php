<?php


namespace Lumav\DaireStudyUnit3orderinfo\Model;

use Magento\Sales\Api\OrderRepositoryInterface;
use Magento\Sales\Model\Order;
use Magento\Framework\View\Element\Template;

class SalesOrderInfo extends Template
{
    /**
     * @var OrderRepositoryInterface
     */
    protected $salesOrder;

    /**
     * SalesOrderInfo constructor.
     *
     * @param OrderRepositoryInterface $orderRepo
     */
    public function __construct(OrderRepositoryInterface $orderRepo)
    {
        $this->salesOrder = $orderRepo;
        
    }

    public function getOrder($id){       
        $order = $this->salesOrder->get($id);
        $items = [];
        foreach ($order->getItems() as $item) {
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
        return $json;
    }
}
