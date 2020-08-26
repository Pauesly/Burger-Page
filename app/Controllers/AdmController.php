<?php

namespace App\Controllers;

use Core\BaseController;
use Core\Redirect;
use Core\Validator;
use App\Models\Email;

class AdmController extends BaseController
{
    
    private $dados;

    private $email;

    public function __construct()
    {
        parent::__construct();
       // $this->email = new Email;
    }
    


    
    public function loginAdm(){
        $this->setPageTitle('LOGIN');
        $this->renderView('adm/login/index');
    }
    
    
    
    
    
}