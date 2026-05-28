<?php

final class A2_Sample_Similarity_Scoring_Service {
    public function score(array $source, array $candidate): int {
        $score = 0;

        $score += 8 * count(array_intersect($source['categories'] ?? array(), $candidate['categories'] ?? array()));
        $score += 3 * $this->shared_attribute_count($source['attributes'] ?? array(), $candidate['attributes'] ?? array());

        if (($source['price_band'] ?? null) !== null && ($candidate['price_band'] ?? null) !== null) {
            $distance = abs((int) $source['price_band'] - (int) $candidate['price_band']);
            $score += max(0, 5 - $distance);
        }

        return $score;
    }

    private function shared_attribute_count(array $left, array $right): int {
        $count = 0;
        foreach ($left as $name => $terms) {
            $count += count(array_intersect($terms, $right[$name] ?? array()));
        }
        return $count;
    }
}

