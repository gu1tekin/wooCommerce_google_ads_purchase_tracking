<?php
/**
 * @snippet       WooCommerce Google Ads Purchase Tracking with gtag.js
 * @author        Gultkein Cirik
 * @Compatible    WooCommerce 2.6.14  or Newer AND WordPress 4.1.1 or Newer
 */
  
// Implementing the Google Ads Global site tag (gtag.js) to <head>
add_action('wp_head', 'add_globabl_site_tag');
    function add_globabl_site_tag(){ ?>
        <script async src="https://www.googletagmanager.com/gtag/js?id=AW_MEASUREMENT_ID"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'AW_MEASUREMENT_ID');
        </script>
  <?php } 

// Implementing the Google Ads Purchase Conversion Code to Order Confirmation Page
add_action('woocommerce_thankyou', 'ads_purchase_tracking');
    function ads_purchase_tracking($order_id){
	   $order = new WC_Order($order_id);
	   $currency = $order->get_order_currency();
	   $total = $order->get_total(); ?>
        <script>
         gtag('event', 'conversion', {
        'send_to': 'AW-CONVERSION_ID/AW-CONVERSION_LABEL',
        'value': <?php echo $total ?>,
        'currency': '<?php echo $currency ?>',
        'transaction_id': '<?php echo $order_id ?>'
  });
</script>
<?php } ?>