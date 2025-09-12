<?php

namespace App\Controller;

use Pimcore\Controller\FrontendController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EmailController extends FrontendController
{
    public function emailAction(Request $request): Response
    {
        $doc = $this->document;
        $template = '/email/test-email.html.twig';

        if (isset($doc) && $doc->getTemplate() != null) {
            $template = $doc->getTemplate();
        }
        return $this->render($template, [
            'editmode' => $this->editmode,
            'document' => $this->document,
            'body' => $request->attributes->has('body') ? $request->attributes->get('body') : null
        ]);
    }
}
