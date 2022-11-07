<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MainController extends AbstractController
{
    private static array $names = [];

    /**
     * @Route("/{page}", methods = ['GET', 'POST'], name="spa", requirements = {"page"="^((?!api/)(?!static/)(?!icon.svg)).*$"})
     */
    public function index(): Response
    {
        $request = Request::createFromGlobals();
        if ($request->getMethod() === 'POST' && $request->request->has('name')) {
            self::$names[] = $request->request->get('name');
        }
        return $this->render('base.html.twig', ['names' => self::$names]);
    }
}