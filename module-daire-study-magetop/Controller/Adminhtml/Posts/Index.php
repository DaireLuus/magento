<?php
namespace Lumav\DaireStudyMagetop\Controller\Adminhtml\Posts;
 
use Lumav\DaireStudyMagetop\Controller\Adminhtml\Posts;
use Lumav\DaireStudyMagetop\Model\PostsFactory;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
 
class Index extends Posts
{
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        PageFactory $resultPageFactory,
        PostsFactory $postsFactory
    )
    {
        parent::__construct($context, $coreRegistry, $resultPageFactory, $postsFactory);
    }
    public function execute()
    {
        if ($this->getRequest()->getQuery('ajax')) {
            $this->_forward('grid');
            return;
        }
 
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('Lumav_DaireStudyMagetop::helloworld_menu');
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Posts'));
 
        return $resultPage;
    }
}