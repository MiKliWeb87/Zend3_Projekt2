<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author 	 	 	   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			   https://github.com/MiKliWeb87/Zend3_Projekt2  * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace HolidaycenterBackend\Controller;

use HolidaycenterBackend\Form\HolidaycenterFormInterface;
use HolidaycenterModel\Repository\HolidaycenterRepositoryInterface;
use Zend\Form\Form;
use Zend\Http\PhpEnvironment\Request;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\Plugin\FlashMessenger\FlashMessenger;
use Zend\View\Model\ViewModel;

/**
 * Class ModifyController
 *
 * @package HolidaycenterBackend\Controller
 * @method Request getRequest()
 * @method FlashMessenger flashMessenger()
 */
class ModifyController extends AbstractActionController
{
    /**
     * @var HolidaycenterRepositoryInterface
     */
    private $holidaycenterRepository;

    /**
     * @var HolidaycenterFormInterface|Form
     */
    private $holidaycenterForm;

    /**
     * @param HolidaycenterRepositoryInterface $holidaycenterRepository
     */
    public function setHolidaycenterRepository($holidaycenterRepository)
    {
        $this->holidaycenterRepository = $holidaycenterRepository;
    }

    /**
     * @param HolidaycenterFormInterface $holidaycenterForm
     */
    public function setHolidaycenterForm($holidaycenterForm)
    {
        $this->holidaycenterForm = $holidaycenterForm;
    }

    /**
     * Add new holidaycenter
     *
     * @return ViewModel
     */
    public function addAction()
    {
        $this->holidaycenterForm->addMode();

        if ($this->getRequest()->isPost()) 
		{
            $this->holidaycenterForm->setData($this->params()->fromPost());

            if ($this->holidaycenterForm->isValid()) 
			{
                $holidaycenter = $this->holidaycenterRepository->createHolidaycenterFromData(
                    $this->holidaycenterForm->getData()
                );

                $result = $this->holidaycenterRepository->saveHolidaycenter($holidaycenter);

                if ($result) 
				{
                    $this->flashMessenger()->addSuccessMessage(
                        'holidaycenter_backend_message_saved_holidaycenter'
                    );

                    return $this->redirect()->toRoute(
                        'holidaycenter-backend/modify',
                        [
                            'action' => 'edit',
                            'id'     => $holidaycenter->getId(),
                        ],
                        true
                    );
                }
            }

            $messages = $this->holidaycenterForm->getMessages();

            if (isset($messages['csrf'])) 
			{
                $this->flashMessenger()->addErrorMessage(
                    'holidaycenter_backend_message_form_timeout'
                );
            } 
			else 
			{
                $this->flashMessenger()->addErrorMessage(
                    'holidaycenter_backend_message_check_data'
                );
            }
        } 
		else 
		{
            $this->flashMessenger()->addInfoMessage(
                'holidaycenter_backend_message_create_holidaycenter'
            );
        }

        $this->holidaycenterForm->setAttribute(
            'action',
            $this->url()->fromRoute(
                'holidaycenter-backend/modify', ['action' => 'add'], true
            )
        );
        $this->holidaycenterForm->prepare();

        $viewModel = new ViewModel();
        $viewModel->setVariable('holidaycenterForm', $this->holidaycenterForm);

        return $viewModel;
    }

    /**
     * Edit exiting holidaycenter
     *
     * @return ViewModel
     */
    public function editAction()
    {
        $this->holidaycenterForm->editMode();

        $id = $this->params()->fromRoute('id');

        if (!$id) {
            return $this->redirect()->toRoute('holidaycenter-backend', [], true);
        }

        $holidaycenter = $this->holidaycenterRepository->getSingleHolidaycenterById($id);

        if (!$holidaycenter) {
            return $this->redirect()->toRoute('holidaycenter-backend', [], true);
        }

        $this->holidaycenterForm->bind($holidaycenter);

        if ($this->getRequest()->isPost()) {
            $postData  = $this->params()->fromPost();
            $filesData = $this->params()->fromFiles();

            if (isset($filesData['logo'])
                && $filesData['logo']['size'] > 0
            ) 
			{
                $postData = array_merge_recursive($postData, $filesData);
            }

            $this->holidaycenterForm->setData($postData);
            $this->holidaycenterForm->addLogoFileUploadFilter();

            if ($this->holidaycenterForm->isValid()) {
                $holidaycenter->update();

                $result = $this->holidaycenterRepository->saveHolidaycenter($holidaycenter);

                if ($result) {
                    $this->flashMessenger()->addSuccessMessage(
                        'holidaycenter_backend_message_saved_holidaycenter'
                    );

                    return $this->redirect()->toRoute(
                        'holidaycenter-backend/modify',
                        [
                            'action' => 'edit',
                            'id'     => $holidaycenter->getId(),
                        ],
                        true
                    );
                }
            }

            $messages = $this->holidaycenterForm->getMessages();

            if (isset($messages['csrf'])) {
                $this->flashMessenger()->addErrorMessage(
                    'holidaycenter_backend_message_form_timeout'
                );
            } else {
                $this->flashMessenger()->addErrorMessage(
                    'holidaycenter_backend_message_check_data'
                );
            }
        } else {
            $this->flashMessenger()->addInfoMessage(
                'holidaycenter_backend_message_update_holidaycenter'
            );
        }

        $this->holidaycenterForm->setAttribute(
            'action',
            $this->url()->fromRoute(
                'holidaycenter-backend/modify',
                ['action' => 'edit', 'id' => $holidaycenter->getId()],
                true
            )
        );
        $this->holidaycenterForm->prepare();

        $viewModel = new ViewModel();
        $viewModel->setVariable('holidaycenter', $holidaycenter);
        $viewModel->setVariable('holidaycenterForm', $this->holidaycenterForm);

        return $viewModel;
    }

    /**
     * Delete existing holidaycenter
     *
     * @return ViewModel
     */
    public function deleteAction()
    {
        $id = $this->params()->fromRoute('id');

        if (!$id) {
            return $this->redirect()->toRoute('holidaycenter-backend', [], true);
        }

        $holidaycenter = $this->holidaycenterRepository->getSingleHolidaycenterById($id);

        if (!$holidaycenter) {
            return $this->redirect()->toRoute('holidaycenter-backend', [], true);
        }

        $delete = $this->params()->fromQuery('delete', 'no');

        if ($delete == 'yes') {
            $this->holidaycenterRepository->deleteHolidaycenter($holidaycenter);

            $this->flashMessenger()->addSuccessMessage(
                'holidaycenter_backend_message_deleted_holidaycenter'
            );

            return $this->redirect()->toRoute('holidaycenter-backend', [], true);
        }

        $viewModel = new ViewModel();
        $viewModel->setVariable('holidaycenter', $holidaycenter);

        return $viewModel;
    }

    /**
     * Approve existing holidaycenter
     *
     * @return ViewModel
     */
    public function approveAction()
    {
        $id = $this->params()->fromRoute('id');

        if (!$id) {
            return $this->redirect()->toRoute('holidaycenter-backend', [], true);
        }

        $holidaycenter = $this->holidaycenterRepository->getSingleHolidaycenterById($id);

        if (!$holidaycenter) {
            return $this->redirect()->toRoute('holidaycenter-backend', [], true);
        }

        $approve = $this->params()->fromQuery('approve', 'no');

        if ($approve == 'yes') {
            $holidaycenter->approve();

            $this->holidaycenterRepository->saveHolidaycenter($holidaycenter);

            $this->flashMessenger()->addSuccessMessage(
                'holidaycenter_backend_message_approved_holidaycenter'
            );

            return $this->redirect()->toRoute(
                'holidaycenter-backend/show', ['id' => $holidaycenter->getId()], true
            );
        }

        $viewModel = new ViewModel();
        $viewModel->setVariable('holidaycenter', $holidaycenter);

        return $viewModel;
    }

    /**
     * block exiting holidaycenter
     *
     * @return ViewModel
     */
    public function blockAction()
    {
        $id = $this->params()->fromRoute('id');

        if (!$id) {
            return $this->redirect()->toRoute('holidaycenter-backend', [], true);
        }

        $holidaycenter = $this->holidaycenterRepository->getSingleHolidaycenterById($id);

        if (!$holidaycenter) {
            return $this->redirect()->toRoute('holidaycenter-backend', [], true);
        }

        $block = $this->params()->fromQuery('block', 'no');

        if ($block == 'yes') {
            $holidaycenter->block();

            $this->holidaycenterRepository->saveHolidaycenter($holidaycenter);

            $this->flashMessenger()->addSuccessMessage(
                'holidaycenter_backend_message_blocked_holidaycenter'
            );

            return $this->redirect()->toRoute(
                'holidaycenter-backend/show', ['id' => $holidaycenter->getId()], true
            );
        }

        $viewModel = new ViewModel();
        $viewModel->setVariable('holidaycenter', $holidaycenter);

        return $viewModel;
    }
}
