<?php
namespace BB\Controller;

use BB\Model\Offer;

class OfferController
{
    public function index() 
    {
        $Offer = new Offer();
        
        $Offer->ip();
        $Offer->bc();
        $Offer->ml();
        $Offer->herbahaz();/*
        $Offer->herbahaz_list();*/
        
        die('oké');
    }
    


}

