<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author	   		   Mirco Klink  * @author	   		   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			 https://github.com/MiKliWeb87/Zend3_Projekt2  * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace TravelCenterBackend\Controller;

use TravelCenterModel\Repository\TravelCenterRepositoryInterface;
use Zend\Debug\Debug;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Class DisplayController
 *
 * @package TravelCenterBackend\Controller
 */
class DisplayController extends AbstractActionController
{
    /**
     * @var TravelCenterRepositoryInterface
     */
    private $travelcenterRepository;

    /**
     * @param TravelCenterRepositoryInterface $travelcenterRepository
     */
    public function setTravelCenterRepository($travelcenterRepository)
    {
        $this->travelcenterRepository = $travelcenterRepository;
    }

    /**
     * Show travelcenter list
     *
     * @return ViewModel
     */
    public function indexAction()
    {
        $page = $this->params()->fromRoute('page', 1);

        $travelcenterList = $this->travelcenterRepository->getTravelCentersByPage(
            $page, 15
        );

        if (!$travelcenterList) {
            return $this->redirect()->toRoute('travelcenter-backend', [], true);
        }

        $viewModel = new ViewModel();
        $viewModel->setVariable('travelcenterList', $travelcenterList);

        return $viewModel;
    }

    /**
     * Show travelcenter
     *
     * @return ViewModel
     */
    public function showAction()
    {
        $id = $this->params()->fromRoute('id');

        if (!$id) {
            return $this->redirect()->toRoute('travelcenter-backend', [], true);
        }

        $travelcenter = $this->travelcenterRepository->getSingleTravelCenterById($id);

        if (!$travelcenter) {
            return $this->redirect()->toRoute('travelcenter-backend', [], true);
        }

        $viewModel = new ViewModel();
        $viewModel->setVariable('travelcenter', $travelcenter);

        return $viewModel;
    }
}
