<?php
namespace Lumav\DaireStudyUnit4list\Controller\Index;

use Lumav\DaireStudyUnit4list\Model\Vendor;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Request\Http;

class Index implements HttpGetActionInterface
{
    protected $pageFactory;
    protected $httpRequest;

    public function __construct(
        PageFactory $pageFactory,
        Http $httpRequest
    ) {
        $this->pageFactory = $pageFactory;
        $this->httpRequest = $httpRequest;
    }

    public function execute()
    {
        $pageResult = $this->pageFactory->create();
        $pageResult->addHandle('vendorlist_index_index');
        return $pageResult;
    }
}

