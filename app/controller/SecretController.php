<?php
namespace BB\Controller;

use BB\Model\Secret;

class SecretController
{
    public function index() 
    {
        $Secret = new Secret();

        $Secret->SecretStat();
        
    }
    


}

