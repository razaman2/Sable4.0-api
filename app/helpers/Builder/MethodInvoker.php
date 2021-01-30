<?php
    namespace Helpers\Builder;

    class MethodInvoker
    {
        private $object;
        private $responses;
        private $private;

        public function __construct(object $object, bool $private = false) {
            $this->object = $object;
            $this->private = $private;
        }

        public function invoke($data, ...$payload) {
            $object = new \ReflectionClass($this->object);

            foreach($data as $key => $value) {
                $name = $this->normalize($key);

                if($object->hasMethod($name)) {
                    $method = $object->getMethod($name);
                    $method->setAccessible($this->private);
                    $this->responses[$key] = $method->invoke($this->object, $value, ...$payload);
                }
            }

            return (object) $this->responses;
        }

        protected function normalize($method) {
            return preg_replace('/[\W_]/', '', $method);
        }
    }
