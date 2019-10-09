<?php 

require_once('../../../../../wp-load.php');


if(isset($_POST['post_types']) && $_POST['post_types'] != ""){

    $all_post_types = $_POST['post_types'];
    


    $options = get_option('tr_modal_option');	
	$get_option_posts= json_decode($options['post_types']);
    
    
    query_posts(array( 
        'post_type' => $all_post_types,
        'showposts' => -1 
    ) );  

    $return_string = '';
    while (have_posts()) : the_post(); 
    
    $return_string .= "<option ". check_if_selected($get_option_posts,get_the_ID()) ." value=".get_the_ID().">".get_the_title()." - ".get_post_type()."</option>";
    endwhile;

    echo $return_string;

}

function check_if_selected($array,$current_id){
    if(isset($array->{$current_id})){
        return "selected";
    }

}