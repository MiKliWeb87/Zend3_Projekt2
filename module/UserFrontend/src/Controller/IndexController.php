<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author 	 	 	   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			   https://github.com/MiKliWeb87/Zend3_Projekt2  * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace UserFrontend\Controller;

use UserFrontend\Form\UserEditFormInterface;
use UserModel\Entity\UserEntity;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Class IndexController
 *
 * @package UserFrontend\Controller
 * @method UserEntity|null identity()
 */
class IndexController extends AbstractActionController
{
    /**
     * @var UserEditFormInterface
     */
    private $userForm;

    /**
     * @param UserEditFormInterface $userForm
     */
    public function setUserForm($userForm)
    {
        $this->userForm = $userForm;
    }

    /**
     * Show user intro
     *
     * @return ViewModel
     */
    public function indexAction()
    {
        if ($this->identity()) {
            $this->userForm->bind($this->identity());
        }

        $viewModel = new ViewModel();

        return $viewModel;
    }
}
