<?php

    namespace Helpers\Builder;

    use App\Helpers\ApiBuilder\Interfaces\Enumable;
    use App\Helpers\ApiBuilder\Modifiers\Nullable;
    use App\Helpers\ApiBuilder\Traits\DataEnums;

    abstract class BaseEnum extends BaseDatatype implements Enumable
    {
        use DataEnums;

        protected function default() {
            $this->reset();
        }

        public function select() {
            return $this->process();
        }

        public function reset() {
            $this->data(new Nullable());
        }

        protected function data($input = null, string $key = null) {
            parent::data($input, $key);
            return $this;
        }
    }
