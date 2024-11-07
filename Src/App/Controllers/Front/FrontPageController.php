<?php 

namespace Src\App\Controllers\Front;

use Src\Core\Controller;

class FrontPageController extends Controller
{
    public function index()
    {
        return $this->view('views/index.php');
    }
}
