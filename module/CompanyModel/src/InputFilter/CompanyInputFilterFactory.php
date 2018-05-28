<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author 	 	 	   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			   https://github.com/MiKliWeb87/Zend3_Projekt2  * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace CompanyModel\InputFilter;

use CompanyModel\Config\CompanyConfigInterface;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class CompanyInputFilterFactory
 *
 * @package CompanyModel\InputFilter
 */
class CompanyInputFilterFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string             $requestedName
     * @param array|null|null    $options
     *
     * @return mixed
     */
    public function __invoke(
        ContainerInterface $container, $requestedName,
        array $options = null
    ) {
        /** @var CompanyConfigInterface $companyConfig */
        $companyConfig = $container->get(CompanyConfigInterface::class);

        $inputFilter = new CompanyInputFilter();
        $inputFilter->setStatusOptions(
            array_keys($companyConfig->getStatusOptions())
        );

        return $inputFilter;
    }
}