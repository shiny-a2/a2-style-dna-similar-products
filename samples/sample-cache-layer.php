<?php

final class A2_Sample_Similar_Product_Cache {
    public function get_similar_ids(int $product_id): array {
        $signature = $this->signature_for($product_id);
        $cache_key = 'a2_similar_sample_' . $product_id . '_' . md5(wp_json_encode($signature));

        $cached = get_transient($cache_key);
        if (is_array($cached)) {
            return array_map('intval', $cached);
        }

        $lock_key = $cache_key . '_lock';
        if (get_transient($lock_key)) {
            return array();
        }

        set_transient($lock_key, 1, 30);
        $ids = $this->score_candidates($signature);
        set_transient($cache_key, $ids, HOUR_IN_SECONDS);
        delete_transient($lock_key);

        return $ids;
    }

    private function signature_for(int $product_id): array {
        return array(
            'category_ids' => wp_get_post_terms($product_id, 'product_cat', array('fields' => 'ids')),
            'price_band' => (int) floor((float) get_post_meta($product_id, '_price', true) / 100),
        );
    }

    private function score_candidates(array $signature): array {
        $query = new WP_Query(array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'fields' => 'ids',
            'posts_per_page' => 12,
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'term_id',
                    'terms' => array_map('intval', $signature['category_ids'] ?? array()),
                ),
            ),
        ));

        return array_map('intval', $query->posts);
    }
}

