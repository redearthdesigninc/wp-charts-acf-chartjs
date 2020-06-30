<?php
//Add this new file to your theme folder, inside an inc/ folder. 

/* Helper Functions */
function get_chart_background_colors( $data_segment_array ) {
  $background_color_array = array();
  foreach( $data_segment_array as $data_segment ) {
    switch ( $data_segment ) {
      case 'ALL':
        $background_color_array[] = '#5dc5c4';
        break;
      case 'FRL':
        $background_color_array[] = '#5dc5c4';
        break;
      case 'AMI':
        $background_color_array[] = '#50bc81';
        break;
      case 'ASI':
        $background_color_array[] = '#f7e3d6';
        break;
      case 'BLK':
        $background_color_array[] = '#f9d978';
        break;
      case 'HIS':
        $background_color_array[] = '#eab28b';
        break;
      case 'WHT':
        $background_color_array[] = '#8797ae';
        break;
      case 'HPI':
        $background_color_array[] = '#dbe1f1';
        break;
      case 'MLT':
        $background_color_array[] = '#4276b1';
        break;
    }
  }
  return $background_color_array;
}

function add_quotes_to_array_items( $arr ) {
  $return_arr = array();
  foreach ( $arr as $item ) {
    $return_arr[] = '"' . $item . '"';
  }
  return $return_arr;
}

/**
* Data
*/

/* Also can be used for Grad Rate and MCA Proficiency */
function red_get_demographic_data( $data_type = 'demographics_data_points' ) {
   $data = array(
     // 'data_points_array' => array(),
     // 'data_segment_array' => array(),
     // 'background_color_array' => array()
   );
   if ( have_rows( $data_type, $post_id ) ):
     while ( have_rows( $data_type, $post_id ) ) : the_row();
       $data_points_array[] = get_sub_field('data_point');
       $data_segment_array[] = get_sub_field( 'data_segment' );
     endwhile;
       $background_color_array = get_chart_background_colors( $data_segment_array ); // Get background colors based on data segment values

       // Format Data Points
       $data_points_array = implode( ', ', $data_points_array );
       $data_points_array = rtrim( $data_points_array, ', ' );
       $data['data_points_array'] = $data_points_array;

      // Format Data Segment
       $data_segment_array = add_quotes_to_array_items( $data_segment_array );
       $data_segment_array = implode( ', ', $data_segment_array );
       $data_segment_array = rtrim( $data_segment_array, ', ' );
       $data['data_segment_array'] = $data_segment_array;

       // Format Background Color
       $background_color_array = add_quotes_to_array_items( $background_color_array );
       $background_color_array = implode( ', ', $background_color_array );
       $background_color_array = rtrim( $background_color_array, ', ' );
       $data['background_color_array'] = $background_color_array;
    endif;
    return $data;
}
/**
* Display Chart
*/
  function red_display_chart( $data = array(), $options = array(), $post_id = null ) {
    // Bail early if no data
    if ( empty( $data ) ) {
      return;
    }

   // Option defaults
    $options = wp_parse_args( $options, array(
      'type' => 'doughnut',
      'chart_label' => '', //Demographics
      'canvas_id' => 'myChart'
    ) );

    if ( $post_id === null ) {
      global $post;
      $post_id = $post->ID;
    }
    ?>

  <canvas id="<?php echo $options['canvas_id']; ?>" width="200" height="200"></canvas>
  <script>

// DATA HERE
  var ctx = document.getElementById('<?php echo $options['canvas_id']; ?>');
  var myChart = new Chart(ctx, {
      type: '<?php echo $options['type']; ?>',
      data: {
          labels: [<?php echo $data['data_segment_array']; ?>],
          datasets: [{
              label: '<?php echo $options['chart_label']; ?>',
              data: [<?php echo $data['data_points_array']; ?>],
              backgroundColor: [<?php echo $data['background_color_array']; ?>],
              borderWidth: 0
          }]
      },
      //https://www.chartjs.org/docs/latest/configuration/legend.html
      options: {
             // Boolean - Omit x-axis labels
        scales: {
          xAxes: [{
              display:false, //hide X-axis label
          }],
          yAxes: [{
              display:false, //hide Y-axis label
              gridLines: {
                  display:false, //remove Y-axis lines from chart
                  drawBorder: false //remove main y-axis line
              }
         }]
        },
        responsive: true,
        legend: {
          display: false,
        },
      }
  });
  </script>
<?php }
