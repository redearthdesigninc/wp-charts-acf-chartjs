######################################################
## Use this to add the charts to your template file ##
######################################################

<span>Demographics</span><br />
     <?php
     /* Displays chart.js. Code is in /inc/chart.php */
     $demographic_data = red_get_demographic_data();
     red_display_chart( $demographic_data );
     ?>

<span>Students on grade level (proficiency)</span><br />
     <?php
     /* Displays chart.js. Code is in /inc/chart.php */
     $grad_rate_data = red_get_demographic_data( 'grad_rate_data_points' );
     red_display_chart( $grad_rate_data, array( 'type' => 'horizontalBar', 'canvas_id' => 'myChart-2' ) );
     ?>
     <br /><br />
<span>Students on track (progress)</span><br />
     <?php
     /* Displays chart.js. Code is in /inc/chart.php */
     $mca_proficiency_data = red_get_demographic_data( 'mca_proficiency_data_points' );
     red_display_chart( $mca_proficiency_data, array( 'type' => 'horizontalBar', 'canvas_id' => 'myChart-3' ) );
     ?>
