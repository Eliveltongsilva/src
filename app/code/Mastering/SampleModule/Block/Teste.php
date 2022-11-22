<?php

namespace Mastering\SampleModule\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\App\ResourceConnection;

class Teste extends Template
{

    const CUSTOMER_TABLE = 'customer';
    const NAME_FIELD = 'name';

    /**
     * @var ResourceConnection
     */
    private $resourceConnection;

    public function __construct(
        Template\Context $context,
        ResourceConnection $resourceConnection
    ) {
        parent::__construct($context);
        $this->resourceConnection = $resourceConnection;
    }

    /**
     * @return void
     */
    public function addItem(): void
    {
        $connection  = $this->resourceConnection->getConnection();
        $connection->getTableName(self::CUSTOMER_TABLE);

        $data = [
            self::NAME_FIELD => 'Elivelton',
        ];

        $connection->insert(self::CUSTOMER_TABLE, $data);


    }

    /**
     * @return void
     */
    public function getById(): void
    {
        $connection  = $this->resourceConnection->getConnection();
        $connection->getTableName(self::CUSTOMER_TABLE);

        $select = $connection->select()->from(
            ['c' => self::CUSTOMER_TABLE],
            ['*']
        )->where("c.id = :id");

        $params = ['id' => 2];
        $records = $connection->fetchAll($select, $params);
        dd($records);
    }

    /**
     * @return void
     */
    public function getItems(): void
    {
        $connection  = $this->resourceConnection->getConnection();
        $connection->getTableName(self::CUSTOMER_TABLE);

        $select = $connection->select()->from(
            ['c' => self::CUSTOMER_TABLE],
            ['*']
        );
        $records = $connection->fetchAll($select);
        dd($records);
    }

    /**
     * @return void
     */
    public function delete(): void
    {
        $connection  = $this->resourceConnection->getConnection();
        $connection->getTableName(self::CUSTOMER_TABLE);

        $whereConditions = [
            $connection->quoteInto('id = ?', 2)
        ];

        $connection->delete(self::CUSTOMER_TABLE, $whereConditions);
    }
}
