<?php

final class A2_Sample_Product_Signature_Builder {
    public function build(int $product_id): array {
        return array_filter(array(
            'categories' => $this->term_ids($product_id, 'product_cat'),
            'attributes' => $this->public_attribute_terms($product_id),
            'price_band' => $this->price_band($product_id),
        ));
    }

    public function fingerprint(array $signature): string {
        ksort($signature);
        return hash('sha256', wp_json_encode($signature));
    }

    private function term_ids(int $product_id, string $taxonomy): array {
        return array_map('intval', wp_get_post_terms($product_id, $taxonomy, array('fields' => 'ids')));
    }

    private function public_attribute_terms(int $product_id): array {
        $product = wc_get_product($product_id);
        if (!$product) {
            return array();
        }

        $terms = array();
        foreach ($product->get_attributes() as $attribute) {
            if (!$attribute->is_taxonomy()) {
                continue;
            }
            $terms[$attribute->get_name()] = $this->term_ids($product_id, $attribute->get_name());
        }

        return $terms;
    }

    private function price_band(int $product_id): int {
        $price = (float) get_post_meta($product_id, '_price', true);
        return (int) floor($price / 100);
    }
}

