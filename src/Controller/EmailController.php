<?php

namespace App\Controller;

use Pimcore\Controller\FrontendController;
use Symfony\Component\HttpFoundation\Response;

class EmailController extends FrontendController
{
    public function emailAction(): Response
    {
        $template = $this->document?->getTemplate() ?:  'email/test-email.html.twig';
        return $this->render($template);
    }
}
