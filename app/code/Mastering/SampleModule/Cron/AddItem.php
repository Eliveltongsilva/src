<?php

namespace Mastering\SampleModule\Cron;

use Mastering\SampleModule\Model\ItemFactory;
use Mastering\SampleModule\Model\Config;

/**
 * bin/magento cron:run
 */
class AddItem
{
    private $itemFactory;

    private $config;

    public function __construct(ItemFactory $itemFactory, Config $config)
    {
        $this->itemFactory = $itemFactory;
        $this->config = $config;
    }

    public function execute()
    {
        if ($this->config->isEnabled()) {
            $this->itemFactory->create()
                ->setName('Scheduled item')
                ->save();
        }
    }
}
