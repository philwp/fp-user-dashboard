<?php
get_header();

use tcsl\dashboard\Meta;

$member_id  = $_GET['member_id'];
?>
<div class="container">
	<h1>Edit Member</h1>

	<?php echo cmb2_get_metabox_form( Meta::BOX_ID, $member_id ); ?>

	<div>
		<a href="/my-account/">Back to my Account</a>
		<!-- <a id="delete-member" href="#">Delete this Member</a> -->
	</div>

	<script type="text/javascript">
		jQuery(document).ready(function(){
	  		jQuery("[name='submit-cmb']").on('submit', function(){
	  			alert(window.location);

	   			window.location.replace("https://www.tutorialrepublic.com/");
	  		});
	  		jQuery("#delete-member").on('click', function(){
	  			confirm('Are you sure you want to delete this member');
	  		});
		});
	</script>
</div>

<?php
get_footer();
