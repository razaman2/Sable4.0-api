<?php
    namespace Helpers\Builder;

    class MethodInvoker
    {
        private $object;

        public function __construct($object) {
            $this->object = $object;
        }

        public function invoke($data) {
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

        protected function normalize($method) {
            return preg_replace('/[\W_]/', '', $method);
        }
    }