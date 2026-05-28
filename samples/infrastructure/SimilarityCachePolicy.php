<?php

declare(strict_types=1);

namespace A2\Showcase\Recommendations\Infrastructure;

final class SimilarityCachePolicy
{
    public function keyFor(int $productId, string $signatureFingerprint): string
    {
        return sprintf('similar:%d:%s', $productId, substr($signatureFingerprint, 0, 16));
    }

    public function ttlSeconds(int $candidateCount): int
    {
        return $candidateCount > 0 ? 21600 : 900;
    }
}
