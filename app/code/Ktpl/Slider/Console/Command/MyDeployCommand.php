<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Ktpl\Slider\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Framework\Filesystem;
use Magento\Framework\View\Asset\Source;
use Magento\Framework\App\State;
use Magento\Framework\View\Asset\Repository;
use Magento\Framework\ObjectManagerInterface;
use Magento\Framework\App\ObjectManager\ConfigLoader;
use Magento\Framework\View\Asset\SourceFileGeneratorPool;
use Magento\Framework\View\Asset\PreProcessor\ChainFactoryInterface;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Validator\Locale;

/**
 * Class CssDeployCommand - collects, processes and publishes source files like LESS or SASS
 * @SuppressWarnings("PMD.CouplingBetweenObjects")
 */
class MyDeployCommand extends Command
{
    /**
     * Files argument key
     */
    const FILE_ARGUMENT = 'rm -rf pub/static/*';

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('dev:clear:static:cache')
            ->setDescription('My Command');

        parent::configure();
    }

    public function delTree($dir) {
        $files = array_diff(scandir($dir), array('.','..'));
        foreach ($files as $file) {
            if(is_dir("$dir/$file")) {
                $this->delTree("$dir/$file");
            }else{
                unlink("$dir/$file");
            }
        }
        return rmdir($dir);
    }
    /**
     * {@inheritdoc}
     * @throws \InvalidArgumentException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $clearsCache=array("view_preprocessed","cache","generation","page_cache");
        foreach($clearsCache as $clear)
        {
            $path="var/".$clear;
            if(is_dir($path)){
                $this->delTree("var/".$clear);
                $output->writeln("Clear Cache : ".$clear);
            }
        }
        $clearsPubStatic=array("_requirejs","adminhtml","frontend");
        foreach($clearsPubStatic as $pubStatic)
        {
            $path="pub/static/".$pubStatic;
            if(is_dir($path)){
                $this->delTree($path);
                $output->writeln("Clear Static : ".$pubStatic);
            }
        }
        $output->writeln("<info>Successfully clear all cache and static files </info>");
    }
}
