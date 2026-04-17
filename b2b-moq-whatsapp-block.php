<?php
/**
 * Madhu Collection: B2B Minimum Order Policy & Dynamic WhatsApp Link
 * Hook: woocommerce_single_product_summary (Priority: 25)
 */

add_action('woocommerce_single_product_summary', 'madhu_moq_info_block', 25);
function madhu_moq_info_block() {
    global $product;
    
    // Ensure we are actually on a product before trying to pull data
    if ( ! is_a( $product, 'WC_Product' ) ) {
        return;
    }

    // Get the dynamic product name and URL
    $product_name = $product->get_name();
    $product_url = get_permalink( $product->get_id() );
    
    // Construct the custom message
    $whatsapp_message = "Hi, I want to know about bundle pricing for: " . $product_name . " - " . $product_url;
    
    // URL encode the message so it formats correctly in the browser link
    $encoded_message = rawurlencode( $whatsapp_message );
    
    // Build the final WhatsApp API URL
    $whatsapp_url = "https://api.whatsapp.com/send?phone=919654417411&text=" . $encoded_message;
?>
<div class="madhu-moq-box" style="border: 1px solid #e5e5e5; border-radius: 8px; padding: 18px 20px; margin: 16px 0; background: #fafafa;">
    <p style="font-size: 11px; font-weight: 600; color: #888; text-transform: uppercase; letter-spacing: 0.05em; margin: 0 0 12px;">Minimum order policy</p>
    
    <div style="display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 14px;">
        <div style="flex: 1; min-width: 120px; background: #fff; border: 1px solid #eee; border-radius: 6px; padding: 10px 12px;">
            <p style="font-size: 11px; color: #999; margin: 0 0 3px;">Order unit</p>
            <p style="font-size: 14px; font-weight: 600; margin: 0; color: #111;">1 bundle</p>
        </div>
        <div style="flex: 1; min-width: 120px; background: #fff; border: 1px solid #eee; border-radius: 6px; padding: 10px 12px;">
            <p style="font-size: 11px; color: #999; margin: 0 0 3px;">Sizes per bundle</p>
            <p style="font-size: 14px; font-weight: 600; margin: 0; color: #111;">1 size, multiple prints/colors</p>
        </div>
        <div style="flex: 1; min-width: 120px; background: #fff; border: 1px solid #eee; border-radius: 6px; padding: 10px 12px;">
            <p style="font-size: 11px; color: #999; margin: 0 0 3px;">Pieces per bundle</p>
            <p style="font-size: 14px; font-weight: 600; margin: 0; color: #111;">See product details</p>
        </div>
    </div>
    
    <p style="font-size: 12px; color: #666; border-left: 3px solid #ddd; padding-left: 10px; margin: 0 0 14px; line-height: 1.6;">
        Each bundle contains <strong>one size</strong> in a mix of prints/colors. Sizes cannot be split or mixed within a single bundle.
    </p>
    
    <div style="display: flex; gap: 8px; flex-wrap: wrap;">
        <?php if ( ! is_user_logged_in() ) : ?>
            <a href="/my-account/" style="flex: 1; min-width: 130px; text-align: center; background: #111; color: #fff; padding: 9px 14px; border-radius: 6px; font-size: 12px; font-weight: 600; text-decoration: none;">
                Register to see prices
            </a>
        <?php endif; ?>
        <a href="<?php echo esc_url( $whatsapp_url ); ?>" target="_blank" style="flex: 1; min-width: 130px; text-align: center; background: #fff; color: #111; padding: 9px 14px; border-radius: 6px; font-size: 12px; font-weight: 600; text-decoration: none; border: 1px solid #ddd;">
            Ask on WhatsApp
        </a>
    </div>
</div>
<?php
}
