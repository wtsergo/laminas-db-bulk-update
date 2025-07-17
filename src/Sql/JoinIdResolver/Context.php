<?php

namespace Wtsergo\LaminasDbBulkUpdate\Sql\JoinIdResolver;

use Laminas\Db\Sql;
use Wtsergo\LaminasDbBulkUpdate\Sql\JoinIdResolver;
use Wtsergo\Misc\Helper\DtoTrait;

class Context
{
    use DtoTrait;

    /**
     * @param \Closure(Sql\Sql, JoinIdResolver\Context, array): Sql\Select $selectBuilder
     * @param non-empty-array $incrementRow
     */
    public function __construct(
        public readonly string $tableName,
        public readonly string $sourceField,
        public readonly string $targetField,
        public readonly \Closure $selectBuilder,
        public readonly array $incrementRow,
        public readonly bool $generate = false,
        public readonly bool $dryRun = false,
    )
    {
    }
}
