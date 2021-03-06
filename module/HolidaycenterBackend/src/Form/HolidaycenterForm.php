<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author 	 	 	   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			   https://github.com/MiKliWeb87/Zend3_Projekt2  * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace HolidaycenterBackend\Form;

use HolidaycenterModel\Filter\LogoFileUpload;
use TravelloFilter\Filter\StringToUrlSlug;
use Zend\Filter\StaticFilter;
use Zend\Form\Element\Csrf;
use Zend\Form\Element\File;
use Zend\Form\Element\Select;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\Form\Form;

/**
 * Class HolidaycenterForm
 *
 * @package HolidaycenterBackend\Form
 */
class HolidaycenterForm extends Form implements HolidaycenterFormInterface
{
    /**
     * @var array
     */
    private $statusOptions;

    /**
     * @var string
     */
    private $logoFilePath;

    /**
     * @var string
     */
    private $logoFilePattern;

    /**
     * @param array $statusOptions
     */
    public function setStatusOptions($statusOptions)
    {
        $this->statusOptions = $statusOptions;
    }

    /**
     * @param string $logoFilePath
     */
    public function setLogoFilePath($logoFilePath)
    {
        $this->logoFilePath = $logoFilePath;
    }

    /**
     * @param string $logoFilePattern
     */
    public function setLogoFilePattern($logoFilePattern)
    {
        $this->logoFilePattern = $logoFilePattern;
    }

    /**
     * Init form
     */
    public function init()
    {
        $this->setName('holidaycenter_form');
        $this->setAttribute('class', 'form-horizontal');

        $this->add(
            [
                'type' => Csrf::class,
                'name' => 'csrf',
            ]
        );

        $this->add(
            [
                'type'       => Select::class,
                'name'       => 'status',
                'attributes' => [
                    'class' => 'form-control',
                ],
                'options'    => [
                    'value_options' => $this->statusOptions,
                    'label'         => 'holidaycenter_backend_label_status',
                ],
            ]
        );

        $this->add(
            [
                'type'       => Text::class,
                'name'       => 'name',
                'attributes' => [
                    'class' => 'form-control',
                ],
                'options'    => [
                    'label' => 'holidaycenter_backend_label_name',
                ],
            ]
        );

        $this->add(
            [
                'type'       => Text::class,
                'name'       => 'email',
                'attributes' => [
                    'class' => 'form-control',
                ],
                'options'    => [
                    'label' => 'holidaycenter_backend_label_email',
                ],
            ]
        );

        $this->add(
            [
                'type'       => Text::class,
                'name'       => 'contact',
                'attributes' => [
                    'class' => 'form-control',
                ],
                'options'    => [
                    'label' => 'holidaycenter_backend_label_contact',
                ],
            ]
        );

        $this->add(
            [
                'type'       => File::class,
                'name'       => 'logo',
                'attributes' => [
                    'class' => 'form-control-static',
                ],
                'options'    => [
                    'label' => 'holidaycenter_backend_label_logo',
                ],
            ]
        );

        $this->add(
            [
                'type'       => Submit::class,
                'name'       => 'save_holidaycenter',
                'options'    => [],
                'attributes' => [
                    'id'    => 'save_holidaycenter',
                    'class' => 'btn btn-primary',
                    'value' => 'holidaycenter_backend_action_save',
                ],
            ]
        );
    }

    /**
     * Switch to add/anlegen mode
     */
    public function addMode() //noch übernehmen?
    {
        if ($this->has('logo')) {
            $this->remove('logo');
        }

        $this->setValidationGroup(array_keys($this->getElements()));
    }

    /**
     * Switch to edit/bearbeiten mode
     */
    public function editMode()
    {
        if ($this->has('status')) {
            $this->remove('status');
        }

        $this->setValidationGroup(array_keys($this->getElements()));
    }

    /**
     * Add logo file upload filter to input filter
     */
    public function addLogoFileUploadFilter()
    {
        $nameValue = $this->get('name')->getValue();

        $targetFile = sprintf(
            $this->logoFilePattern,
            StaticFilter::execute($nameValue, StringToUrlSlug::class)
        );

        $logoFileUploadFilter = new LogoFileUpload(
            $this->logoFilePath, $targetFile
        );

        $this->getInputFilter()->get('logo')->getFilterChain()->attach(
            $logoFileUploadFilter
        );
    }
}
