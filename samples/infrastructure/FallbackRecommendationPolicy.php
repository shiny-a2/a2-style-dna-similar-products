<?php

declare(strict_types=1);

namespace A2\Showcase\Recommendations\Infrastructure;

final class FallbackRecommendationPolicy
{
    public function choose(array $cached, array $fallback): array
    {
        if (count($cached) >= 3) {
            return array_slice($cached, 0, 8);
        }

        return array_slice($fallback, 0, 4);
    }
}
