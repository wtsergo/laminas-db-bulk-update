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
class UnresolvedIdentifier implements Identifier
{
    /**
     * @var callable
     */
    private $onDestroy;

    /**
     * @var TInitial
     */
    private mixed $initial;

    /**
     * @param TInitial|null $initial
     */
    public function __construct(
        public readonly string $value,
        callable $onDestroy,
        mixed $initial = null,
    )
    {
        $this->initial = $initial ?? $value;
        $this->onDestroy = $onDestroy;
    }

    /**
     * @return TInitial
     */
    public function initial(): mixed
    {
        return $this->initial;
    }

    public function findValue(array $resolved): int
    {
        if (!isset($resolved[$this->value])) {
            throw new IdentifierNotResolved();
        }

        return $resolved[$this->value];
    }

    public function __destruct()
    {
        ($this->onDestroy)($this->value);
    }
}
