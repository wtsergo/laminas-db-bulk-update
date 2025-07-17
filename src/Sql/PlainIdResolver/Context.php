<?php

namespace Wtsergo\LaminasDbBulkUpdate\Sql\PlainIdResolver;

use Wtsergo\Misc\Helper\DtoTrait;

class Context
{
    use DtoTrait;

    public function __construct(
        public readonly string $tableName,
        public readonly string $sourceField,
        public readonly string $targetField,
        public readonly array $incrementRow = [],
        public readonly array $filter = [],
        public readonly bool $generate = false,
        public readonly bool $dryRun = false,
        public readonly ?SequenceInfo $sequenceInfo = null,
    )
    {
    }
}
