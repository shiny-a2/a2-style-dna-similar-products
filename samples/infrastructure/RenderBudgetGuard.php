<?php

declare(strict_types=1);

namespace A2\Showcase\Recommendations\Infrastructure;

final class RenderBudgetGuard
{
    public function __construct(private int $budgetMs = 120)
    {
    }

    public function exceeded(float $startedAt): bool
    {
        return ((microtime(true) - $startedAt) * 1000) > $this->budgetMs;
    }
}
