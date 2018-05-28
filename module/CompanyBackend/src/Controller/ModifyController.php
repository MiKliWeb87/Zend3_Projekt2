<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author 	 	 	   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			   https://github.com/MiKliWeb87/Zend3_Projekt2  * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace CompanyBackend\Controller;

use CompanyBackend\Form\CompanyFormInterface;
use CompanyModel\Repository\CompanyRepositoryInterface;
use Zend\Form\Form;
use Zend\Http\PhpEnvironment\Request;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\Plugin\FlashMessenger\FlashMessenger;
use Zend\View\Model\ViewModel;

/**
 * Class ModifyController
 *
 * @package CompanyBackend\Controller
 * @method Request getRequest()
 * @method FlashMessenger flashMessenger()
 */
class ModifyController extends AbstractActionController
{
    /**
     * @var CompanyRepositoryInterface
     */
    private $companyRepository;

    /**
     * @var CompanyFormInterface|Form
     */
    private $companyForm;

    /**
     * @param CompanyRepositoryInterface $companyRepository
     */
    public function setCompanyRepository($companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    /**
     * @param CompanyFormInterface $companyForm
     */
    public function setCompanyForm($companyForm)
    {
        $this->companyForm = $companyForm;
    }

    /**
     * Add new company
     *
     * @return ViewModel
     */
    public function addAction()
    {
        $this->companyForm->addMode();

        if ($this->getRequest()->isPost()) {
            $this->companyForm->setData($this->params()->fromPost());

            if ($this->companyForm->isValid()) {
                $company = $this->companyRepository->createCompanyFromData(
                    $this->companyForm->getData()
                );

                $result = $this->companyRepository->saveCompany($company);

                if ($result) {
                    $this->flashMessenger()->addSuccessMessage(
                        'company_backend_message_saved_company'
                    );

                    return $this->redirect()->toRoute(
                        'company-backend/modify',
                        [
                            'action' => 'edit',
                            'id'     => $company->getId(),
                        ],
                        true
                    );
                }
            }

            $messages = $this->companyForm->getMessages();

            if (isset($messages['csrf'])) {
                $this->flashMessenger()->addErrorMessage(
                    'company_backend_message_form_timeout'
                );
            } else {
                $this->flashMessenger()->addErrorMessage(
                    'company_backend_message_check_data'
                );
            }
        } else {
            $this->flashMessenger()->addInfoMessage(
                'company_backend_message_create_company'
            );
        }

        $this->companyForm->setAttribute(
            'action',
            $this->url()->fromRoute(
                'company-backend/modify', ['action' => 'add'], true
            )
        );
        $this->companyForm->prepare();

        $viewModel = new ViewModel();
        $viewModel->setVariable('companyForm', $this->companyForm);

        return $viewModel;
    }

    /**
     * Edit exiting company
     *
     * @return ViewModel
     */
    public function editAction()
    {
        $this->companyForm->editMode();

        $id = $this->params()->fromRoute('id');

        if (!$id) {
            return $this->redirect()->toRoute('company-backend', [], true);
        }

        $company = $this->companyRepository->getSingleCompanyById($id);

        if (!$company) {
            return $this->redirect()->toRoute('company-backend', [], true);
        }

        $this->companyForm->bind($company);

        if ($this->getRequest()->isPost()) {
            $postData  = $this->params()->fromPost();
            $filesData = $this->params()->fromFiles();

            if (isset($filesData['logo'])
                && $filesData['logo']['size'] > 0
            ) {
                $postData = array_merge_recursive($postData, $filesData);
            }

            $this->companyForm->setData($postData);
            $this->companyForm->addLogoFileUploadFilter();

            if ($this->companyForm->isValid()) {
                $company->update();

                $result = $this->companyRepository->saveCompany($company);

                if ($result) {
                    $this->flashMessenger()->addSuccessMessage(
                        'company_backend_message_saved_company'
                    );

                    return $this->redirect()->toRoute(
                        'company-backend/modify',
                        [
                            'action' => 'edit',
                            'id'     => $company->getId(),
                        ],
                        true
                    );
                }
            }

            $messages = $this->companyForm->getMessages();

            if (isset($messages['csrf'])) {
                $this->flashMessenger()->addErrorMessage(
                    'company_backend_message_form_timeout'
                );
            } else {
                $this->flashMessenger()->addErrorMessage(
                    'company_backend_message_check_data'
                );
            }
        } else {
            $this->flashMessenger()->addInfoMessage(
                'company_backend_message_update_company'
            );
        }

        $this->companyForm->setAttribute(
            'action',
            $this->url()->fromRoute(
                'company-backend/modify',
                ['action' => 'edit', 'id' => $company->getId()],
                true
            )
        );
        $this->companyForm->prepare();

        $viewModel = new ViewModel();
        $viewModel->setVariable('company', $company);
        $viewModel->setVariable('companyForm', $this->companyForm);

        return $viewModel;
    }

    /**
     * Delete existing company
     *
     * @return ViewModel
     */
    public function deleteAction()
    {
        $id = $this->params()->fromRoute('id');

        if (!$id) {
            return $this->redirect()->toRoute('company-backend', [], true);
        }

        $company = $this->companyRepository->getSingleCompanyById($id);

        if (!$company) {
            return $this->redirect()->toRoute('company-backend', [], true);
        }

        $delete = $this->params()->fromQuery('delete', 'no');

        if ($delete == 'yes') {
            $this->companyRepository->deleteCompany($company);

            $this->flashMessenger()->addSuccessMessage(
                'company_backend_message_deleted_company'
            );

            return $this->redirect()->toRoute('company-backend', [], true);
        }

        $viewModel = new ViewModel();
        $viewModel->setVariable('company', $company);

        return $viewModel;
    }

    /**
     * Approve existing company
     *
     * @return ViewModel
     */
    public function approveAction()
    {
        $id = $this->params()->fromRoute('id');

        if (!$id) {
            return $this->redirect()->toRoute('company-backend', [], true);
        }

        $company = $this->companyRepository->getSingleCompanyById($id);

        if (!$company) {
            return $this->redirect()->toRoute('company-backend', [], true);
        }

        $approve = $this->params()->fromQuery('approve', 'no');

        if ($approve == 'yes') {
            $company->approve();

            $this->companyRepository->saveCompany($company);

            $this->flashMessenger()->addSuccessMessage(
                'company_backend_message_approved_company'
            );

            return $this->redirect()->toRoute(
                'company-backend/show', ['id' => $company->getId()], true
            );
        }

        $viewModel = new ViewModel();
        $viewModel->setVariable('company', $company);

        return $viewModel;
    }

    /**
     * block exiting company
     *
     * @return ViewModel
     */
    public function blockAction()
    {
        $id = $this->params()->fromRoute('id');

        if (!$id) {
            return $this->redirect()->toRoute('company-backend', [], true);
        }

        $company = $this->companyRepository->getSingleCompanyById($id);

        if (!$company) {
            return $this->redirect()->toRoute('company-backend', [], true);
        }

        $block = $this->params()->fromQuery('block', 'no');

        if ($block == 'yes') {
            $company->block();

            $this->companyRepository->saveCompany($company);

            $this->flashMessenger()->addSuccessMessage(
                'company_backend_message_blocked_company'
            );

            return $this->redirect()->toRoute(
                'company-backend/show', ['id' => $company->getId()], true
            );
        }

        $viewModel = new ViewModel();
        $viewModel->setVariable('company', $company);

        return $viewModel;
    }
}
