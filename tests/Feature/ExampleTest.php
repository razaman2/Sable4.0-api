<?php

    namespace Tests\Feature;

    use Carbon\Carbon;
    use Helpers\ADC\ADCAuth;
    use Helpers\ADC\DealerManagement\GetRepList;
    use Helpers\Docusign\Auth\DocusignAuthFactory;
    use Helpers\Docusign\Docusign;
    use Helpers\Docusign\VIO\packets\SecurityPacket;
    use Illuminate\Support\Facades\Storage;
    use Tests\TestCase;

    class ExampleTest extends TestCase
    {
        /**
         * A basic test example.
         * @return void
         */
        public function testBasicTest() {
            $response = $this->get('/');

            $response->assertStatus(200);
        }

        /**
        * @test
        */
        public function credit() {
            $this->withoutExceptionHandling();
            $this->post('/api/credit/new', [
                'test' => true,
                'options' => 'pass',
                'auth' => [
                    'username' => env('CREDIT_USERNAME'),
                    'password' => env('CREDIT_PASSWORD')
                ],
                'data' => [
                    'bureau' => 'efx',
                    'contact' => [],
                    'address' => []
                ]
            ])->dump();
        }

        /**
         * @test
         */
        public function loading() {
            $class = new \ReflectionClass(\DateTime::class);

            dump($class->getMethod('not-exist'));
        }

        /**
         * @test
         */
        public function adc() {
            $auth = new ADCAuth(env('ADC_USERNAME'), env('ADC_PASSWORD'));

            $dealer = new GetRepList($auth);

            dump($dealer->get());
        }

        /**
         * @test
         */
        public function docusign_send() {
            $this->withoutExceptionHandling();
            $this->post('/api/credit/pull-new', [])->dump();

            //$auth = DocusignAuthFactory::authenticate([
            //    'Username' => env('DOCUSIGN_DEV_USERNAME'),
            //    'Password' => env('DOCUSIGN_DEV_PASSWORD'),
            //    'IntegratorKey' => env('DOCUSIGN_DEV_INTEGRATOR_KEY'),
            //])->setHost(env('DOCUSIGN_DEV_HOST'));
            //
            //$docusign = new Docusign($auth);
            //
            //$salesperson = [
            //    'role' => 'salesperson',
            //    'firstName' => 'John',
            //    'lastName' => 'Doe',
            //    'email' => 'john.doe@sablecrm.com',
            //    'phone' => '(333) 333-3333',
            //    'licenseNumber' => '100-200-300',
            //];
            //
            //$data = [
            //    'signers' => [
            //        $salesperson,
            //        [
            //            'role' => 'primary',
            //            'firstName' => 'Ainsley',
            //            'lastName' => 'Clarke',
            //            'email' => 'ainsley.clarke@guardme.com',
            //            'phone' => '(111) 111-1111',
            //        ],
            //        //[
            //        //    'role' => 'secondary',
            //        //    'firstName' => 'Bruce',
            //        //    'lastName' => 'Wilson',
            //        //    'email' => 'brucewilson1103@gmail.com',
            //        //    'phone' => '(222) 222-2222',
            //        //],
            //    ],
            //    'salesperson' => $salesperson,
            //    'property' => [
            //        'address' => [
            //            'address1' => '8323 Dietrich Fords',
            //            'address2' => 'Building 1',
            //            'city' => 'Old Bridge',
            //            'state' => 'NJ',
            //            'zip' => '08857',
            //            'type' => 'commercial'
            //        ],
            //        'companyName' => 'Johns Pizza',
            //    ],
            //    'contract' => [
            //        'service' => 'Golden Eye',
            //        'selections' => [
            //            'two way voice',
            //            'cellular back-up',
            //            'cellular primary',
            //            'landline telephone',
            //            'alarm system monitoring',
            //            'burglary',
            //            'flood',
            //            'other',
            //            'hold up',
            //            'medical emergency',
            //            'internet primary',
            //            'internet back-up',
            //            'fire/smoke alarm',
            //            'abnormal temp detection',
            //            'carbon monoxide detection',
            //        ],
            //        'length' => '36',
            //        'paymentDuration' => 'quarterly'
            //    ],
            //    'purchase' => [
            //        'extendedServicePlan' => true,
            //    ],
            //    'billing' => [
            //        'rmr' => 54.95,
            //        'activationFee' => 220.50,
            //        'installLaborCost' => 1385.22
            //    ]
            //];
            //
            //$template = new SecurityPacket($docusign, $data);
            //
            //$envelope = $template->configure($data);
            //
            //$envelope->setStatus('sent');
            //
            //dump($docusign->send($envelope));
        }

        /**
         * @test
         */
        public function docusign_view() {
            $auth = DocusignAuthFactory::authenticate([
                'Username' => env('DOCUSIGN_DEV_USERNAME'),
                'Password' => env('DOCUSIGN_DEV_PASSWORD'),
                'IntegratorKey' => env('DOCUSIGN_DEV_INTEGRATOR_KEY'),
            ])->setHost(env('DOCUSIGN_DEV_HOST'));

            $docusign = new Docusign($auth);

            dump($docusign->view('96a52b13-ee72-4073-85b9-822a9854ade7', 0));
        }

        /**
         * @test
         */
        public function docusign_download() {
            $auth = DocusignAuthFactory::authenticate([
                'Username' => env('DOCUSIGN_DEV_USERNAME'),
                'Password' => env('DOCUSIGN_DEV_PASSWORD'),
                'IntegratorKey' => env('DOCUSIGN_DEV_INTEGRATOR_KEY'),
            ])->setHost(env('DOCUSIGN_DEV_HOST'));

            $docusign = new Docusign($auth);

            $file = $docusign->download('b590da50-1007-498f-aaef-38e1f06407c5');

            $status = Storage::putFileAs('/public', $file->getRealPath(), 'docusign.pdf');

            dump($status);
        }

        /**
         * @test
         */
        public function calc() {
            dump(Carbon::createFromDate('2025/04/11 05:25')->day);
        }
    }

