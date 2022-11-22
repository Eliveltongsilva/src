<?php

namespace Mastering\SampleModule\Block;

use Magento\Framework\View\Element\Template;
use Mastering\SampleModule\Model\ResourceModel\Item\CollectionFactory;

class Hello extends Template
{
    private $collectionFactory;

    public function __construct(
        Template\Context $context,
        CollectionFactory $collectionFactory,
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context, $data);
    }

    /**
     * @return void
     */
    public function getById(): void
    {
       $result = $this->collectionFactory->create()->addFieldToFilter('id', 2)->getData();
       dd($result);
    }

    /**
     * @return void
     */
    public function getItems(): void
    {
        $result = $this->collectionFactory->create()->getData();
        dd($result);
    }

    /**
     * @return void
     */
    public function like(): void
    {
        $result = $this->collectionFactory->create()->addFieldToFilter('name', ['like' => '%T%'])->getData();
        dd($result);
    }

    /**
     * @return void
     */
    public function in(): void
    {
        $result = $this->collectionFactory->create()->addFieldToFilter('id', ['in' => [1,2]])->getData();
        dd($result);
    }
}
