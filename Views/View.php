<?php

namespace Views;

class View
{

    private $templatesPath = __DIR__ . '/../Resources';

    public function renderHtml(string $templateName, array $vars,int $code = 200)
    {
        http_response_code($code);
        extract($vars);
        ob_start();         
        include $this->templatesPath.$templateName;
        $buffer = ob_get_contents();
        ob_end_clean();

        echo $buffer;
    }
}
