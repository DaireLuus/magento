<?php
namespace Lumav\DaireStudyMagetop\Controller\Index;

use Magento\Framework\App\Action\Context;
use Lumav\DaireStudyMagetop\Model\ResourceModel\Posts\CollectionFactory;
use Lumav\DaireStudyMagetop\Helper\Data;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Action;
 
class Index extends Action
{
    protected $_resultPageFactory;
    protected $_postsFactory;
    protected $_dataHelper;
 
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        CollectionFactory $postsFactory,
        Data $dataHelper)
    {
        parent::__construct($context);
        $this->_resultPageFactory = $resultPageFactory;
        $this->_postsFactory = $postsFactory;
        $this->_dataHelper = $dataHelper;
    }
 
    public function execute()
    {
        echo "Get Data From magetop_blog table <br>";
        $numberPosts = $this->_dataHelper->getHelloSetting('blog/setting/number_posts');
        echo "Number Posts = {$numberPosts}";
        $this->_postsFactory->create();
        $collection = $this->_postsFactory->create()
            ->addFieldToSelect(array('title','description','created_at','status')) // fields to select
            ->addFieldToFilter('status',1) // filter status = 1
            ->setPageSize($numberPosts); // get 3 items
        echo '<pre>';
        print_r($collection->getData());
        echo '<pre>';
        echo "==========Check date, helper function ======== <br>";
        $date = '2022-02-16';
        if ($this->_dataHelper->checkDate($date)) {
            echo "Yes, {$date} is Sunday , I can go to your home";
        } else {
            echo "Yes, {$date} is not Sunday , I was to busy";
        }
    }
}

/* Kolmas tehtud Index fail enne kui oli system.xml fail tehtud

use Magento\Framework\App\Action\Context;
use Lumav\DaireStudyMagetop\Model\ResourceModel\Posts\CollectionFactory;
use Lumav\DaireStudyMagetop\Helper\Data;
use Magento\Framework\App\Action\Action;
use Magento\Framework\View\Result\PageFactory;
 
class Index extends Action
{
    protected $_resultPageFactory;
    protected $_postsFactory;
    protected $_dataHelper;
 
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        CollectionFactory $postsFactory,
        Data $dataHelper)
    {
        parent::__construct($context);
        $this->_resultPageFactory = $resultPageFactory;
        $this->_postsFactory = $postsFactory;
        $this->_dataHelper = $dataHelper;
    }
 
    public function execute()
    {
        echo "Get Data From magetop_blog table";
        $this->_postsFactory->create();
        $collection = $this->_postsFactory->create()
            ->addFieldToSelect(array('title', 'description', 'created_at', 'status'))
            ->addFieldToFilter('status', 1)
            ->setPageSize(10);
        echo '<pre>';
        print_r($collection->getData());
        echo '<pre>';
        echo "========== Check date, helper function ======== <br>";
        $date = '2022-02-13';
        if ($this->_dataHelper->checkDate($date)) {
            echo "Yes, {$date} is Sunday , I can go to your home";
        } else {
            echo "Yes, {$date} is not Sunday , I was to busy";
        }
    }
}*/

/* Teine tehtud Index fail - näitas lõpuks 2 lahtriga tabelit lehel, ilma Helperita
use Magento\Framework\App\Action\Context;
use Lumav\DaireStudyMagetop\Model\ResourceModel\Posts\CollectionFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\View\Result\PageFactory;
 
class Index extends Action
{
    protected $_resultPageFactory;
    protected $_postsFactory;
 
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        CollectionFactory $postsFactory)
    {
        parent::__construct($context);
        $this->_resultPageFactory = $resultPageFactory;
        $this->_postsFactory = $postsFactory;
    }
 
    public function execute()
    {
        echo "Get Data From magetop_blog table";
        $this->_postsFactory->create();
        $collection = $this->_postsFactory->create()
            ->addFieldToSelect(array('title','description','created_at','status'))
            ->addFieldToFilter('status',1)
            ->setPageSize(10);
        echo '<pre>';
        print_r($collection->getData());
        echo '<pre>';
    }
}*/

/* Alguses tehtud Index faili sisu:
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\Action;
use Magento\Framework\View\Result\PageFactory;
  
class Index extends Action
{
    protected $_resultPageFactory;
  
    public function __construct(Context $context, PageFactory $resultPageFactory)
    {
        $this->_resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }
  
    public function execute()
    {
        $resultPage = $this->_resultPageFactory->create();
        return $resultPage;
    }
}*/