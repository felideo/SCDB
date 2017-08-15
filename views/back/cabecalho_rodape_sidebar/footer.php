
                    </div>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; text-align: center;">
            <div class="container">
                <small class="copyright pull-left">Copyright © 2016 - 2017 <a href="http://felideo.com.br" target="_blank">Felideo Desittale Paravimnce (Diego Pires)</a> - <a href="https://github.com/felideo" target="_blank">Github</a> - <a href="http://lattes.cnpq.br/4155283413710538" target="_blank">Lattes</a>

                </small>
            </div>
        </nav>
     </div>
    <!-- /#wrapper -->
    <script type="text/javascript">
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


</html>
