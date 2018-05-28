<?php
/**
 * ZF3 book Zend Framework Center Example Application
 *
 * @authorSkeleton     Ralf Eggert <ralf@travello.de>  * @author 	 	 	   Mirco Klink
 * @linkSkeleton       https://github.com/zf3buch/zendframework-center
 * @link 			   https://github.com/MiKliWeb87/Zend3_Projekt2  * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace AdvertModel\InputFilter;

use AdvertModel\Config\AdvertConfigInterface;
use CompanyModel\Repository\CompanyRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class AdvertInputFilterFactory
 *
 * @package AdvertModel\InputFilter
 */
class AdvertInputFilterFactory implements FactoryInterface
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
        /** @var AdvertConfigInterface $advertConfig */
        $advertConfig = $container->get(AdvertConfigInterface::class);

        /** @var CompanyRepositoryInterface $companyRepository */
        $companyRepository = $container->get(
            CompanyRepositoryInterface::class
        );

        $inputFilter = new AdvertInputFilter();
        $inputFilter->setStatusOptions(
            array_keys($advertConfig->getStatusOptions())
        );
        $inputFilter->setTypeOptions(
            array_keys($advertConfig->getTypeOptions())
        );
        $inputFilter->setCompanyOptions(
            array_keys($companyRepository->getCompanyOptions())
        );

        return $inputFilter;
    }
}