<!-- ******FOOTER****** -->
    <footer class="footer">
        <div class="container">
            <small class="copyright pull-left">Copyright &copy; 2016 - 2017 <a href="http://felideo.com.br" target="_blank">Felideo Desittale Paravimnce (Diego Pires)</a></small>
            <ul class="links list-inline">
                <li><a href="https://github.com/felideo" target="_blank">Github</a></li>
                <li><a href="http://lattes.cnpq.br/4155283413710538" target="_blank">Lattes</a></li>
            </ul>
        </div>
    </footer><!--//footer-->
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

