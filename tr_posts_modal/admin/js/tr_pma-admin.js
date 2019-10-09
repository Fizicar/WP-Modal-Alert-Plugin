(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	$(document).ready(function(){
		$('#posts_select').select2({
			placeholder: "Choose post type"
		});

		$('.all_post_types').on('change',function(){

			let post_type_ajax = [];
			let all_post_types = $('.all_post_types');

			$.each(all_post_types, function( index, value ) {
				if($(this).is(':checked')){
					post_type_ajax.push($(this).attr('data-name'));
				}
			});

			
			$.ajax({
			method: "POST",
			url: "../wp-content/plugins/tr_posts_modal/admin/includes/get_all_posts.php",
			data: { "post_types" : post_type_ajax }
			})
			.done(function( msg ) {
				$('#posts_select').html(msg);
				$('#posts_select').select2({
					placeholder: "Choose Posts"
				});
			});
		})

		$('#posts_select').on('change',function(){
			

		})

		$('#submit').on('click', function(){
			let final_posts = $('#posts_select').val();
			let final_object = {};

			$.each(final_posts, function( index, value ) {
				final_object[value] = value;
			});
			
			
			$('#post_types').val(JSON.stringify(final_object));
		})

	})

})( jQuery );
