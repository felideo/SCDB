<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?>		<script type="text/javascript">
		    <?php
		        if(isset($_SESSION['alertas'])) {
		            echo $_SESSION['alertas'];
		        }
		    ?>

		    $(window).load(function(){
		    	limpar_alertas_ajax();
		    });

		</script>
	</body>
</html><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>