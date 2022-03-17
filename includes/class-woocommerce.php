<?php

Class WooSupport extends Singleton
{

    public $removeAction = [
        // loop
        ['woocommerce_before_shop_loop','woocommerce_catalog_ordering', 30],
        ['woocommerce_before_shop_loop','woocommerce_result_count', 20],
        ['woocommerce_after_shop_loop_item_title','woocommerce_template_loop_price', 10],
        ['woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating', 5],
        ['woocommerce_before_main_content','woocommerce_output_content_wrapper', 10],
        ['woocommerce_before_main_content','woocommerce_breadcrumb', 20],
        ['woocommerce_after_main_content','woocommerce_output_content_wrapper_end', 10],

        // loop item
        ['woocommerce_before_shop_loop_item_title','woocommerce_template_loop_product_thumbnail', 10],
        ['woocommerce_shop_loop_item_title','woocommerce_template_loop_product_title',10],
        ['woocommerce_after_shop_loop_item','woocommerce_template_loop_add_to_cart',10],
        
        // product
        ['woocommerce_before_single_product_summary','woocommerce_show_product_sale_flash',10],
        ['woocommerce_before_single_product_summary','woocommerce_show_product_images',20],
        ['woocommerce_single_product_summary','woocommerce_template_single_title',5],
        ['woocommerce_single_product_summary','woocommerce_template_single_rating',10],
        ['woocommerce_single_product_summary','woocommerce_template_single_price',10],
        ['woocommerce_single_product_summary','woocommerce_template_single_excerpt',20],
        ['woocommerce_single_product_summary','woocommerce_template_single_meta',40],
        ['woocommerce_single_product_summary','woocommerce_template_single_sharing',50],
    ];

    public function __construct()
    {
        // remove basic woo style
        add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

        // main stuff
        $this->ft_set_loop_columns();

        // sidebar
        $this->ft_register_woo_sidebars();

        // remove items
        foreach($this -> removeAction as $item){
            remove_action( $item[0], $item[1], $item[2]);
        }
    }


    function ft_set_loop_columns(){
        add_filter('loop_shop_columns', 'loop_columns', 999);
        if (!function_exists('loop_columns')) {
            function loop_columns() {
                return 3; // 3 products per row
            }
        }
    }


    function ft_register_woo_sidebars(){
        add_action( 'widgets_init', 'ft_widgets_init' );
        if (!function_exists('ft_widgets_init')) :
            function ft_widgets_init() {
                register_sidebar( 
                    array(
                        'name'          => __( 'WooCommerce sidebar', 'finecart' ),
                        'id'            => 'ft-shop',
                        'before_sidebar'=> '<aside class="ft-width-max-300">',
                        'after_sidebar' => '</aside>',
                        'before_widget' => '<div id="%1$s" class="uk-margin-bottom uk-padding-small widget %2$s">',
                        'after_widget'  => '</div>',
                        'before_title'  => '<h3 class="widget-title">',
                        'after_title'   => '</h3>',
                    ) 
                );
            }
        endif;
    }


}

WooSupport::getInstance();