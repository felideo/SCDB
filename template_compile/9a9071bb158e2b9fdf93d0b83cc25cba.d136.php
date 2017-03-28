<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><div class="main-nav-wrapper">
    <nav id="main-nav" class="main-nav">
    	<ul id="menu">
			<?php echo $this->scope["sidebar_painel_administrativo"];?>
        </ul>
    </nav>
</div><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>