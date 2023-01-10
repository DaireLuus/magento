<?php
namespace Lumav\DaireStudyMagetop\Observer;
 
use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;
use Magento\Customer\Model\Session;

class DisplayText implements ObserverInterface
{
    protected $session;
    function __construct(
        Session $session
    )
    {
        $this->session = $session;
    }
 
 
    public function execute(EventObserver $observer)
    {
        // TODO: Implement execute() method.
        $message  = $observer->getData('hello_message');
        $message .= ' Magetop'; // change text
        $this->session->setTextMessage($message);
    }
}