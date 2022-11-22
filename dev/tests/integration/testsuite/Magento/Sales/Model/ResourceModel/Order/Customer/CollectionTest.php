<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento\Sales\Model\ResourceModel\Order\Customer;

use Magento\Framework\ObjectManagerInterface;
use Magento\Store\Api\StoreRepositoryInterface;
use Magento\Store\Api\WebsiteRepositoryInterface;
use Magento\TestFramework\Helper\Bootstrap;
use PHPUnit\Framework\TestCase;

class CollectionTest extends TestCase
{
    /**
     * @var ObjectManagerInterface
     */
    private $objectManager;

    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        $this->objectManager = Bootstrap::getObjectManager();
    }

    /**
     * Tests that Customer collection data for Order retain website and store names after fixing performance issue.
     * @see \Magento\Customer\Model\ResourceModel\Customer\Collection::beforeAddLoadedItem()
     *
     * @magentoDataFixture Magento/Customer/_files/customer_for_second_website.php
     */
    public function testCollection(): void
    {
        /** @var Collection $customerCollection */
        $customerCollection = $this->objectManager->create(Collection::class);
        $customer = $customerCollection->getItems();
        $customer = array_shift($customer);
        /** @var WebsiteRepositoryInterface $websiteRepository */
        $websiteRepository = $this->objectManager->get(WebsiteRepositoryInterface::class);
        $website = $websiteRepository->getById($customer->getWebsiteId());
        /** @var StoreRepositoryInterface $storeRepository */
        $storeRepository = $this->objectManager->get(StoreRepositoryInterface::class);
        $store = $storeRepository->getById($customer->getStoreId());

        $this->assertEquals($website->getName(), $customer->getWebsiteName());
        $this->assertEquals($store->getName(), $customer->getStoreName());
    }
}
