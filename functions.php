//Add in your WP theme functions.php file

//JS Chart scripts
function js_chart_scripts(){
  if ( strpos($_SERVER['REQUEST_URI'], 'school-profile') !== false )  { // only load on school profile pages
       wp_enqueue_script( 'chart', 'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js', array( 'jquery' ) );
    }
}
//Register hook to load scripts
add_action('wp_enqueue_scripts', 'js_chart_scripts'); 
