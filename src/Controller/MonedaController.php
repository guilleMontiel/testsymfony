<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MonedaController extends AbstractController
{
    /**
     * @Route("/moneda", name="moneda")
     */
    public function index(): Response
    {
        $monedas = $this->monedasDisponibles();
        return $this->render('moneda/index.html.twig', [
            'controller_name' => 'Monedas API Externa',
            'monedas'=> json_decode($monedas,true)
        ]);
    }
    
    
    private function monedasDisponibles(){
        $key = 'b8149ed19d6c71e0549820b9156058fb';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://data.fixer.io/api/symbols?access_key='.$key);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        curl_close($ch);
        
        return $res;
    }
    
    public function convertir(){
         
        $key = 'b8149ed19d6c71e0549820b9156058fb';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://data.fixer.io/api/convert?access_key='.$key.'&from='.$origen.'&to='.$destino.'&amount='.$monto.'&date='.$date);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        curl_close($ch);
        
        echo json_encode($res,true);
    }
}
