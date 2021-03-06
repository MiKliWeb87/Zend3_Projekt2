<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de> 
 * @author 	 	 	   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			   https://github.com/MiKliWeb87/Zend3_Projekt2 
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace AdvertModel\Filter;

use Zend\Filter\File\RenameUpload;

/**
 * Class ImageFileUpload NEU
 *
 * @package AdvertModel\Filter
 */
class ImageFileUpload extends RenameUpload
{
    /**
     * @var string
     */
    private $targetPath;

    /**
     * @var string
     */
    private $targetFile;

    /**
     * Constructor
     *
     * @param string $targetPath
     * @param string $targetFile
     */
    public function __construct($targetPath, $targetFile)
    {
        $this->targetPath = $targetPath;
        $this->targetFile = $targetFile;

        $options = [
            'overwrite' => true,
            'target'    => $targetPath . $targetFile,
        ];

        parent::__construct($options);
    }

    /**
     * @param array|string $value
     *
     * @return array|string
     */
    public function filter($value)
    {
        parent::filter($value);

        return $this->targetFile;
    }
}
