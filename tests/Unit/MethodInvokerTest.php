<?php

namespace Tests\Unit;

use Helpers\Builder\MethodInvoker;
use PHPUnit\Framework\TestCase;

class MethodInvokerTest extends TestCase
{
    /**
    * @test
    */
    public function should_invoke_class_method() {
        $responses = (new MethodInvoker(new InvokerClient(), true))->invoke(['method1' => 'one', 'method2' => 'two']);

        dump($responses);
    }
}

class InvokerClient {
    protected function method1($data) {
        return "method one called with $data";
    }

    private function method2($data) {
        return "method two called with $data";
    }
}
