<?php
/**
 * Copyright © EcomDev B.V. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace Wtsergo\LaminasDbBulkUpdate\Sql;

/**
 * @template TInitial
 * @implements Identifier<TInitial>
 */
class ResolvedIdentifier implements Identifier
{
    /**
     * @param TInitial|null $initial
     */
    public function __construct(
        public readonly int|string|array $value,
        public readonly mixed            $initial = null,
        public readonly mixed            $key = null,
        public readonly ?\Closure        $onDestroy = null,
    )
    {
    }

    /**
     * @return TInitial|null
     */
    public function initial(): mixed
    {
        return $this->initial;
    }

    public function findValue(array $resolved): int|string|array
    {
        return $this->value;
    }

    public function __destruct()
    {
        if (isset($this->onDestroy) && isset($this->key)) ($this->onDestroy)($this->key);
    }
}
