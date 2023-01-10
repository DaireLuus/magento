<?php
namespace Lumav\DaireStudyUnit2controller\Block;



use Magento\Backend\Block\Template\Context;
use Magento\Framework\View\Element\Template;
use Magento\Sales\Model\OrderRepository;
use Magento\Framework\Serialize\SerializerInterface;
use Magento\Framework\App\Request\Http;




class OrderInfo extends Template {

    private $_orderRepository;
    private $serializer;
    private $request;
    
    

    public function __construct(Context $context, OrderRepository $orderRepository, SerializerInterface $serializer, Http $request, array $data = []) {
        $this->_orderRepository = $orderRepository;
        $this->serializer = $serializer;
        $this->request = $request;
        parent::__construct($context, $data);
    }

         
    public function getOrderInfo() {
        $data = []; 
        $orderID = $this->request->getParam('orderID'); 
        $orderInfo = $this->_orderRepository->get($orderID);
        $orderItems = $orderInfo->getAllItems();
        $data["items"] = [];
        foreach ($orderItems as $item) {
            $itemToAdd = [];
            $info = $item->getData();
            $itemToAdd["item_id"] = $info["item_id"];
            $itemToAdd["sku"] = $info["sku"];
            $itemToAdd["price"] = $info["price"];
            array_push($data["items"], $itemToAdd);
          } 
        $data["status"] = $orderInfo->getStatus();
        $data["total"] = $orderInfo->getTotalDue();
        $data["total_invoiced"] = $orderInfo->getTotalInvoiced();
        return $this->serializer->serialize($data);
    }

}