<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author 	 	 	   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			   https://github.com/MiKliWeb87/Zend3_Projekt2  * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace UserBackend\Controller;

use UserModel\Repository\UserRepositoryInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Class DisplayController
 *
 * @package UserBackend\Controller
 */
class DisplayController extends AbstractActionController
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function setUserRepository($userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Show user list
     *
     * @return ViewModel
     */
    public function indexAction()
    {
        $page = $this->params()->fromRoute('page', 1);

        $userList = $this->userRepository->getUsersByPage(
            $page, 15
        );

        if (!$userList) {
            return $this->redirect()->toRoute('user-backend', [], true);
        }

        $viewModel = new ViewModel();
        $viewModel->setVariable('userList', $userList);

        return $viewModel;
    }

    /**
     * Show user
     *
     * @return ViewModel
     */
    public function showAction()
    {
        $id = $this->params()->fromRoute('id');

        if (!$id) {
            return $this->redirect()->toRoute('user-backend', [], true);
        }

        $user = $this->userRepository->getSingleUserById($id);

        if (!$user) {
            return $this->redirect()->toRoute('user-backend', [], true);
        }

        $viewModel = new ViewModel();
        $viewModel->setVariable('user', $user);

        return $viewModel;
    }
}
