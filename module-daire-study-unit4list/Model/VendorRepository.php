<?php

namespace Lumav\DaireStudyUnit4list\Model;

use Lumav\DaireStudyUnit4list\Model\ResourceModel\Vendor as VendorResource;
use Lumav\DaireStudyUnit4list\Model\Vendor as VendorModel;
use Lumav\DaireStudyUnit4list\Model\VendorFactory as VendorFactory;
use Lumav\DaireStudyUnit4list\Model\Vendor;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\SearchCriteria;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchCriteriaBuilderFactory;
//use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Magento\Framework\Api\SortOrderBuilder;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\CouldNotSaveException;

class VendorRepository
{
    protected $vendorFactory;
    protected $vendorResource;
    protected $vendorCollectionFactory;

    protected $filterBuilder;
    protected $searchCriteriaBuilderFactory;
    protected $sortOrderBuilder;
    protected $searchResultsInterfaceFactory;
    protected $collectionProcessor;


    public function __construct(
        VendorFactory $vendorFactory,
        VendorResource $vendorResource,
        VendorResource\CollectionFactory $vendorCollectionFactory,
        FilterBuilder $filterBuilder,
        SearchCriteriaBuilderFactory $searchCriteriaBuilderFactory,
        SortOrderBuilder $sortOrderBuilder,
        SearchResultsInterfaceFactory $searchResultsInterfaceFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->vendorFactory = $vendorFactory;
        $this->vendorResource = $vendorResource;
        $this->vendorCollectionFactory = $vendorCollectionFactory;

        $this->filterBuilder = $filterBuilder;
        $this->searchCriteriaBuilderFactory = $searchCriteriaBuilderFactory;
        $this->sortOrderBuilder = $sortOrderBuilder;
        $this->searchResultsInterfaceFactory = $searchResultsInterfaceFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    public function save(Vendor $vendor)
    {
        try {
            $this->vendorResource->save($vendor);
        } catch (AlreadyExistsException $e) {
            throw new CouldNotSaveException(__(' Couldn\'t save vendor %1 '), $e);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__(' Couldn\'t save vendor %1 '), $e);
        }
    }

    public function createModel()
    {
        $vendorModel = $this->vendorFactory->create();
        return $vendorModel;
    }

    public function load(int $vendorId)
    {
        $vendorModel = $this->vendorFactory->create();
        $this->vendorResource->load($vendorModel, $vendorId);
        return $vendorModel;
    }

    public function getById(int $vendorId)
    {
        $vendorModel = $this->vendorFactory->create();
        $this->vendorResource->load($vendorModel, $vendorId);

        return $vendorModel;
    }


    public function insertProduct($vendorId, $productId)
    {
        $this->vendorResource->insertProduct($vendorId, $productId);
    }

    public function getVendorWProducts($vendorId)
    {
        /** @var \Lumav\DaireStudyUnit4list\Model\ResourceModel\Vendor\Collection $vendorCollection */
        $vendorCollection = $this->vendorCollectionFactory->create();

        $vendorCollection
            ->getSelect()
            ->joinRight(
                ['vp' => VendorResource::VENDOR_PRODUCT_JOIN_TABLE_NAME],
                'vp.vendor_id = main_table.' . VendorModel::ID
            )->where(
                'vp.vendor_id = ? ',
                $vendorId
            )->columns(
                ['main_table.*', 'vp.product_id']
            );
        return $vendorCollection->getData();
    }

    public function getAllVendors()
    {
        /** @var \Lumav\DaireStudyUnit4list\Model\ResourceModel\Vendor\Collection $vendorCollection */
        $vendorCollection = $this->vendorCollectionFactory->create();
        return $vendorCollection;
    }

    protected function getVendorListBySearchCritearia(SearchCriteria $searchCritearia)
    {
        
        $collection = $this->vendorCollectionFactory->create()->load();
        /** @var \Magento\Framework\Api\SearchResults $searchResults */
        $searchResults = $this->searchResultsInterfaceFactory->create();
        $searchResults->setSearchCriteria($searchCritearia);
        $searchResults->setItems($collection->getItems());
        return $searchResults->getItems();
    }

    protected function getList(SearchCriteriaInterface $searchCriteria = null)
    {
        $collection = $this->vendorCollectionFactory->create();
        /** @var $searchResults \Magento\Framework\Api\SearchResults */
        $searchResults = $this->searchResultsInterfaceFactory->create();
        if ($searchCriteria) {
            
            $this->collectionProcessor->process($searchCriteria, ($collection));
            $searchResults->setSearchCriteria($searchCriteria);
        }
        $searchResults->setItems($collection->getItems());

        return $searchResults;
    }

    public function getVendorListByParams(array $sortingParams = null, array $filterParams = null)
    {
        /** @var SearchCriteriaBuilder $searchCriteariaBuilder */
        $searchCriteariaBuilder = $this->searchCriteriaBuilderFactory->create();

        if ($sortingParams && count($sortingParams) > 0) {
            $sortByParam = array_keys($sortingParams);
            $sortingKey = $sortByParam[0];
            $sortDirection = $sortingParams[$sortingKey];

            $sortOrder = $this->sortOrderBuilder
                ->setField($sortingKey)
                ->setDirection(strtoupper($sortDirection))->create();
            $searchCriteariaBuilder = $searchCriteariaBuilder->addSortOrder($sortOrder);
        }

        if ($filterParams && count($filterParams) > 0) {
            $filters = [];
            foreach ($filterParams as $key => $val) {
                $searchCriteariaBuilder = $searchCriteariaBuilder->addFilter($key, $val);
            }

        }
        $searchCritearia = $searchCriteariaBuilder->create();
        $filteredVendors = $this->getList($searchCritearia)->getItems();

        return $filteredVendors;
    }

    public function getDistinctValuesByField($fieldName)
    {
        /** @var \Lumav\DaireStudyUnit4list\Model\ResourceModel\Vendor\Collection $vendorCollection */
        $vendorCollection = $this->vendorCollectionFactory->create();
        return $vendorCollection->distinct(true)->getColumnValues($fieldName);
    }

    public function getFieldNames()
    {
        $fields = [];
        $tableDescription = $this->vendorResource->getConnection()->describeTable(VendorResource::TABLE_NAME);
        foreach ($tableDescription as $td) {
            $fields[] = $td['COLUMN_NAME'];
        }
        return $fields;
    }

    public function getVendorsByProdId(array $productIds)
    {
        $vendorIds = $this->vendorResource->getVendorIdsByProdIds($productIds);


        $vendors = [];
        foreach ($vendorIds as $vendorId) {
            /**
             * @var \Lumav\DaireStudyUnit4list\Model\Vendor
             */
            $vendor = $this->getById($vendorId);
            $vendors[] = $vendor;
        }

        return $vendors;
    }

}
