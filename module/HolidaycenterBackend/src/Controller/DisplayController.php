<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author 	 	 	   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			   https://github.com/MiKliWeb87/Zend3_Projekt2  * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace HolidaycenterBackend\Controller;

use HolidaycenterModel\Repository\HolidaycenterRepositoryInterface;
use Zend\Debug\Debug;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Class DisplayController
 *
 * @package HolidaycenterBackend\Controller
 */
class DisplayController extends AbstractActionController
{
    /**
     * @var HolidaycenterRepositoryInterface
     */
    private $holidaycenterRepository;

    /**
     * @param HolidaycenterRepositoryInterface $holidaycenterRepository
     */
    public function setHolidaycenterRepository($holidaycenterRepository)
    {
        $this->holidaycenterRepository = $holidaycenterRepository;
    }

    /**
     * Show holidaycenter list
     *
     * @return ViewModel
     */
    public function indexAction()
    {
        $page = $this->params()->fromRoute('page', 1);

        $holidaycenterList = $this->holidaycenterRepository->getCompaniesByPage(
            $page, 15
        );

        if (!$holidaycenterList) {
            return $this->redirect()->toRoute('holidaycenter-backend', [], true);
        }

        $viewModel = new ViewModel();
        $viewModel->setVariable('holidaycenterList', $holidaycenterList);

        return $viewModel;
    }

    /**
     * Show holidaycenter
     *
     * @return ViewModel
     */
    public function showAction()
    {
        $id = $this->params()->fromRoute('id');

        if (!$id) {
            return $this->redirect()->toRoute('holidaycenter-backend', [], true);
        }

        $holidaycenter = $this->holidaycenterRepository->getSingleHolidaycenterById($id);

        if (!$holidaycenter) {
            return $this->redirect()->toRoute('holidaycenter-backend', [], true);
        }

        $viewModel = new ViewModel();
        $viewModel->setVariable('holidaycenter', $holidaycenter);

        return $viewModel;
    }
}
