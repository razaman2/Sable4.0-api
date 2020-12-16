<?php

    namespace Helpers\Docusign;

    use Helpers\Docusign\Exceptions\InvalidDocumentNameException;
    use Helpers\Docusign\Interfaces\Defaultable;
    use DocuSign\eSign\Model\Checkbox;
    use DocuSign\eSign\Model\Date;
    use DocuSign\eSign\Model\DateSigned;
    use DocuSign\eSign\Model\FormulaTab;
    use DocuSign\eSign\Model\FullName;
    use DocuSign\eSign\Model\InitialHere;
    use DocuSign\eSign\Model\Note;
    use DocuSign\eSign\Model\Radio;
    use DocuSign\eSign\Model\RadioGroup;
    use DocuSign\eSign\Model\SignHere;
    use DocuSign\eSign\Model\Ssn;
    use DocuSign\eSign\Model\Tabs;
    use DocuSign\eSign\Model\Text;

    abstract class TemplateTabs extends Tabs
    {
        protected $data;

        protected $config = [
            'document' => 1,
            'page' => 1,
            'name' => null,
            'offsetY' => 0,
            'offsetX' => 0,
            'tabs' => [],
        ];

        protected $types = [
            'text_tabs' => Text::class,
            'radio_group_tabs' => RadioGroup::class,
            'radio_tab' => Radio::class,
            'checkbox_tabs' => Checkbox::class,
            'sign_here_tabs' => SignHere::class,
            'full_name_tabs' => FullName::class,
            'date_tabs' => Date::class,
            'date_signed_tabs' => DateSigned::class,
            'ssn_tabs' => Ssn::class,
            'initial_here_tabs' => InitialHere::class,
            'note_tabs' => Note::class,
            'formula_tabs' => FormulaTab::class
        ];

        /**
         * TemplateTabs constructor.
         * @param $data Helpers\Docusign\TemplateTabs | array
         * @param array $config
         * @throws Helpers\Docusign\Exceptions\InvalidDocumentNameException
         */
        public function __construct($data, $config = []) {
            parent::__construct();
            $this->config($config);
            if(empty($this->config['name'])) {
                throw new InvalidDocumentNameException();
            }
            if($data instanceof TemplateTabs) {
                $this->container = $data->container;
                $this->process($data->data);
            } else {
                $this->process($data);
            }
            if($this instanceof Defaultable) {
                $this->loadDefaults();
            }
            array_walk($this->config['tabs'], function($tab) {
                if(method_exists($tab, 'setXPosition')) {
                    $tab->setXPosition($this->config['offsetX'] + $tab->getXPosition());
                }
                if(method_exists($tab, 'setYPosition')) {
                    $tab->setYPosition($this->config['offsetY'] + $tab->getYPosition());
                }
            });
        }

        protected function normalize($method) {
            return preg_replace('/[\W_]/', '', $method);
        }

        protected function process($data) {
            foreach($data as $name1 => $value) {
                $name = $this->normalize($name1);
                if(method_exists($this, $name)) {
                    call_user_func([$this, $name], $value);
                }
            }
            $this->data = $data;
        }

        protected function new($tab_name) {
            $tab = new $this->types[$tab_name]();
            if(method_exists($tab, 'setDocumentId')) {
                $tab->setDocumentId($this->config['document']);
            }
            if(method_exists($tab, 'setPageNumber')) {
                $tab->setPageNumber($this->config['page']);
            }
            if(array_key_exists($tab_name, $this->container)) {
                $this->container[$tab_name][] = $tab;
            }
            array_push($this->config['tabs'], $tab);
            return $tab;
        }

        public function config($properties = []) {
            if(empty($properties)) {
                return $this->config;
            } else {
                $this->config = array_merge($this->config, $properties);
                return $this;
            }
        }

        public function setOffsetY(int $offset) {
            $this->config['offsetY'] = $offset;
            return $this;
        }

        public function setOffsetX(int $offset) {
            $this->config['offsetX'] = $offset;
            return $this;
        }
    }
