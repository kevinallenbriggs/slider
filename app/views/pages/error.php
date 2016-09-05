<?php
	class ErrorView {
		
		public function __construct() {
			
		}
		
		public static function displayError() {
			echo <<< _EOT
<div class="wrapper row2">
	<div id="container" class="clear">

	    <section id="fof" class="clear">
			<div class="positioned">
	        	<div class="hgroup clear">
	          		<h2>Error - Sorry Something Went Wrong !</h2>
	        	</div>
	        	
	        	<p>Something went wrong when processing your request.</p>
	      	</div>
	      
	      	<p class="clear"><a class="go-back" href="javascript:history.go(-1)">&laquo; Go Back</a> <a class="go-home" href="#">Go Home &raquo;</a></p>
	
	    </section>

  	</div>
</div>
_EOT;
		}
	}