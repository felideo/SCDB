<!-- ******CLASSIFICACAO****** -->
<?php include_once '../' . strtolower(APP_NAME) . '/views/front/' . $this->modulo['modulo'] . '/classificacao/classificacao.php'; ?>
<!--//classificacao-->

<!-- ******IMAGE UPLOAD****** -->
<?php include_once '../' . strtolower(APP_NAME) . '/views/front/' . $this->modulo['modulo'] . '/resultado/resultado.php'; ?>
<!--//image upload-->


<script type="text/javascript">













    $(window).scroll(function(){
            if  ($(window).scrollTop() == $(document).height() - $(window).height()){
                  alert('fim');
            }
    });
</script>