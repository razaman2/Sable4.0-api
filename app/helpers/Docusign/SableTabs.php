<?php

    namespace Helpers\Docusign;

    use Helpers\Docusign\Interfaces\TemplateInterface;
    use DocuSign\eSign\Model\Tabs;

    /**
     * Class SableTabs
     * @package App\Helpers\Docusign
     * Extending Core Docusign Tabs Class.
     */
    abstract class SableTabs extends Tabs implements TemplateInterface {
        protected $api;

        public function __construct(Docusign $api) {
            parent::__construct();
            $this->api = $api;
        }

        protected function normalize($method) {
            return preg_replace('/[\W_]/', '', $method);
        }

        protected function process(array $data) {
            foreach($data as $key => $value) {
                $name = $this->normalize($key);
                if(method_exists($this, $name)) {
                    call_user_func([
                        $this,
                        $name,
                    ], $value);
                }
            }
        }

        public function getTabs(array $data) {
            return new Tabs($this->build($data));
        }

        /**
         * @param array $data
         * @return array
         * Returns The Core Docusign Container of Tabs.
         */
        public function build(array $data) : array {
            return $this->container;
        }

        public function configure(array $data) {
            return (new SableEnvelope($data))->build($this);
        }
    }
