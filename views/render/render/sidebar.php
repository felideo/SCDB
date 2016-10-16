<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="index.html"><?php echo APP_NAME; ?></a>
	</div>
	<!-- /.navbar-header -->

	<ul class="nav navbar-top-links navbar-right">
		<!-- /.dropdown -->
		<li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#">
				<i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
			</a>
			<ul class="dropdown-menu dropdown-user">
				<li>
					<a href="#">
						<i class="fa fa-user fa-fw"></i>
						User Profile
					</a>
				</li>
				<li class="divider"></li>
				<li><a href="<?php echo URL; ?>master/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
				</li>
			</ul>
			<!-- /.dropdown-user -->
		</li>
		<!-- /.dropdown -->
	</ul>
	<!-- /.navbar-top-links -->

	<div class="navbar-default sidebar" role="navigation">
		<div class="sidebar-nav navbar-collapse">
			<ul class="nav" id="side-menu">
				<li>
					<a href="<?php echo URL; ?>painel_controle"><i class="fa fa-dashboard fa-fw"></i>
						Painel de Controle
        			</a>
				</li>


					<?php foreach ($_SESSION['menus'] as $indice_01 => $menu) : ?>
	 					<?php if($_SESSION['usuario']['hierarquia'] <= $menu[0]['hierarquia']) : ?>
							<li>
								<?php if(count($menu) == 1) : ?>
	 								<a href="<?php echo URL . $menu[0]['modulo']; ?>">
	 									<i class="fa <?php echo $menu[0]['icone']; ?> fa-fw"></i>
	 									<?php echo !empty($menu[0]['submenu']) ? $menu[0]['submenu'] : $menu[0]['nome']; ?>
	 		            			</a>
	 							<?php else : ?>
	 								<a href="#">
	 									<span class="fa arrow"></span>
	 									<i class="fa <?php echo $menu[0]['icone']; ?> fa-fw"></i>
	 									<?php echo !empty($menu[0]['submenu']) ? $menu[0]['submenu'] : $menu[0]['nome']; ?>
	 		            			</a>
	 							<?php endif ?>
	 	            			<?php if(count($menu) > 1) : ?>
	 	            				<ul class="nav nav-second-level collapse" aria-expanded="false" style="height: 0px;">
	 	            					<?php foreach ($menu as $indice_02 => $submenu) : ?>
	 	            						<?php if($_SESSION['usuario']['hierarquia'] <= $submenu['hierarquia']) : ?>
		 	                        			<li>
		 	                            			<a href="<?php echo URL . $submenu['modulo']; ?>">
		 	                            				<i class="fa <?php echo $submenu['icone']; ?> fa-fw"></i>
		 	                            				<?php echo $submenu['nome']; ?>
		 	                            			</a>
		 	                        			</li>
	 										<?php endif ?>
	 									<?php endforeach ?>
	                                 </ul>
	 							<?php endif ?>
 							</li>
						<?php endif ?>

				<?php endforeach ?>
			</ul>
		</div>
		<!-- /.sidebar-collapse -->
	</div>
	<!-- /.navbar-static-side -->
</nav>
