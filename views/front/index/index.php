    <!-- ******PROMO****** -->
    <!-- <section id="promo" class="promo leaf section offset-header has-pattern"> -->
    <section id="promo" class="promo leaf section offset-header has-pattern">
        <div class="container">
            <div class="row">
                <div class="overview col-md-8 col-sm-12 col-xs-12" style="background-color: rgba(0, 0, 0, 0.5); border-radius: 15px;">
                    <h2 class="title">Banco de Dados Taxonomico</h2>
                    <ul class="summary">
                        <li>Cadastres Plantas</li>
                        <li>Busque por Trabalhos Cientificos</li>
                        <li>Envie Seus Trabalhos</li>
                        <li>Compartilhe Seus Estudos com a Comunidade</li>
                    </ul>
                    <!-- <div class="download-area"> -->
                        <!-- <ul class="btn-group list-inline">
                            <li class="ios-btn"><a href="#">Download from the App Store</a></li>
                            <li class="android-btn"><a href="#">Get it from Google Play</a></li>
                        </ul>
                        <div class="note text-center">
                            <p>30% OFF - Now only $0.99<br />Offer ends 31st March</p>
                            <span class="left-arrow"></span>
                            <span class="right-arrow"></span>
                        </div><!--//note-->
                    <!-- </div> -->
                </div><!--//overview-->

                <!--// iPhone starts -->
                <div class="phone iphone iphone-black col-md-4 col-sm-12 col-xs-12 " style="height: 305px;">
                    <div class="iphone-holder phone-holder">
                        <div class="iphone-holder-inner">
                            <div class="slider flexslider">
                                <ul class="slides">
                                    <?php
                                        if(isset($this->imagens[0]) && !empty($this->imagens[0])){
                                            foreach ($this->imagens as $indice => $imagem){
                                                echo "<li><img src='/{$imagem['arquivo'][0]['endereco']}'  alt='' /></li>";
                                            }
                                        }
                                    ?>
                                </ul><!--//slides-->
                            </div><!--//flexslider-->
                        </div><!--//iphone-holder-inner-->
                    </div><!--//iphone-holder-->
                </div><!--//iphone-->
                <!--// iPhone ends -->
            </div><!--//row-->
        </div><!--//container-->
    </section><!--//promo-->

    <!-- ******FEATURES****** -->
    <section id="features" class="features section">
        <div class="container">
            <div class="row">
                <!-- <h2 class="title text-center sr-only">Features</h2> -->
                <div class="item col-md-3 col-sm-6 col-xs-12 text-center">
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div><!--//icon-->
                    <div class="content">
                        <h3 class="title">Colabore</h3>
                        <p>Ambiente colaborativo para biologos, taxonomistas, estudantes</p>
                    </div><!--//content-->
                </div><!--//item-->
                <div class="item col-md-3 col-sm-6 col-xs-12 text-center">
                    <div class="icon">
                        <i class="fa fa-plus-circle"></i>
                    </div><!--//icon-->
                    <div class="content">
                        <h3 class="title">Cadastre</h3>
                        <p>Insira novas especies no banco de dados, sua taxonomia, locais de ocorrencia e muito mais</p>
                    </div><!--//content-->
                </div><!--//item-->
                <div class="item col-md-3 col-sm-6 col-xs-12 text-center">
                    <div class="icon">
                        <i class="fa fa-share-alt"></i>
                    </div><!--//icon-->
                    <div class="content">
                        <h3 class="title">Compartilhe</h3>
                        <p>Relacione trabalhos cientificos, artigos e links a planta e dissemine o conhecimento</p>
                    </div><!--//content-->
                </div><!--//item-->
                <div class="item col-md-3 col-sm-6 col-xs-12 text-center">
                    <div class="icon">
                        <i class="fa fa-search"></i>
                    </div><!--//icon-->
                    <div class="content">
                        <h3 class="title">Busque</h3>
                        <p>Consulte taxonomias, busque por especies, localize trabalhos relacionados</p>
                    </div><!--//content-->
                </div><!--//item-->
            </div><!--//row-->


        </div><!--//container-->
    </section><!--//features-->

    <!-- ******APOIO****** -->
    <section id="pricing" class="pricing section has-pattern">
        <div class="container">
             <div class="price-cols row">
                <h2 class="title text-center">Apoio</h2>
                <div class="items-wrapper col-md-10 col-sm-12 col-xs-12 col-md-offset-1 col-sm-offset-0 col-xs-offset-0">
                    <div class="item price-1 col-md-4 col-sm-4 col-xs-12 text-center">
                        <div class="item-inner">
                            <img src="../../../public/images/umc.jpg">
                        </div><!--//item-inner-->
                    </div><!--//item-->

                    <div class="item price-2 col-md-4 col-sm-4 col-xs-12 text-center best-buy">
                        <div class="item-inner">
                            <img src="../../../public/images/biosenselab.png" style="margin-top: 23%;">
                        </div><!--//item-inner-->
                    </div><!--//item-->

                    <div class="item price-3 col-md-4 col-sm-4 col-xs-12 text-center">
                        <div class="item-inner">
                            <img src="../../../public/images/faep.jpg">
                        </div><!--//item-inner-->
                    </div><!--//item-->
                </div><!--//items-wrapper-->
            </div><!--//row-->
        </div><!--//container-->
    </section><!--//apoio-->
