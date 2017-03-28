<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?>

<body class="home-page">
    <!-- ******HEADER****** -->
    <header id="header" class="header navbar-fixed-top">
        <div class="container">
            <h1 class="logo">
                <a href="index.html"><span class="text">Velocity</span></a>
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
                        <li class="active nav-item"><a href="index.html">Home</a></li>
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

    <div class="bg-slider-wrapper">
        <div class="flexslider bg-slider">
            <ul class="slides">
                <li class="slide slide-1"></li>
                <li class="slide slide-2"></li>
                <li class="slide slide-3"></li>
            </ul>
        </div>
    </div><!--//bg-slider-wrapper-->

    <section class="promo section section-on-bg">
        <div class="container text-center">
            <h2 class="title">Let's get your product online fast<br />and get attention right away!</h2>
            <p class="intro">Velocity is a mobile-friendly HTML5 template designed to help you <br /> promote your product effectively to your target users</p>
            <p><a class="btn btn-cta btn-cta-primary" href="signup.html">Try Velocity Free</a></p>
            <button type="button" class="play-trigger btn-link " data-toggle="modal" data-target="#modal-video" ><i class="fa fa-youtube-play"></i> Watch the video</button>
        </div><!--//container-->
    </section><!--//promo-->

    <div class="sections-wrapper">

        <!-- ******Why Section****** -->
        <section id="why" class="section why">
            <div class="container">
                <h2 class="title text-center">How Can Velocity Help You?</h2>
                <p class="intro text-center">We take care of the UX and front-end design so you can save time building your site</p>
                <div class="row item">
                    <div class="content col-xs-12 col-md-4">
                        <h3 class="title">Save you time and effort</h3>
                        <div class="desc">
                            <p>Explain one of your product benefits here. Let users know how they can benefit using your product. It’s also a good idea to back it up with a testimonial or tweet from your users.</p>
                            <p>The original PSD of the graphic is included in the package. You can easily customise the PSD to meet your needs.</p>
                        </div>
                        <div class="quote">
                            <div class="quote-profile">
                                <img class="img-responsive img-circle" src="/public/front/images/people/profile-s-1.png" alt="" />
                            </div><!--//profile-->
                            <div class="quote-content">
                                <blockquote><p><a href="https://twitter.com/3rdwave_themes" target="_blank">@velocity</a> Love it! Thank you for making my life easier and saving me time! I’ll definitely recommend it to my friends. :)</p></blockquote>
                                <p class="source">@LisaW, Bristol</p>
                            </div><!--//quote-content-->
                        </div><!--//quote-->
                    </div><!--//content-->
                    <figure class="figure col-md-offset-1 col-sm-offset-0 col-xs-offset-0 col-xs-12 col-md-7">
                        <img class="img-responsive" src="/public/front/images/figures/figure-1.png" alt="" />
                        <figcaption class="figure-caption">(Screenshot: Coral - App &amp; website startup kit) </figcaption>
                    </figure>
                </div><!--//item-->

                <div class="row item">
                    <div class="content col-md-push-8 col-sm-push-0 col-xs-push-0 col-xs-12 col-md-4">
                        <h3 class="title">Works across all devices</h3>
                        <div class="desc">
                            <p>Explain one of your product benefits here. Let users know how they can benefit using your product. It’s also a good idea to back it up with a testimonial or tweet from your users.</p>
                            <p>The original PSD of the graphic is included in the package. You can easily customise the PSD to meet your needs.</p>
                            <p><i class="fa fa-download"></i> <a href="download.html">Download mobile versions</a></p>
                        </div>

                        <div class="quote">
                            <div class="quote-profile">
                                <img class="img-responsive img-circle" src="/public/front/images/people/profile-s-2.png" alt="" />
                            </div><!--//profile-->
                            <div class="quote-content">
                                <blockquote><p>I find the mobile app very useful when I'm on the go. Sed ut perspiciatis unde omnis iste natus error sit voluptatem </p></blockquote>
                                <p class="source">@JackT, San Francisco</p>
                            </div><!--//quote-content-->
                        </div><!--//quote-->
                    </div><!--//content-->
                    <figure class="figure col-md-pull-4 col-sm-pull-0 col-xs-pull-0 col-xs-12 col-md-7">
                        <img class="img-responsive" src="/public/front/images/figures/figure-2.png" alt="" />
                        <div class="control text-center">
                            <button type="button" class="play-trigger" data-toggle="modal" data-target="#modal-video"><i class="fa fa-play"></i></button>
                        </div><!--//control-->
                    </figure>
                </div><!--//item-->

                <div class="row item ">
                    <div class="content col-xs-12 col-md-4">
                        <h3 class="title">Easy to customise</h3>
                        <div class="desc">
                            <p>Explain one of your product benefits here. Let users know how they can benefit using your product. It’s also a good idea to back it up with a testimonial or tweet from your users.</p>
                            <p>The original PSD of the graphic is included in the package. You can easily customise the PSD to meet your needs.</p>
                        </div>
                        <div class="quote">
                            <div class="quote-profile">
                                <img class="img-responsive img-circle" src="/public/front/images/people/profile-s-3.png" alt="" />
                            </div><!--//profile-->
                            <div class="quote-content">
                                <blockquote><p>Nice template! It’s practical and there is no gimmicks. Very easy to customise as well!</p></blockquote>
                                <p class="source"><a href="#">@AlexD</a>, London</p>
                            </div><!--//quote-content-->
                        </div><!--//quote-->
                    </div><!--//content-->
                    <figure class="figure col-md-offset-1 col-sm-offset-0 col-xs-offset-0 col-xs-12 col-md-7">
                        <img class="img-responsive" src="/public/front/images/figures/figure-3.png" alt="" />
                        <figcaption class="figure-caption">(Screenshot: <a href="http://themes.3rdwavemedia.com/website-templates/responsive-bootstrap-theme-for-startups-tempo/?ref=3wm" target="_blank">Tempo - Bootstrap template for startups)</a> </figcaption>

                    </figure>
                </div><!--//item-->

                <div class="row item last-item">
                    <div class="content col-md-push-8 col-sm-push-0 col-xs-push-0 col-xs-12 col-md-4">
                        <h3 class="title">Connect your users</h3>
                        <div class="desc">
                            <p>Explain one of your product benefits here. Let users know how they can benefit using your product. It’s also a good idea to back it up with a testimonial or tweet from your users.</p>
                            <p>The original PSD of the graphic is included in the package. You can easily customise the PSD to meet your needs.</p>

                        </div>

                        <div class="quote">
                            <div class="quote-profile">
                                <img class="img-responsive img-circle" src="/public/front/images/people/profile-s-4.png" alt="" />
                            </div><!--//profile-->
                            <div class="quote-content">
                                <blockquote><p>I can connect to like-minded people lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p></blockquote>
                                <p class="source">@JackT, San Francisco</p>
                            </div><!--//quote-content-->
                        </div><!--//quote-->
                    </div><!--//content-->
                    <figure class="figure col-md-pull-4 col-sm-pull-0 col-xs-pull-0 col-xs-12 col-md-7">
                        <img class="img-responsive" src="/public/front/images/figures/figure-4.png" alt="" />
                    </figure>
                </div><!--//item-->


                <div class="feature-lead text-center">
                    <h4 class="title">Want to discover all the features?</h4>
                    <p><a class="btn btn-cta btn-cta-secondary" href="features.html">Take a Tour</a></p>
                </div>
            </div><!--//container-->
        </section><!--//why-->

        <!-- ******Testimonials Section****** -->
        <section class="section testimonials">
            <div class="container">
                <h2 class="title text-center">What are people saying about Velocity?</h2>
                <div id="testimonials-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#testimonials-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#testimonials-carousel" data-slide-to="1"></li>
                        <li data-target="#testimonials-carousel" data-slide-to="2"></li>
                    </ol><!--//carousel-indicators-->
                    <div class="carousel-inner">
                        <div class="item active">
                            <figure class="profile"><img src="/public/front/images/people/profile-m-1.png" alt="" /></figure>
                            <div class="content">
                                <blockquote>
                                <i class="fa fa-quote-left"></i>
                                <p>We used Velocity as a front-end design template for our product site. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum elit tortor, consectetur vitae varius at, interdum eget libero. Morbi.</p>
                                </blockquote>
                                <p class="source">Kevin Knight<br /><span class="title">Co-Founder, Startup Hub</span></p>
                            </div><!--//content-->
                        </div><!--//item-->
                        <div class="item">
                            <figure class="profile"><img src="/public/front/images/people/profile-m-2.png" alt="" /></figure>
                            <div class="content">
                                <blockquote>
                                <i class="fa fa-quote-left"></i>
                                <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint.</p>
                                </blockquote>
                                <p class="source">Diana	Luna<br /><span class="title">Entrepreneur, Maecenas</span></p>
                            </div><!--//content-->
                        </div><!--//item-->
                        <div class="item">
                            <figure class="profile"><img src="/public/front/images/people/profile-m-3.png" alt="" /></figure>
                            <div class="content">
                                <blockquote>
                                <i class="fa fa-quote-left"></i>
                                <p>Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere.</p>
                                </blockquote>
                                <p class="source">Tony Lee<br /><span class="title">CTO, Lorem Ipsum</span></p>
                            </div><!--//content-->
                        </div><!--//item-->
                    </div><!--//carousel-inner-->

                </div><!--//carousel-->
            </div><!--//container-->
        </section><!--//testimonials-->

        <!-- ******Press Section****** -->
        <section class="section press">
            <div class="container text-center">
                <h2 class="title">Press Coverage</h2>
                <ul class="press-list list-inline row">
                    <li class="col-xs-4 col-sm-2"><a href="#"><img class="img-responsive" src="/public/front/images/press/press-1.png" alt="" /></a></li>
                    <li class="col-xs-4 col-sm-2"><a href="#"><img class="img-responsive" src="/public/front/images/press/press-2.png" alt="" /></a></li>
                    <li class="xs-break col-xs-4 col-sm-2"><a href="#"><img class="img-responsive" src="/public/front/images/press/press-3.png" alt="" /></a></li>
                    <li class="col-xs-4 col-sm-2"><a href="#"><img class="img-responsive" src="/public/front/images/press/press-4.png" alt="" /></a></li>
                    <li class="col-xs-4 col-sm-2"><a href="#"><img class="img-responsive" src="/public/front/images/press/press-5.png" alt="" /></a></li>
                    <li class="col-xs-4 col-sm-2"><a href="#"><img class="img-responsive" src="/public/front/images/press/press-6.png" alt="" /></a></li>
                </ul><!--//press-list-->
                <ul class="press-list list-inline row last">
                    <li class="col-xs-4 col-sm-2"><a href="#"><img class="img-responsive" src="/public/front/images/press/press-7.png" alt="" /></a></li>
                    <li class="col-xs-4 col-sm-2"><a href="#"><img class="img-responsive" src="/public/front/images/press/press-8.png" alt="" /></a></li>
                    <li class="xs-break col-xs-4 col-sm-2"><a href="#"><img class="img-responsive" src="/public/front/images/press/press-9.png" alt="" /></a></li>
                    <li class="col-xs-4 col-sm-2"><a href="#"><img class="img-responsive" src="/public/front/images/press/press-10.png" alt="" /></a></li>
                    <li class="col-xs-4 col-sm-2"><a href="#"><img class="img-responsive" src="/public/front/images/press/press-11.png" alt="" /></a></li>
                    <li class="col-xs-4 col-sm-2"><a href="#"><img class="img-responsive" src="/public/front/images/press/press-12.png" alt="" /></a></li>
                </ul><!--//press-list-->

                <div class="press-lead text-center">
                     <h3 class="title">Have press inquires?</h3>
                     <p class="press-links"><a href="#">Download our press kit</a> or <a href="contact.html">Get in touch</a></p>
                </div>

            </div><!--//container-->
        </section><!--//press-->

        <!-- ******CTA Section****** -->
        <section id="cta-section" class="section cta-section text-center home-cta-section">
            <div class="container">
               <h2 class="title">Ready to promote your product online?</h2>
               <p class="intro">More than <span class="counting">300,000</span> users are using Velocity</p>
               <p><a class="btn btn-cta btn-cta-primary" href="https://wrapbootstrap.com/theme/velocity-designed-for-products-WB0N38R04" target="_blank">Get Velocity Now</a></p>
            </div><!--//container-->
        </section><!--//cta-section-->

    </div><!--//section-wrapper-->
<?php  /* end template body */
return $this->buffer . ob_get_clean();
?>