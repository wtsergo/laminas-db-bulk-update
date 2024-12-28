<?php
/**
 * Copyright © EcomDev B.V. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace Wtsergo\LaminasDbBulkUpdate;

use Laminas\Db\Adapter\Adapter;
use Laminas\Db\Sql\Literal;
use Laminas\Db\Sql\Sql;
use Laminas\Db\Sql\Where;

class TableRangeConditionGeneratorFactory
{
    public const DEFAULT_RANGE_SIZE = 500;

    public function __construct(
        protected Sql $sql,
        protected SelectConditionFactory $conditionFactory,
        protected int $rangeSize = self::DEFAULT_RANGE_SIZE
    )
    {
    }

    public static function createFromAdapter(Adapter $adapter, int $rangeSize = self::DEFAULT_RANGE_SIZE): self
    {
        return new self(new Sql($adapter), new SelectConditionFactory(), $rangeSize);
    }

    public function createForTable(string $tableName, string $fieldName): TableRangeConditionGenerator
    {
        $select = $this->sql->select($tableName)
            ->columns([
                'min' => new Literal(sprintf('MIN(%s)', $fieldName)),
                'max' => new Literal(sprintf('MAX(%s)', $fieldName)),
            ]);

        list($minValue, $maxValue) = array_values(
            $this->sql->prepareStatementForSqlObject($select)->execute()->current()
        );


        $range = new Literal(sprintf('CEIL(%s / %2$d) * %2$d', $fieldName, $this->rangeSize));

        $select = $this->sql->select($tableName)
            ->columns([
                'range' => $range
            ])
            ->group($range);
        ;

        $ranges = [];
        $__stmt = $this->sql->prepareStatementForSqlObject($select);
        foreach ($__stmt->execute() as $row) {
            $ranges[] = (int)$row['range'];
        }

        return new TableRangeConditionGenerator($this->conditionFactory, (int)$minValue, (int)$maxValue, $ranges);
    }
}
