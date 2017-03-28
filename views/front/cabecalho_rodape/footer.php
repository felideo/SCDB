<!-- ******FOOTER****** -->
    <footer class="footer">
        <div class="container">
           <!--  <small class="copyright pull-left">Copyright &copy; 2015 <a href="http://themes.3rdwavemedia.com/" target="_blank">3rd Wave Media</a></small>
            <ul class="links list-inline">
                <li><a href="#">Terms</a></li>
                <li><a href="#">Privacy</a></li>
            </ul> -->
        </div>
    </footer><!--//footer-->
    <script type="text/javascript">
        <?php
            if(isset($_SESSION['alertas'])) {
                echo $_SESSION['alertas'];
            }
        ?>
    </script>
</body>
</html>

