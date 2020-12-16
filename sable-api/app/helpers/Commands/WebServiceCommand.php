<?php
    namespace Helpers\Commands;
    
    use Exception;
    use Helpers\WebServiceGenerators\GenerateADCCustomerManagement;
    use Helpers\WebServiceGenerators\GenerateADCDealerManagement;
    use Helpers\WebServiceGenerators\GenerateADCLeadsService;
    use Helpers\WebServiceGenerators\GenerateMoniBounce;
    use Helpers\WebServiceGenerators\GenerateMoniContract;
    use Helpers\WebServiceGenerators\GenerateMoniFunding;
    use Helpers\WebServiceGenerators\GenerateMoniWSI;
    use Helpers\WebServiceGenerators\GenerateRapidWeb;
    use Illuminate\Console\Command;
    use Symfony\Component\Console\Input\InputArgument;

    class WebServiceCommand extends Command
    {
        /**
         * The name and signature of the console command.
         * @var string
         */
        protected $signature = 'wsdl';

        protected $services = [
            'adc:customer-management' => GenerateADCCustomerManagement::class,
            'adc:dealer-management' => GenerateADCDealerManagement::class,
            'adc:leads-service' => GenerateADCLeadsService::class,
            'moni:bounce' => GenerateMoniBounce::class,
            'moni:contract' => GenerateMoniContract::class,
            'moni:wsi' => GenerateMoniWSI::class,
            'moni:funding' => GenerateMoniFunding::class,
            'rapid-web' => GenerateRapidWeb::class,
        ];

        /**
         * The console command description.
         * @var string
         */
        protected $description = 'Generates php classes for soap api in /vendor/generated from a wsdl url';

        /**
         * Create a new command instance.
         * @return void
         */
        public function __construct() {
            parent::__construct();
            $this->addArgument('service', InputArgument::REQUIRED, 'Service to generate.');
        }

        /**
         * Execute the console command.
         * @return mixed
         */
        public function handle() {
            $service = $this->services[$this->argument('service')];
            
            try {
                $this->alert("Starting file generation for {$service} service.");
                new $service();
                $this->info("Successfully generated files for {$service} service.");
            } catch(Exception $e) {
                $this->error("Invalid service {$service}!");
                $this->error($e->getMessage());
            }
        }
    }

