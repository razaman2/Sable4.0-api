<?php

    use DocuSign\eSign\Model\EnvelopeEvent;
    use DocuSign\eSign\Model\EventNotification;
    use Helpers\ADC\ADCAuth;
    use Helpers\ADC\CustomerManagement\GetBestPractices;
    use Helpers\ADC\CustomerManagement\GetDevices;
    use Helpers\ADC\DealerManagement\GetDealerID;
    use Helpers\ADC\DealerManagement\GetPackages;
    use Helpers\ADC\DealerManagement\GetRepList;
    use Helpers\ADC\LeadsService\GetTransferLeadList;
    use Helpers\Docusign\Auth\DocusignAuthFactory;
    use Helpers\Docusign\Docusign;
    use Helpers\Docusign\VIO\packets\SecurityPacket;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Redirect;
    use Illuminate\Support\Facades\Route;
    use Inertia\Inertia;
    use WebService\ADC\DealerManagement\EnumType\AccountTypeEnum;

    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | contains the "web" middleware group. Now create something great!
    |
    */

    Route::get('/', function() {
        return view('welcome');
    });

    Route::get('/rep-list', function(ADCAuth $auth) {
        $dealer = new GetRepList($auth);

        dump($dealer->get());
    });

    Route::get('/rep-validate/{username}', function(ADCAuth $auth, $username) {
        $dealer = new GetRepList($auth);

        //dump("user input {$username}", $dealer->validate($username));

        return Inertia::render('user', ['name' => $dealer->validate($username)]);
    });

    Route::get('/dealer', function(ADCAuth $auth) {
        $dealer = new GetDealerID($auth);

        return Inertia::render('index', ["dealer" => $dealer->get()->GetDealerIdResult]);
    });

    Route::get('/packages/{filter?}', function(ADCAuth $auth, $filter = 'none') {
        $filters = [
            "video" => AccountTypeEnum::VALUE_VIDEO,
            "security" => AccountTypeEnum::VALUE_SECURITY,
            "none" => AccountTypeEnum::VALUE_NOT_SET,
        ];

        $dealer = new GetPackages($auth);

        dump($dealer->get($filters[$filter]));
    });

    Route::get('/leads', function(ADCAuth $auth) {
        $dealer = new GetTransferLeadList($auth);

        dump($dealer->get());
    });

    Route::get('/best-practices/{id}', function(ADCAuth $auth, $id) {
        $dealer = new GetBestPractices($auth);

        dump($dealer->get($id));
    });

    Route::get('/zones/{id}', function(ADCAuth $auth, $id) {
        $dealer = new GetDevices($auth);

        dump($dealer->getDeviceList($id));
    });


    // Docusign
    Route::get('/docusign', function() {
        return Inertia::render('contract');
    });

    Route::post('/view', function(Request $request) {
        $auth = DocusignAuthFactory::authenticate([
            'Username' => env('DOCUSIGN_DEV_USERNAME'),
            'Password' => env('DOCUSIGN_DEV_PASSWORD'),
            'IntegratorKey' => env('DOCUSIGN_DEV_INTEGRATOR_KEY'),
        ])->setHost(env('DOCUSIGN_DEV_HOST'));

        $docusign = new Docusign($auth);

        $links = $docusign->view($request->input('id'), $request->input('sequence'));

        return Inertia::render('contract', ['url' => "{$links['url']}"]);
    });

    Route::get('/signers', function(Request $request) {
        return Inertia::render('signers');
    });

    Route::post('/signers', function(Request $request) {
        $auth = DocusignAuthFactory::authenticate([
            'Username' => env('DOCUSIGN_DEV_USERNAME'),
            'Password' => env('DOCUSIGN_DEV_PASSWORD'),
            'IntegratorKey' => env('DOCUSIGN_DEV_INTEGRATOR_KEY'),
        ])->setHost(env('DOCUSIGN_DEV_HOST'));

        $docusign = new Docusign($auth);

        $signers = $docusign->recipients($request->input('id'));

        return Inertia::render('signers', ['signers' => dump($signers)]);
    });

    Route::post('/docusign', function() {
        $auth = DocusignAuthFactory::authenticate([
            'Username' => env('DOCUSIGN_DEV_USERNAME'),
            'Password' => env('DOCUSIGN_DEV_PASSWORD'),
            'IntegratorKey' => env('DOCUSIGN_DEV_INTEGRATOR_KEY'),
        ])->setHost(env('DOCUSIGN_DEV_HOST'));

        $docusign = new Docusign($auth);

        $salesperson = [
            'role' => 'salesperson',
            'firstName' => 'John',
            'lastName' => 'Doe',
            'email' => 'john.doe@sablecrm.com',
            'phone' => '(333) 333-3333',
            'licenseNumber' => '100-200-300',
        ];

        $data = [
            'passcode'=>'passcodeEX',
            'signers' => [
                $salesperson,
                [
                    'role' => 'primary',
                    'firstName' => 'Ainsley',
                    'lastName' => 'Clarke',
                    'email' => 'ainsley.clarke@guardme.com',
                    'phone' => '(111) 111-1111',
                ],
                [
                    'role' => 'secondary',
                    'firstName' => 'Bruce',
                    'lastName' => 'Wilson',
                    'email' => 'brucewilson1103@gmail.com',
                    'phone' => '(222) 222-2222',
                ],
            ],
            'contacts'=>[
                [
                    'firstName' => 'EMerAinsley',
                    'lastName' => 'Clarke',
                    'order' => 1,
                    'email' => 'ainsley.clarke@guardme.com',
                    'phone' => '(111) 111-1111',
                    'passcode' => '1111',
                ],
                [
                    'firstName' => 'EMerBruce',
                    'lastName' => 'Wilson',
                    'order' => 2,
                    'email' => 'brucewilson1103@gmail.com',
                    'phone' => '(222) 222-2222',
                    'passcode' => '(222)',
                ],
            ],
            'salesperson' => $salesperson,
            'event'=>[
                'date' => '12/3/2020',
                'time' => '05:25'
            ],
            'property' => [
                'address' => [
                    'address1' => '8323 Dietrich Fords',
                    'address2' => 'Building 1',
                    'city' => 'Old Bridge',
                    'state' => 'NJ',
                    'zip' => '08857',
                    'type' => 'commercial',
                    'name' => 'Johns Pizza',
                    'phone' => '888-987-8989'
                ],
                'companyName' => 'Sable 4.0'
            ],
            'contract' => [
                'selections' => [
                    'two way voice',
                    'cellular back-up',
                    'cellular primary',
                    'landline telephone',
                    'alarm system monitoring',
                    'burglary',
                    'flood',
                    'other',
                    'hold up',
                    'medical emergency',
                    'internet primary',
                    'internet back-up',
                    'fire/smoke alarm',
                    'abnormal temp detection',
                    'carbon monoxide detection',
                ],
                'length'=> '36',
                'paymentDuration'=>'quarterly'
            ],
            'purchase' => [
                'extendedServicePlan' => true,
            ],
            'equipment' => [
                'total'=>'575',
               'list'=>[
                   [
                       'name' => 'first motion',
                       'quantity' => '5',
                       'price' => '7',
                       'total' => '12',
                       'actual' => '12',
                   ],
                   [
                       'name' => 'smoke 2',
                       'quantity' => '5',
                       'price' => '7',
                       'total' => '12',
                       'actual' => '12',
                   ],
                   [
                       'name' => 'motion 3',
                       'quantity' => '5',
                       'price' => '7',
                       'total' => '12',
                       'actual' => '12',
                   ],
                   [
                       'name' => 'smoke 4',
                       'quantity' => '5',
                       'price' => '7',
                       'total' => '12',
                       'actual' => '12',
                   ],
                   [
                       'name' => 'motion 5',
                       'quantity' => '5',
                       'price' => '7',
                       'total' => '12',
                       'actual' => '12',
                   ],
                   [
                       'name' => '6 smoke',
                       'quantity' => '5',
                       'price' => '7',
                       'total' => '12',
                       'actual' => '12',
                   ],
                   [
                       'name' => 'motion 7',
                       'quantity' => '5',
                       'price' => '7',
                       'total' => '12',
                       'actual' => '12',
                   ],
                   [
                       'name' => '8th one',
                       'quantity' => '5',
                       'price' => '7',
                       'total' => '12',
                       'actual' => '12',
                   ],
                   [
                       'name' => 'last',
                       'quantity' => '5',
                       'price' => '7',
                       'total' => '12',
                       'actual' => '12',
                   ],
                   [
                       'name' => 'extra',
                       'quantity' => '5',
                       'price' => '7',
                       'total' => '12',
                       'actual' => '12',
                   ]
               ]
            ],
            'billing' => [
                'address' => [
                    'address1'=>'988',
                    'city'=>'old bridge',
                    'state'=>'nj',
                    'zip'=>'12345',
                ],
                'activationFee'=>'333',
                'installLaborCost'=>'43',
                'discounts'=>'888',
                'equipmentFee'=>'333',
                'taxAvalara'=>'555',
                'totalBeforeTax'=>'899',
                'rmr'=>'10',
                'total'=>'988',
                'tax'=>'342',
            ],
            'payments' => [
                [
                    'type' => 'credit card',
                    'payment' => [
                            'cardNumber' => '43',
                            'expiration' => '12/43',
                            'cvv' => '123',
                            'type' => '123',
                    ]
                ],
                [
                    'type'=>'ach',
                    'payment' => [
                            'routingNumber' => '43',
                            'accountNumber' => '43',
                            'bankName' => '43',
                    ]
                ]
            ]
        ];

        $template = new SecurityPacket($docusign, $data);

        $envelope = $template->configure($data);
        $envelope->setStatus('sent');
        $envelope->setEventNotification((new EventNotification())->setUrl(env('FIREBASE_FUNCTIONS_URL').'/Docusign-Status')->setEnvelopeEvents([
            (new EnvelopeEvent())->setEnvelopeEventStatusCode("sent"),
            (new EnvelopeEvent())->setEnvelopeEventStatusCode("completed"),
        ]));

        return Inertia::render('contract', ["contract" => json_decode($docusign->send($envelope))]);
    });
