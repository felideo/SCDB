<?php

/* painel_controle/painel_controle.php */
class __TwigTemplate_d6b70e466338703ba944184080708708c352d75714a09ca90badc5002f6c9f3f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "Dashboard... Logged in Only

<br>

<form id=\"randomInsert\" action=\"<?php echo URL; ?>dashboard/xhrInsert\" method=\"post\">
\t<input type=\"text\" name=\"text\">
\t<input type=\"submit\">
</form>

<br>

<div id=\"listInserts\"></div>";
    }

    public function getTemplateName()
    {
        return "painel_controle/painel_controle.php";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }
}
/* Dashboard... Logged in Only*/
/* */
/* <br>*/
/* */
/* <form id="randomInsert" action="<?php echo URL; ?>dashboard/xhrInsert" method="post">*/
/* 	<input type="text" name="text">*/
/* 	<input type="submit">*/
/* </form>*/
/* */
/* <br>*/
/* */
/* <div id="listInserts"></div>*/
