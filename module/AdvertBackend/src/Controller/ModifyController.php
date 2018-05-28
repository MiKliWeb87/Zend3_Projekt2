<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author 	 	 	   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			   https://github.com/MiKliWeb87/Zend3_Projekt2  * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace AdvertBackend\Controller;

use AdvertBackend\Form\AdvertFormInterface;
use AdvertModel\Repository\AdvertRepositoryInterface;
use Zend\Form\Form;
use Zend\Http\PhpEnvironment\Request;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\Plugin\FlashMessenger\FlashMessenger;
use Zend\View\Model\ViewModel;

/**
 * Class ModifyController
 *
 * @package AdvertBackend\Controller
 * @method Request getRequest()
 * @method FlashMessenger flashMessenger()
 */
class ModifyController extends AbstractActionController
{
    /**
     * @var AdvertRepositoryInterface
     */
    private $advertRepository;

    /**
     * @var AdvertFormInterface|Form
     */
    private $advertForm;

    /**
     * @param AdvertRepositoryInterface $advertRepository
     */
    public function setAdvertRepository($advertRepository)
    {
        $this->advertRepository = $advertRepository;
    }

    /**
     * @param AdvertFormInterface $advertForm
     */
    public function setAdvertForm($advertForm)
    {
        $this->advertForm = $advertForm;
    }

    /**
     * @return ViewModel
     */
    public function addAction()
    {
        if ($this->getRequest()->isPost()) {
            $this->advertForm->setData($this->params()->fromPost());

            if ($this->advertForm->isValid()) {
                $advert = $this->advertRepository->createAdvertFromData(
                    $this->advertForm->getData()
                );

                $result = $this->advertRepository->saveAdvert($advert);

                if ($result) {
                    $this->flashMessenger()->addSuccessMessage(
                        'advert_backend_message_saved_advert'
                    );

                    return $this->redirect()->toRoute(
                        'advert-backend/modify',
                        [
                            'action' => 'edit',
                            'id'     => $advert->getId(),
                        ],
                        true
                    );
                }
            }

            $messages = $this->advertForm->getMessages();

            if (isset($messages['csrf'])) {
                $this->flashMessenger()->addErrorMessage(
                    'advert_backend_message_form_timeout'
                );
            } else {
                $this->flashMessenger()->addErrorMessage(
                    'advert_backend_message_check_data'
                );
            }
        } else {
            $this->flashMessenger()->addInfoMessage(
                'advert_backend_message_create_advert'
            );
        }

        $this->advertForm->setAttribute(
            'action',
            $this->url()->fromRoute(
                'advert-backend/modify', ['action' => 'add'], true
            )
        );
        $this->advertForm->prepare();

        $viewModel = new ViewModel();
        $viewModel->setVariable('advertForm', $this->advertForm);

        return $viewModel;
    }

    /**
     * @return ViewModel
     */
    public function editAction()
    {
        $this->advertForm->editMode();

        $id = $this->params()->fromRoute('id');

        if (!$id) {
            return $this->redirect()->toRoute('advert-backend', [], true);
        }

        $advert = $this->advertRepository->getSingleAdvertById($id);

        if (!$advert) {
            return $this->redirect()->toRoute('advert-backend', [], true);
        }

        $this->advertForm->bind($advert);

        if ($this->getRequest()->isPost()) {
            $this->advertForm->setData($this->params()->fromPost());

            if ($this->advertForm->isValid()) {
                $advert->update();

                $result = $this->advertRepository->saveAdvert($advert);

                if ($result) {
                    $this->flashMessenger()->addSuccessMessage(
                        'advert_backend_message_saved_advert'
                    );

                    return $this->redirect()->toRoute(
                        'advert-backend/modify',
                        [
                            'action' => 'edit',
                            'id'     => $advert->getId(),
                        ],
                        true
                    );
                }
            }

            $messages = $this->advertForm->getMessages();

            if (isset($messages['csrf'])) {
                $this->flashMessenger()->addErrorMessage(
                    'advert_backend_message_form_timeout'
                );
            } else {
                $this->flashMessenger()->addErrorMessage(
                    'advert_backend_message_check_data'
                );
            }
        } else {
            $this->flashMessenger()->addInfoMessage(
                'advert_backend_message_update_advert'
            );
        }

        $this->advertForm->setAttribute(
            'action',
            $this->url()->fromRoute(
                'advert-backend/modify',
                ['action' => 'edit', 'id' => $advert->getId()],
                true
            )
        );
        $this->advertForm->prepare();

        $viewModel = new ViewModel();
        $viewModel->setVariable('advert', $advert);
        $viewModel->setVariable('advertForm', $this->advertForm);

        return $viewModel;
    }

    /**
     * @return ViewModel
     */
    public function deleteAction()
    {
        $id = $this->params()->fromRoute('id');

        if (!$id) {
            return $this->redirect()->toRoute('advert-backend', [], true);
        }

        $advert = $this->advertRepository->getSingleAdvertById($id);

        if (!$advert) {
            return $this->redirect()->toRoute('advert-backend', [], true);
        }

        $delete = $this->params()->fromQuery('delete', 'no');

        if ($delete == 'yes') {
            $this->advertRepository->deleteAdvert($advert);

            $this->flashMessenger()->addSuccessMessage(
                'advert_backend_message_deleted_advert'
            );

            return $this->redirect()->toRoute('advert-backend', [], true);
        }

        $viewModel = new ViewModel();
        $viewModel->setVariable('advert', $advert);

        return $viewModel;
    }

    /**
     * @return ViewModel
     */
    public function approveAction()
    {
        $id = $this->params()->fromRoute('id');

        if (!$id) {
            return $this->redirect()->toRoute('advert-backend', [], true);
        }

        $advert = $this->advertRepository->getSingleAdvertById($id);

        if (!$advert) {
            return $this->redirect()->toRoute('advert-backend', [], true);
        }

        $approve = $this->params()->fromQuery('approve', 'no');

        if ($approve == 'yes') {
            $advert->approve();

            $this->advertRepository->saveAdvert($advert);

            $this->flashMessenger()->addSuccessMessage(
                'advert_backend_message_approved_advert'
            );

            return $this->redirect()->toRoute(
                'advert-backend/show', ['id' => $advert->getId()], true
            );
        }

        $viewModel = new ViewModel();
        $viewModel->setVariable('advert', $advert);

        return $viewModel;
    }

    /**
     * @return ViewModel
     */
    public function blockAction()
    {
        $id = $this->params()->fromRoute('id');

        if (!$id) {
            return $this->redirect()->toRoute('advert-backend', [], true);
        }

        $advert = $this->advertRepository->getSingleAdvertById($id);

        if (!$advert) {
            return $this->redirect()->toRoute('advert-backend', [], true);
        }

        $block = $this->params()->fromQuery('block', 'no');

        if ($block == 'yes') {
            $advert->block();

            $this->advertRepository->saveAdvert($advert);

            $this->flashMessenger()->addSuccessMessage(
                'advert_backend_message_blocked_advert'
            );

            return $this->redirect()->toRoute(
                'advert-backend/show', ['id' => $advert->getId()], true
            );
        }

        $viewModel = new ViewModel();
        $viewModel->setVariable('advert', $advert);

        return $viewModel;
    }
}
