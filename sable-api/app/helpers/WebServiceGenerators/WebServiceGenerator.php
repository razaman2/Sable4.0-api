<?php

    namespace Helpers\WebServiceGenerators;

    use Illuminate\Support\Facades\Storage;
    use WsdlToPhp\PackageGenerator\ConfigurationReader\GeneratorOptions;
    use WsdlToPhp\PackageGenerator\Generator\Generator;

    class WebServiceGenerator
    {
        protected $dirName;

        protected $wsdlUrl;

        public function __construct($directory = 'vendor/generated') {
            $options = GeneratorOptions::instance();
            $options->setOrigin($this->wsdlUrl)
                ->setDestination($directory)
                ->setStandalone(false)
                ->setNamespace($this->namespace())
                ->setSrcDirname($this->dirName);

            // Generator instantiation
            $generator = new Generator($options);
            // Package generation
            $generator->generatePackage();
            // Update composer.json file
            $this->updateComposerJson($directory);
            // Build path to tutorial file
            $file = "{$this->dirName}Tutorial.php";
            // Cache desired disk
            $disk = Storage::disk('generated');
            // Rename tutorial file
            if($disk->exists($file)) {
                $disk->delete($file);
            }

            $disk->move('tutorial.php', $file);
        }

        protected function namespace() {
            return 'WebService\\'.preg_replace("/\//", "\\", $this->dirName);
        }

        protected function updateComposerJson($directory) {
            $file = json_decode(Storage::disk('root')->get('composer.json'), true);
            if(!isset($file['autoload']['psr-4']['WebService\\'])) {
                $file['autoload']['psr-4']['WebService\\'] = $directory;
                Storage::disk('root')->put('composer.json', json_encode($file));
            }
        }

        protected function longRunningTask() {
            ini_set('memory_limit', -1);
        }
    }
