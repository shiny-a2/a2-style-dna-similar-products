<?php

final class A2_Sample_Similar_Product_Renderer {
    public function render(array $product_ids): string {
        $product_ids = array_values(array_filter(array_map('absint', $product_ids)));

        if (!$product_ids) {
            return '';
        }

        ob_start();
        echo '<div class="a2-similar-products">';
        foreach (array_slice($product_ids, 0, 8) as $product_id) {
            $title = get_the_title($product_id);
            $url = get_permalink($product_id);
            if (!$title || !$url) {
                continue;
            }
            printf(
                '<a class="a2-similar-products__item" href="%s">%s</a>',
                esc_url($url),
                esc_html($title)
            );
        }
        echo '</div>';

        return (string) ob_get_clean();
    }
}

