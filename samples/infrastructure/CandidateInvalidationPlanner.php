<?php

declare(strict_types=1);

namespace A2\Showcase\Recommendations\Infrastructure;

final class CandidateInvalidationPlanner
{
    public function affectedProducts(array $changedFields): array
    {
        $watched = array('category', 'material', 'style', 'price_band', 'visibility');

        foreach ($watched as $field) {
            if (array_key_exists($field, $changedFields)) {
                return array('scope' => 'related-signatures');
            }
        }

        return array('scope' => 'none');
    }
}
