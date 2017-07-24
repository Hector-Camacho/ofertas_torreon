<?php
return array(
	"base_url"=>"https://www.ofertastorreon.mx/fbauth/auth",
	"providers"=>array(
		"Facebook"=>array(
			"enabled"=>TRUE,
			"trustForwarded" => true, 
			"allowSignedRequest" => false, 
			"keys"=>array("id"=>"884000378351637", "secret"=>"c17a11054168b952aa005b5a463667da"),
			"scope"=>"public_profile, email, publish_actions",
			"display"=>"page"
			)
		)
	);