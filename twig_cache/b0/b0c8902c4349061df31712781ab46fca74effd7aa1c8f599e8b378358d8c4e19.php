<?php

/* painel_controle/painel_controle.html */
class __TwigTemplate_70c8a12a81bbfa369f4e5d75c0db47ccbca11ad5f4af04182ac335e5429d07bc extends Twig_Template
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
        echo "Dashboard... Logged in Only {cu}

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

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }
}
/* Dashboard... Logged in Only {cu}*/
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
