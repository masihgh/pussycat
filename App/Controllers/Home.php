<?php

namespace App\Controllers;

use Core\View;
/*Import Model To Use
use App\Models\User;
*/


/**
 * Home controller
 * Action name starts with action
 * actionindex = index Action
 */
class Home extends \Core\Controller
{

    /**
     * Show the index page
     *
     * @return void
     */
    public function actionindex()
    {
        View::renderTemplate('welcome-to-pussy-cat.html');
    }
	
}
