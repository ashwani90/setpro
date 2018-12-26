<?php
/**
 * Created by PhpStorm.
 * User: mindfire
 * Date: 25/12/18
 * Time: 3:16 PM
 */

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\Translation\TranslatorInterface;

class Test extends Controller
{
    /**
     * @Route("/getTest")
     */
    public function testAction()
    {
        $translator = $this->container->get('translator');
        dump($translator->trans('message_1'));die;
        return new Response("Hello");
    }
}