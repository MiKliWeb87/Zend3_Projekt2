<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author 	 	 	   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			   https://github.com/MiKliWeb87/Zend3_Projekt2  * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace AdvertFrontend\Controller;

use AdvertModel\Repository\AdvertRepositoryInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Class DisplayController
 *
 * @package AdvertFrontend\Controller
 */
class DisplayController extends AbstractActionController
{
    /**
     * @var AdvertRepositoryInterface
     */
    private $advertRepository;

    /**
     * @param AdvertRepositoryInterface $advertRepository
     */
    public function setAdvertRepository($advertRepository)
    {
        $this->advertRepository = $advertRepository;
    }

    /**
     * @return ViewModel
     */
    public function indexAction()
    {
        $page = $this->params()->fromRoute('page', 1);
        $type = $this->params()->fromRoute('type', 'holiday');

        $advertList = $this->advertRepository->getAdvertsByPage(
            $type, true, $page
        );

        if (!$advertList) {
            return $this->redirect()->toRoute('advert-' . $type, [], true);
        }

        $viewModel = new ViewModel();
        $viewModel->setVariable('advertList', $advertList);
        $viewModel->setVariable('type', $type);

        return $viewModel;
    }

    /**
     * @return ViewModel
     */
    public function detailAction()
    {
        $id = $this->params()->fromRoute('id');
        $type = $this->params()->fromRoute('type', 'holiday');

        if (!$id) {
            return $this->redirect()->toRoute('advert-' . $type, [], true);
        }

        $advert = $this->advertRepository->getSingleAdvertById($id);

        if (!$advert || $advert->getType() != $type) {
            return $this->redirect()->toRoute('advert-' . $type, [], true);
        }

        $viewModel = new ViewModel();
        $viewModel->setVariable('advert', $advert);
        $viewModel->setVariable('type', $type);

        return $viewModel;
    }
}
