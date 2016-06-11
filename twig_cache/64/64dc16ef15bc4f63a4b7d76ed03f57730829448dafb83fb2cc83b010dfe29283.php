<?php

/* painel_controle/painel_controle.html */
class __TwigTemplate_51d26642466c64674473e4f751c9318816c13ddd7201bb064fa61c34cb4309ae extends Twig_Template
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
        echo "Dashboard... Logged in Only ";
        echo twig_escape_filter($this->env, (isset($context["cu"]) ? $context["cu"] : null), "html", null, true);
        echo "

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
        return "painel_controle/painel_controle.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }
}
/* Dashboard... Logged in Only {{cu}}*/
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
