<?php

    namespace Helpers\Docusign;

    use Helpers\Docusign\Interfaces\TemplateInterface;

    /**
     * Class Packet
     * @package App\Helpers\Docusign
     * A Packet Is A Collection of Templates.
     */
    abstract class Packet extends SableTabs {
        /**
         * collection of templates to add to envelope.
         * @var $templates TemplateInterface[];
         */
        protected $templates = [];

        public function __construct(Docusign $api, $data) {
            parent::__construct($api);
            $this->setup($data);
            $this->getServerTemplates();
        }

        public function add(TemplateInterface $template) {
            array_push($this->templates, $template);
        }

        public function getServerTemplates($templates = []) {
            $serverTemplates = $this->api->getTemplates()->getEnvelopeTemplates();
            return array_reduce($this->templates, function($templates, $localTemplate) use ($serverTemplates) {
                array_push($templates, $localTemplate->getServerTemplate($serverTemplates));
                return $templates;
            }, []);
        }

        public function getLocalTemplates() {
            return $this->templates;
        }

        public function build(array $data) : array {
            return array_reduce($this->templates, function($tabs, $template) use ($data) {
                return $this->merge($tabs, $template->getTabs($data)->container);
            }, $this->container);
        }

        protected function merge(array $subject, array $source) {
            foreach($source as $key => $value) {
                if($value) {
                    is_array($subject[$key]) ? array_push($subject[$key], ...$value) : $subject[$key] = $value;
                }
            }

            return $subject;
        }

        public abstract function setup(array $data);
    }
