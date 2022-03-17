<?php 
if ( is_singular( 'product' ) ) :
    get_template_part('woocommerce/ft','single');
else : 
    get_template_part('woocommerce/ft','archive');
endif;