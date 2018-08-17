<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author 	 	 	   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			   https://github.com/MiKliWeb87/Zend3_Projekt2  * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace AdvertBackend\Form;
use AdvertModel\Filter\ImageFileUpload; //NEU
use TravelloFilter\Filter\StringToUrlSlug;//NEU
use Zend\Filter\StaticFilter;//NEU
use Zend\Form\Element\Csrf;
use Zend\Form\Element\File; //NEU
use Zend\Form\Element\Select;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\Form\Element\Textarea;
use Zend\Form\Form;

/**
 * Class AdvertForm
 *
 * @package AdvertBackend\Form
 */
class AdvertForm extends Form implements AdvertFormInterface
{
    /**
     * @var array
     */
    private $statusOptions;

    /**
     * @var array
     */
    private $typeOptions;

    /**
     * @var array
     */
    private $holidaycenterOptions;
	
	/**
	 * @var string imagePfad/imagePath NEU
	 */
	private $imageFilePath;
	
	/**
     * @var string NEU
     */
    private $imageFilePattern;
	
    /**
     * @param array $statusOptions
     */
    public function setStatusOptions($statusOptions)
    {
        $this->statusOptions = $statusOptions;
    }

    /**
     * @param array $typeOptions
     */
    public function setTypeOptions($typeOptions)
    {
        $this->typeOptions = $typeOptions;
    }

    /**
     * @param array $holidaycenterOptions
     */
    public function setHolidaycenterOptions($holidaycenterOptions)
    {
        $this->holidaycenterOptions = $holidaycenterOptions;
    }
	
	/**
     * @param string $imageFilePath NEU
     */
    public function setImageFilePath($imageFilePath)
    {
        $this->imageFilePath = $imageFilePath;
    }

    /**
     * @param string $imageFilePattern NEU
     */
    public function setImageFilePattern($imageFilePattern)
    {
        $this->imageFilePattern = $imageFilePattern;
    }

    /**
     * Init form
	 * Formularfelder wo einzelne Felder per add
	 * hinzugefügt werden
     */
    public function init()
    {
        $this->setName('advert_form');
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
                'name'       => 'type',
                'attributes' => [
                    'class' => 'form-control',
                ],
                'options'    => [
                    'value_options' => $this->typeOptions,
                    'label'         => 'advert_backend_label_type',
                ],
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
                    'label'         => 'advert_backend_label_status',
                ],
            ]
        );

        $this->add(
            [
                'type'       => Select::class,
                'name'       => 'holidaycenter',
                'attributes' => [
                    'class' => 'form-control',
                ],
                'options'    => [
                    'value_options' => $this->holidaycenterOptions,
                    'label'         => 'advert_backend_label_holidaycenter',
                ],
            ]
        );

        $this->add(
            [
                'type'       => Text::class,
                'name'       => 'location',
                'attributes' => [
                    'class' => 'form-control',
                ],
                'options'    => [
                    'label' => 'advert_backend_label_location',
                ],
            ]
        );

        $this->add(
            [
                'type'       => Text::class,
                'name'       => 'title',
                'attributes' => [
                    'class' => 'form-control',
                ],
                'options'    => [
                    'label' => 'advert_backend_label_title',
                ],
            ]
        );

        $this->add(
            [
                'type'       => Textarea::class,
                'name'       => 'text',
                'attributes' => [
                    'id'    => 'advert_text',
                    'class' => 'form-control',
                ],
                'options'    => [
                    'label' => 'advert_backend_label_text',
                ],
            ]
        );
		/**
		 * Bild Upload Feld NEU
		 */
		$this->add(
            [
                'type'       => File::class,
                'name'       => 'image',
                'attributes' => [
                    'class' => 'form-control-static',
                ],
                'options'    => [
                    'label' => 'advert_backend_label_image',
                ],
            ]
        );

        $this->add(
            [
                'type'       => Submit::class,
                'name'       => 'save_advert',
                'options'    => [],
                'attributes' => [
                    'id'    => 'save_advert',
                    'class' => 'btn btn-primary',
                    'value' => 'advert_backend_action_save',
                ],
            ]
        );
    }
	/**
	 *Switch to add mode NEU
	 *
	 */
	/*public function addMode() //noch übernehmen?
    {
        if ($this->has('logo')) {
            $this->remove('logo');
        }

        $this->setValidationGroup(array_keys($this->getElements()));
    } */
	
    /**
     * Switch to edit mode
     */
    public function editMode()
    {
        if ($this->has('status')) {
            $this->remove('status');
        }

        if ($this->has('type')) {
            $this->remove('type');
        }

        if ($this->has('holidaycenter')) {
            $this->remove('holidaycenter');
        }

        $this->setValidationGroup(array_keys($this->getElements()));
    }
	
	/**NEU
     * Add image file upload filter to input filter
     */
    public function addImageFileUploadFilter()
    {
        $nameValue = $this->get('location')->getValue() . rand(1,1000); //einzigartiger Name...erweitern?

        $targetFile = sprintf(
            $this->imageFilePattern,
            StaticFilter::execute($nameValue, StringToUrlSlug::class)
        );

        $imageFileUploadFilter = new ImageFileUpload(
            $this->imageFilePath, $targetFile
        );

        $this->getInputFilter()->get('image')->getFilterChain()->attach(
            $imageFileUploadFilter
        );
    }
}
