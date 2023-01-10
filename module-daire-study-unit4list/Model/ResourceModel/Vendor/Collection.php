<?php


namespace Lumav\DaireStudyUnit4list\Model\ResourceModel\Vendor;

use Lumav\DaireStudyUnit4list\Model\Vendor;
use Lumav\DaireStudyUnit4list\Model\ResourceModel\Vendor as VendorResource;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    public function __construct(
        \Magento\Framework\Data\Collection\EntityFactoryInterface $entityFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy,
        \Magento\Framework\Event\ManagerInterface $eventManager,
        \Magento\Framework\DB\Adapter\AdapterInterface $connection = null,
        \Magento\Framework\Model\ResourceModel\Db\AbstractDb $resource = null
    ) {
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $connection, $resource);
    }

    public function _construct()
    {
        $this->_init(Vendor::class, VendorResource::class);
        $this->_setIdFieldName($this->getResource()->getIdFieldName());
    }
}
