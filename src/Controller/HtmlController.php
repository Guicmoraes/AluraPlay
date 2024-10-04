<?php 
namespace Gui\AluraPlay\Controller;

abstract class HtmlController{
    private const TEMPLATE_PATH = __DIR__.'/../../templates/';
    protected function renderTemplate(string $templateName,array $context=[]): string
    {
        extract($context);
        ob_start();
        require_once self::TEMPLATE_PATH.$templateName.'.php';
        return ob_get_clean();
    }
}



?>