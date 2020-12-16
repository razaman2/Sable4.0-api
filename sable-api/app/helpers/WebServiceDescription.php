<?php
    
    namespace Helpers;
    
    use Helpers\Interfaces\Authenticateable;
    use Helpers\Interfaces\Authentication;
    use Helpers\Interfaces\Logable;
    use WsdlToPhp\PackageBase\AbstractSoapClientBase;
    
    abstract class WebServiceDescription
    {
        protected $logger;
        
        protected $operation;
        
        public function __construct(...$params) {
            $this->operation = $this->setOperation();
            
            array_walk($params, function($param) {
                if($param instanceof Logable) {
                    $this->logger = $param;
                }
                
                if($param instanceof Authentication) {
                    if($this instanceof Authenticateable) {
                        $this->authenticate($param);
                    }
                }
            });
        }
        
        protected function execute($operation, callable $callback) {
            $this->log($this->operation->getLastRequest());
            
            if($operation !== false) {
                $this->log($this->operation->getResult());
                
                return call_user_func($callback, $this->operation->getResult());
            } else {
                $this->log($this->operation->getLastError());
                
                return $this->operation->getLastError();
            }
        }
        
        protected function log($data) {
            if($this->logger) {
                $this->logger->log($data);
            }
        }
        
        protected function options() : array {
            return [AbstractSoapClientBase::WSDL_URL => "{$this->getUrl()}?wsdl"];
        }
        
        protected abstract function setOperation();
        
        protected abstract function getUrl() : string;
    }
