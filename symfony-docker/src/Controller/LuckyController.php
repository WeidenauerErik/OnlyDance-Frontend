<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LuckyController extends AbstractController
{
    #[Route('/lucky/number/{max}', name: 'app_lucky_number')]
    public function number(int $max): Response
    {
        $number = random_int(0, $max);

        return new Response(
            '<html><body>Lucky beidl: '.$number.'</body></html>'
        );
    }

    #[Route('/lucky/{string}', name: 'app_redirect')]
    public function index(string $string): RedirectResponse
    {
        if(strlen($string) > 4){
            //return $this->redirectToRoute("app_lucky_number",["max" => 69]);
            return $this->redirectToRoute('app_lucky_number', ['max' => 10]);
        }
        return $this->redirect('https://www.youtube.com/watch?v=ojKX20galcE)');
    }
}
