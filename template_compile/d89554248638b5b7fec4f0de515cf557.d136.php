<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><body class="about-page">
    <!-- ******HEADER****** -->
    <header id="header" class="header navbar-fixed-top">
        <div class="container">
            <h1 class="logo">
                <a href="index.html"><span class="logo-icon"></span><span class="text">Velocity</span></a>
            </h1><!--//logo-->
            <nav class="main-nav navbar-right" role="navigation">
                <div class="navbar-header">
                    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button><!--//nav-toggle-->
                </div><!--//navbar-header-->
                <div id="navbar-collapse" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="nav-item"><a href="index.html">Home</a></li>
                        <li class="nav-item"><a href="features.html">Features</a></li>
                        <li class="nav-item"><a href="pricing.html">Pricing</a></li>
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false" href="#">Pages <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="download.html">Download Apps</a></li>
                                <li><a href="blog.html">Blog</a></li>
                                <li><a href="blog-single.html">Blog Single</a></li>
                                <li><a href="blog-category.html">Blog Category</a></li>
                                <li><a href="blog-archive.html">Blog Archive</a></li>
                                <li><a href="about.html">About Us</a></li>
                                <li><a href="contact.html">Contact</a></li>
                            </ul>
                        </li><!--//dropdown-->
                        <li class="nav-item"><a href="login.html">Log in</a></li>
                        <li class="nav-item nav-item-cta last"><a class="btn btn-cta btn-cta-secondary" href="signup.html">Sign Up Free</a></li>
                    </ul><!--//nav-->
                </div><!--//navabr-collapse-->
            </nav><!--//main-nav-->
        </div><!--//container-->
    </header><!--//header-->

    <div class="headline-bg about-headline-bg">
    </div><!--//headline-bg-->

    <!-- ******Video Section****** -->
    <section class="story-section section section-on-bg">
        <h2 class="title container text-center"><?php echo $this->scope["cadastro"]["titulo"];?></h2>
        <div class="story-container container text-center">
            <div class="story-container-inner" >
                <div class="about">
                    <h3 class="title text-center" style="color: #000;">Resumo</h3>
                    <blockquote class="belife"><?php echo $this->scope["cadastro"]["resumo"];?></blockquote>
                </div><!--//about-->
            </div>
        </div>

        <div class="container">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <p>Ano: <?php echo $this->scope["cadastro"]["ano"];?></p>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <p>Curso: <?php echo $this->scope["cadastro"]["curso"]["0"]["curso"];?></p>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <p>Campus: <?php echo $this->scope["cadastro"]["campus"]["0"]["campus"];?></p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <h2 class="title text-center">Nomes Populares</h2>

                        <?php 
$_fh0_data = (isset($this->scope["cadastro"]["trabalho_relaciona_palavra_chave"]) ? $this->scope["cadastro"]["trabalho_relaciona_palavra_chave"]:null);
if ($this->isTraversable($_fh0_data) == true)
{
	foreach ($_fh0_data as $this->scope['palavra_chave'])
	{
/* -- foreach start output */
?>

                            <p><?php echo $this->scope["palavra_chave"]["palavra_chave"]["0"]["palavra_chave"];?></p>
                        <?php 
/* -- foreach end output */
	}
}?>

                    </div>
                </div>

                <div class="team row">
                    <h3 class="title">Autores</h3>
                    <?php 
$_fh1_data = (isset($this->scope["cadastro"]["trabalho_relaciona_autor"]) ? $this->scope["cadastro"]["trabalho_relaciona_autor"]:null);
if ($this->isTraversable($_fh1_data) == true)
{
	foreach ($_fh1_data as $this->scope['autor'])
	{
/* -- foreach start output */
?>

                        <div class="member col-md-4 col-sm-4 col-xs-12">
                            <div class="member-inner">
                                <figure class="profile">
                                    <img class="img-responsive" src="assets/images/team/member-1.png" alt=""/>
                                    <figcaption class="info">
                                        <span class="name"><?php echo $this->scope["autor"]["autor"]["0"]["nome"];?></span>
                                        <br />
                                        <span class="job-title"><?php echo $this->scope["autor"]["autor"]["0"]["email"];?></span>
                                        <br />
                                        <span class="job-title"><?php echo $this->scope["autor"]["autor"]["0"]["link"];?></span>

                                        </figcaption>
                                    </figure><!--//profile-->


                                </div><!--//member-inner-->
                        </div><!--//member-->
                    <?php 
/* -- foreach end output */
	}
}?>

                </div><!--//team-->

            </div>
        </div>







<?php 
$_fh2_data = (isset($this->scope["cadastro"]["trabalho_relaciona_orientador"]) ? $this->scope["cadastro"]["trabalho_relaciona_orientador"]:null);
if ($this->isTraversable($_fh2_data) == true)
{
	foreach ($_fh2_data as $this->scope['orientador'])
	{
/* -- foreach start output */
?>

    <?php echo $this->scope["orientador"]["orientador"]["0"]["nome"];?>

    <?php echo $this->scope["orientador"]["orientador"]["0"]["email"];?>

    <?php echo $this->scope["orientador"]["orientador"]["0"]["link"];?>

<?php 
/* -- foreach end output */
	}
}?>





<?php echo $this->scope["cadastro"]["trabalho_relaciona_arquivo"]["0"]["arquivo"]["0"]["hash"];?>

<?php echo $this->scope["cadastro"]["trabalho_relaciona_arquivo"]["0"]["arquivo"]["0"]["nome"];?>

<?php echo $this->scope["cadastro"]["trabalho_relaciona_arquivo"]["0"]["arquivo"]["0"]["endereco"];?>

<?php echo $this->scope["cadastro"]["trabalho_relaciona_arquivo"]["0"]["arquivo"]["0"]["tamanho"];?>

<?php echo $this->scope["cadastro"]["trabalho_relaciona_arquivo"]["0"]["arquivo"]["0"]["extensao"];?>






                <div class="press-kit text-center">
                    <h3 class="title">Press Kit</h3>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec.</p>
                    <p>Please <a href="contact.html">contact us</a> if you need more materials.</p>
                    <a class="btn btn-cta btn-cta-secondary" href="#">Download Press Kit</a>
                </div><!--//press-kit-->
            </div><!--//story-container-->
        </div><!--//container-->
    </section><!--//story-video-->
<?php  /* end template body */
return $this->buffer . ob_get_clean();
?>