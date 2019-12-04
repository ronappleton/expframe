<?php

use Illuminate\Config\Repository;
use Symfony\Component\Finder\Finder;

/**
 * Class Config
 * 
 * @package ${NAMESPACE}
 * @author Ron Appleton <ron.appleton@visualsoft.co.uk>
 */
class Config extends Repository
{
    private $configPath;
    
    public function __construct(array $items = [])
    {
        parent::__construct($items);
        $this->load(dirname(__DIR__ ) . DIRECTORY_SEPARATOR . getenv('CONFIG_PATH'));
    }

    /**
     * 
     * @param $configPath
     * @author Ron Appleton <ron.appleton@visualsoft.co.uk>
     */
    public function load($configPath)
    {
        $this->configPath = $configPath;
        
        foreach ($this->getConfigurationFiles() as $fileKey => $path) {
            $this->set($fileKey, require $path);
        }
    }

    /**
     * @return array
     * @author Ron Appleton <ron.appleton@visualsoft.co.uk>
     */
    protected function getConfigurationFiles(): array
    {
        if (!is_dir($this->configPath)) {
            return [];
        }

        $files = [];
        $phpFiles = Finder::create()->files()->name('*.php')->in($this->configPath)->depth(0);

        foreach ($phpFiles as $file) {
            $files[basename($file->getRealPath(), '.php')] = $file->getRealPath();
        }
        
        return $files;
    }
}
