<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new Majora\Bundle\FrameworkExtraBundle\MajoraFrameworkExtraBundle($this),
            new Acme\Lv\Bundle\ApiBundle\AcmeLvApiBundle(),
            new Acme\Lv\Bundle\DalBundle\AcmeLvDalBundle(),
            new Acme\Lv\Bundle\SdkBundle\AcmeLvSdkBundle(),
            new Sir\Partner\Bundle\ApiBundle\SirPartnerApiBundle(),
            new Sir\Partner\Bundle\DalBundle\SirPartnerDalBundle(),
            new Sir\Partner\Bundle\SdkBundle\SirPartnerSdkBundle(),
            new Sir1\Partner3\Bundle\ApiBundle\Sir1Partner3ApiBundle(),
            new Sir1\Partner3\Bundle\DalBundle\Sir1Partner3DalBundle(),
            new Sir1\Partner3\Bundle\SdkBundle\Sir1Partner3SdkBundle(),
        ];

        if (in_array($this->getEnvironment(), ['dev', 'test'], true)) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
            $bundles[] = new Majora\Bundle\GeneratorBundle\MajoraGeneratorBundle();
        }

        return $bundles;
    }

    public function getRootDir()
    {
        return __DIR__;
    }

    public function getCacheDir()
    {
        return dirname(__DIR__).'/var/cache/'.$this->getEnvironment();
    }

    public function getLogDir()
    {
        return dirname(__DIR__).'/var/logs';
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml');
    }

    public function __construct($environment, $debug)
    {
        date_default_timezone_set( 'Europe/Paris' );
        parent::__construct($environment, $debug);
    }
}
