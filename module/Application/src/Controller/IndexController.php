<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/zendframework-center
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Application\Controller;

use AdvertModel\Repository\AdvertRepositoryInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Class IndexController
 *
 * @package Application\Controller
 */
class IndexController extends AbstractActionController
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
        $randomHoliday     = $this->advertRepository->getRandomAdvert('holiday');
        $randomShortholiday = $this->advertRepository->getRandomAdvert(
            'shortholiday'
        );

        $viewModel = new ViewModel();
        $viewModel->setVariable('randomHoliday', $randomHoliday);
        $viewModel->setVariable('randomShortholiday', $randomShortholiday);

        return $viewModel;
    }
}
