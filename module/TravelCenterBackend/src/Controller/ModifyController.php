<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author	   		   Mirco Klink  * @author	   		   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			 https://github.com/MiKliWeb87/Zend3_Projekt2  * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace TravelCenterBackend\Controller;

use TravelCenterBackend\Form\TravelCenterFormInterface;
use TravelCenterModel\Repository\TravelCenterRepositoryInterface;
use Zend\Form\Form;
use Zend\Http\PhpEnvironment\Request;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\Plugin\FlashMessenger\FlashMessenger;
use Zend\View\Model\ViewModel;

/**
 * Class ModifyController
 *
 * @package TravelCenterBackend\Controller
 * @method Request getRequest()
 * @method FlashMessenger flashMessenger()
 */
class ModifyController extends AbstractActionController
{
    /**
     * @var TravelCenterRepositoryInterface
     */
    private $travelcenterRepository;

    /**
     * @var TravelCenterFormInterface|Form
     */
    private $travelcenterForm;

    /**
     * @param TravelCenterRepositoryInterface $travelcenterRepository
     */
    public function setTravelCenterRepository($travelcenterRepository)
    {
        $this->travelcenterRepository = $travelcenterRepository;
    }

    /**
     * @param TravelCenterFormInterface $travelcenterForm
     */
    public function setTravelCenterForm($travelcenterForm)
    {
        $this->travelcenterForm = $travelcenterForm;
    }

    /**
     * Add new travelcenter
     *
     * @return ViewModel
     */
    public function addAction()
    {
        $this->travelcenterForm->addMode();

        if ($this->getRequest()->isPost()) {
            $this->travelcenterForm->setData($this->params()->fromPost());

            if ($this->travelcenterForm->isValid()) {
                $travelcenter = $this->travelcenterRepository->createTravelCenterFromData(
                    $this->travelcenterForm->getData()
                );

                $result = $this->travelcenterRepository->saveTravelCenter($travelcenter);

                if ($result) {
                    $this->flashMessenger()->addSuccessMessage(
                        'travelcenter_backend_message_saved_travelcenter'
                    );

                    return $this->redirect()->toRoute(
                        'travelcenter-backend/modify',
                        [
                            'action' => 'edit',
                            'id'     => $travelcenter->getId(),
                        ],
                        true
                    );
                }
            }

            $messages = $this->travelcenterForm->getMessages();

            if (isset($messages['csrf'])) {
                $this->flashMessenger()->addErrorMessage(
                    'travelcenter_backend_message_form_timeout'
                );
            } else {
                $this->flashMessenger()->addErrorMessage(
                    'travelcenter_backend_message_check_data'
                );
            }
        } else {
            $this->flashMessenger()->addInfoMessage(
                'travelcenter_backend_message_create_travelcenter'
            );
        }

        $this->travelcenterForm->setAttribute(
            'action',
            $this->url()->fromRoute(
                'travelcenter-backend/modify', ['action' => 'add'], true
            )
        );
        $this->travelcenterForm->prepare();

        $viewModel = new ViewModel();
        $viewModel->setVariable('travelcenterForm', $this->travelcenterForm);

        return $viewModel;
    }

    /**
     * Edit exiting travelcenter
     *
     * @return ViewModel
     */
    public function editAction()
    {
        $this->travelcenterForm->editMode();

        $id = $this->params()->fromRoute('id');

        if (!$id) {
            return $this->redirect()->toRoute('travelcenter-backend', [], true);
        }

        $travelcenter = $this->travelcenterRepository->getSingleTravelCenterById($id);

        if (!$travelcenter) {
            return $this->redirect()->toRoute('travelcenter-backend', [], true);
        }

        $this->travelcenterForm->bind($travelcenter);

        if ($this->getRequest()->isPost()) {
            $postData  = $this->params()->fromPost();
            $filesData = $this->params()->fromFiles();

            if (isset($filesData['logo'])
                && $filesData['logo']['size'] > 0
            ) {
                $postData = array_merge_recursive($postData, $filesData);
            }

            $this->travelcenterForm->setData($postData);
            $this->travelcenterForm->addLogoFileUploadFilter();

            if ($this->travelcenterForm->isValid()) {
                $travelcenter->update();

                $result = $this->travelcenterRepository->saveTravelCenter($travelcenter);

                if ($result) {
                    $this->flashMessenger()->addSuccessMessage(
                        'travelcenter_backend_message_saved_travelcenter'
                    );

                    return $this->redirect()->toRoute(
                        'travelcenter-backend/modify',
                        [
                            'action' => 'edit',
                            'id'     => $travelcenter->getId(),
                        ],
                        true
                    );
                }
            }

            $messages = $this->travelcenterForm->getMessages();

            if (isset($messages['csrf'])) {
                $this->flashMessenger()->addErrorMessage(
                    'travelcenter_backend_message_form_timeout'
                );
            } else {
                $this->flashMessenger()->addErrorMessage(
                    'travelcenter_backend_message_check_data'
                );
            }
        } else {
            $this->flashMessenger()->addInfoMessage(
                'travelcenter_backend_message_update_travelcenter'
            );
        }

        $this->travelcenterForm->setAttribute(
            'action',
            $this->url()->fromRoute(
                'travelcenter-backend/modify',
                ['action' => 'edit', 'id' => $travelcenter->getId()],
                true
            )
        );
        $this->travelcenterForm->prepare();

        $viewModel = new ViewModel();
        $viewModel->setVariable('travelcenter', $travelcenter);
        $viewModel->setVariable('travelcenterForm', $this->travelcenterForm);

        return $viewModel;
    }

    /**
     * Delete existing travelcenter
     *
     * @return ViewModel
     */
    public function deleteAction()
    {
        $id = $this->params()->fromRoute('id');

        if (!$id) {
            return $this->redirect()->toRoute('travelcenter-backend', [], true);
        }

        $travelcenter = $this->travelcenterRepository->getSingleTravelCenterById($id);

        if (!$travelcenter) {
            return $this->redirect()->toRoute('travelcenter-backend', [], true);
        }

        $delete = $this->params()->fromQuery('delete', 'no');

        if ($delete == 'yes') {
            $this->travelcenterRepository->deleteTravelCenter($travelcenter);

            $this->flashMessenger()->addSuccessMessage(
                'travelcenter_backend_message_deleted_travelcenter'
            );

            return $this->redirect()->toRoute('travelcenter-backend', [], true);
        }

        $viewModel = new ViewModel();
        $viewModel->setVariable('travelcenter', $travelcenter);

        return $viewModel;
    }

    /**
     * Approve existing travelcenter
     *
     * @return ViewModel
     */
    public function approveAction()
    {
        $id = $this->params()->fromRoute('id');

        if (!$id) {
            return $this->redirect()->toRoute('travelcenter-backend', [], true);
        }

        $travelcenter = $this->travelcenterRepository->getSingleTravelCenterById($id);

        if (!$travelcenter) {
            return $this->redirect()->toRoute('travelcenter-backend', [], true);
        }

        $approve = $this->params()->fromQuery('approve', 'no');

        if ($approve == 'yes') {
            $travelcenter->approve();

            $this->travelcenterRepository->saveTravelCenter($travelcenter);

            $this->flashMessenger()->addSuccessMessage(
                'travelcenter_backend_message_approved_travelcenter'
            );

            return $this->redirect()->toRoute(
                'travelcenter-backend/show', ['id' => $travelcenter->getId()], true
            );
        }

        $viewModel = new ViewModel();
        $viewModel->setVariable('travelcenter', $travelcenter);

        return $viewModel;
    }

    /**
     * block exiting travelcenter
     *
     * @return ViewModel
     */
    public function blockAction()
    {
        $id = $this->params()->fromRoute('id');

        if (!$id) {
            return $this->redirect()->toRoute('travelcenter-backend', [], true);
        }

        $travelcenter = $this->travelcenterRepository->getSingleTravelCenterById($id);

        if (!$travelcenter) {
            return $this->redirect()->toRoute('travelcenter-backend', [], true);
        }

        $block = $this->params()->fromQuery('block', 'no');

        if ($block == 'yes') {
            $travelcenter->block();

            $this->travelcenterRepository->saveTravelCenter($travelcenter);

            $this->flashMessenger()->addSuccessMessage(
                'travelcenter_backend_message_blocked_travelcenter'
            );

            return $this->redirect()->toRoute(
                'travelcenter-backend/show', ['id' => $travelcenter->getId()], true
            );
        }

        $viewModel = new ViewModel();
        $viewModel->setVariable('travelcenter', $travelcenter);

        return $viewModel;
    }
}
