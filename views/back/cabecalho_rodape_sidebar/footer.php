
                    </div>
                </div>
            </div>
        </div>
     </div>
    <!-- /#wrapper -->
    <script type="text/javascript">
        <?php
            if(isset($_SESSION['alertas'])) {
                echo $_SESSION['alertas'];
            }
        ?>

        limpar_alertas_ajax();
    </script>
</body>


</html>
