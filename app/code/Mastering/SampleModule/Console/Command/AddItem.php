<?php

namespace Mastering\SampleModule\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Mastering\SampleModule\Model\ItemFactory;
use Magento\Framework\Console\Cli;
use Psr\Log\LoggerInterface;

/**
 * necessário criação do di.xml
 * command in terminal:
 * bin/magento c:f
 * bin/magento s:up
 * bin/magento mastering:item:add "Item 3"
 */
class AddItem extends Command
{
    const INPUT_KEY_NAME = 'name';

    /**
     * @var ItemFactory
     */
    private $itemFactory;

    /**
     * Undocumented variable
     *
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(ItemFactory $itemFactory, LoggerInterface $logger)
    {
        $this->itemFactory = $itemFactory;
        $this->logger = $logger;
        parent::__construct();
    }

    /**
     * @return void
     */
    protected function configure()
    {
        $this->setName('mastering:item:add')
            ->addArgument(self::INPUT_KEY_NAME, InputArgument::OPTIONAL);
        parent::configure();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $item = $this->itemFactory->create();
        $item->setName($input->getArgument(self::INPUT_KEY_NAME));
        $item->setIsObjectNew(true);
        $item->save();
        $this->logger->debug('Item was created teste!');
        return Cli::RETURN_SUCCESS;
    }
}
