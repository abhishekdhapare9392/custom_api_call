<?php
/**
 * @package custom_api_call
 * @version 1.0.0v
 */
/*
Plugin Name: Custom API Call
Plugin URI: http://wordpress.org/plugins/custom_api_call/
Description: This plugin is can user by only Wordpress Developer. Because this plugin need backend customization. This Plugin developed for call external api and and display the data on front view using a shortcode. To use this plugin user need basic php and wordpress plugin development knowledge.  
Author: Abhishek Dhapare
Version: 1.0.0v
Author URI: http://www.abhishekdhapare.com
*/

function get_api() {

    //send the request to api. You can edit it with your api link this is dummy for understanding.  
    $request = wp_remote_get( 'https://jsonplaceholder.typicode.com/users' );
	
    $body = wp_remote_retrieve_body( $request ); 

    
    
    
    // And then randomly choose a line
    
    return $body;    

}
    

function api_call() {

// this is echo section where we design the front end. How to show your data on page. I make this very simple list view without any css you can use it as per your theme.

    $request = get_api();


    echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="cs_alerts"></div>	
    <div class="main-cs-loader"></div>
    <div id="fade429108" class="black_overlay"></div>
    <!-- end popup -->
    <div class="cs-jobs-container">
        <div class="hiring-holder  custom-styling-list">
            <div class="your-search" style="display: none;">
        </div>
        <div class="row">
           <ul class="jobs-listing fancy">';
           
        $data = $request;
        $test[] = json_decode($data);
        

                $data1 = (array)$test[0];
                

                $data2 = $data1;
                
                for($i = 0; $i<= 9; $i++){
                    $data3 = (array)$data2[$i];
                    $data4 = (array)$data3["address"];
                    $data5 = (array)$data3["company"]; 
                    
                    echo '
                                        <li class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <div>
                                                <div>
                                                    <div>
                                                        <h3><a href="#">'. $data3["name"] .'</a></h3>
                                                    </div>
                                                    <div class="post-options">
                                                        <span>Username:'. $data3["username"] .'</span><br/>
                                                        <span>City: '. $data4["city"].', '.$data4["zipcode"].'  </span><br/>
                                                        <span>Phone: '. $data3["phone"] .'</span><br />
                                                        <span>Phone: '. $data3["website"] .'</span>
                                                    </div>
                                                </div>
                                                <div>
                                                    <span>Company Name: ' . $data5["name"] . '</span><br />
                                                    <span>Company Name: ' . $data5["catchPhrase"] . '</span> <br />
                                                </div>
                                            </div>
                                        </li>';
                }

      echo '
      </ul>
  </div>
</div>          
</div>
</div>';    
    
    
}

// Now we set that function up to execute when the admin_notices action is called
//add_action( 'admin_notices', 'api_call' );

// We need some CSS to position the paragraph
function api_css() {
	// This makes sure that the positioning is also good for right-to-left languages
	$x = is_rtl() ? 'left' : 'right';

	echo "
	<style type='text/css'>
	#dolly {
		float: $x;
		padding-$x: 15px;
		padding-top: 5px;		
		margin: 0;
		font-size: 11px;
	}
	</style>
	";
}
add_shortcode('data_list_view', 'api_call');

// On editor write the shortcode as following: [data_list_view] and you can see the data on page.

add_action( 'admin_head', 'api_css' );

?>