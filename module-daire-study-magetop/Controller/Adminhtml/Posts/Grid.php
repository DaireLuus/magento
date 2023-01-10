<?php
namespace Lumav\DaireStudyMagetop\Controller\Adminhtml\Posts;
 
use Lumav\DaireStudyMagetop\Controller\Adminhtml\Posts;
 
class Grid extends Posts
{
    public function execute()
    {
        return $this->_resultPageFactory->create();
    }
}