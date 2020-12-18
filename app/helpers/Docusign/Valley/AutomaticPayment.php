<?php
    
    namespace App\Helpers\Docusign\Valley;
    
    use App\Helpers\Docusign\Exceptions\InvalidTabException;
    use App\Helpers\Docusign\Interfaces\Defaultable;
    use App\Helpers\Docusign\TemplateTabs;
    use Carbon\Carbon;

    class AutomaticPayment extends TemplateTabs implements Defaultable
    {
        public function config($properties = []) {
            return parent::config(array_merge($properties, ['name' => 'payment']));
        }
        
        protected function subscriberName($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-subscriber-name")
                ->setXPosition(125)
                ->setYPosition(111)
                ->setLocked(true)
                ->setValue($data);
        }
    
        protected function address($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-address")
                ->setXPosition(117)
                ->setYPosition(136)
                ->setLocked(true)
                ->setValue($data);
        }
    
        protected function city($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-city")
                ->setXPosition(90)
                ->setYPosition(161)
                ->setLocked(true)
                ->setValue($data);
        }
    
        protected function state($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-state")
                ->setXPosition(316)
                ->setYPosition(161)
                ->setLocked(true)
                ->setValue($data);
        }
    
        protected function zip($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-zip")
                ->setXPosition(445)
                ->setYPosition(161)
                ->setLocked(true)
                ->setValue($data);
        }
    
        protected function rmr($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-monthly-amount")
                ->setXPosition(252)
                ->setYPosition(215)
                ->setLocked(true)
                ->setValue($data);
        }
    
        protected function invoiceViaEmail($data) {
            $this->new('checkbox_tabs')
                ->setTabLabel("{$this->config['name']}-invoice-email")
                ->setXPosition(63)
                ->setYPosition(302)
                ->setLocked(true)
                ->setSelected($data);
        }
    
        protected function email($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-email")
                ->setXPosition(377)
                ->setYPosition(303)
                ->setLocked(true)
                ->setValue($data);
        }
    
        protected function OLDmonthlyType($data) {
            $this->new('radio_group_tabs')
                ->setGroupName("{$this->config['name']}-monthly-type")
                ->setRadios([
                    $this->new('radio_tab')
                        ->setAnchorString('on the 1st of each month.')
                        ->setAnchorXOffset(-22)
                        ->setAnchorYOffset(-37)
                        ->setAnchorIgnoreIfNotPresent(false)
                        ->setAnchorUnits('pixels')
                        ->setSelected((boolean) preg_match('/checking/', $data))
                        ->setValue('ach'),
                    $this->new('radio_tab')
                        ->setAnchorString('on the 1st of each month.')
                        ->setAnchorXOffset(75)
                        ->setAnchorYOffset(-37)
                        ->setAnchorIgnoreIfNotPresent(false)
                        ->setAnchorUnits('pixels')
                        ->setSelected((boolean) preg_match('/savings/', $data))
                        ->setValue('ach'),
                    $this->new('radio_tab')
                        ->setAnchorString('on the 1st of each month.')
                        ->setAnchorXOffset(158)
                        ->setAnchorYOffset(-37)
                        ->setAnchorIgnoreIfNotPresent(false)
                        ->setAnchorUnits('pixels')
                        ->setSelected((boolean) preg_match('/credit card/', $data))
                        ->setValue('credit card')
                ]);
        }
    
        protected function OLDaccountNumber($data) {
            $temp = $data;
            if(preg_match('/\*/', $temp)) {
                $data = 123456789000000;
            }
            $digits = preg_split('/\B/', $data);
            if(count($digits) > 15) {
                throw new InvalidTabException('account number cannot be more than 15 digits');
            }
    
            if(preg_match('/\*/', $temp)) {
                $this->new('text_tabs')
                    ->setTabLabel("{$this->config['name']}-account")
                    ->setConditionalParentLabel("{$this->config['name']}-monthly-type")
                    ->setConditionalParentValue('ach')
                    ->setRequired(true)
                    ->setXPosition(185)
                    ->setYPosition(338)
                    ->setWidth(400)
                    ->setLocked(false);
            }
            
            //$x = 120;
            //array_walk($digits, function($digit, $index) use (&$x, $temp) {
            //    if(preg_match('/\*/', $temp)) {
            //        $this->new('text_tabs')
            //            ->setTabLabel("{$this->config['name']}-account{$index}")
            //            ->setConditionalParentLabel("{$this->config['name']}-monthly-type")
            //            ->setConditionalParentValue('ach')
            //            ->setRequired(false)
            //            ->setXPosition(($x - 5))
            //            ->setYPosition(360)
            //            ->setLocked(false);
            //    } else {
            //        $this->new('text_tabs')
            //            ->setTabLabel("{$this->config['name']}-account{$index}")
            //            ->setConditionalParentLabel("{$this->config['name']}-monthly-type")
            //            ->setConditionalParentValue('ach')
            //            ->setRequired(false)
            //            ->setXPosition($x)
            //            ->setYPosition(360)
            //            ->setLocked(false)
            //            ->setValue($digit);
            //    }
            //    $x += 27;
            //});
        }
    
        protected function OLDroutingNumber($data) {
            $temp = $data;
            if(preg_match('/\*/', $temp)) {
                $data = 123456789;
            }
            $digits = preg_split('/\B/', $data);
            if(count($digits) > 9) {
                throw new InvalidTabException('routing number cannot be more than 9 digits');
            }
    
            if(preg_match('/\*/', $temp)) {
                $this->new('text_tabs')
                    ->setTabLabel("{$this->config['name']}-routing")
                    ->setConditionalParentLabel("{$this->config['name']}-monthly-type")
                    ->setConditionalParentValue('ach')
                    ->setRequired(true)
                    ->setXPosition(185)
                    ->setYPosition(388)
                    ->setWidth(400)
                    ->setLocked(false);
            }
            
            //$x = 148;
            //array_walk($digits, function($digit, $index) use (&$x, $temp) {
            //    if(preg_match('/\*/', $temp)) {
            //        $this->new('text_tabs')
            //            ->setTabLabel("{$this->config['name']}-routing{$index}")
            //            ->setConditionalParentLabel("{$this->config['name']}-monthly-type")
            //            ->setConditionalParentValue('ach')
            //            ->setRequired(false)
            //            ->setXPosition($x - 5)
            //            ->setYPosition(410)
            //            ->setLocked(false);
            //    } else {
            //        $this->new('text_tabs')
            //            ->setTabLabel("{$this->config['name']}-routing{$index}")
            //            ->setConditionalParentLabel("{$this->config['name']}-monthly-type")
            //            ->setConditionalParentValue('ach')
            //            ->setRequired(false)
            //            ->setXPosition($x)
            //            ->setYPosition(410)
            //            ->setLocked(false)
            //            ->setValue($digit);
            //    }
            //    $x += 27;
            //});
        }
    
        protected function OLDcreditCardNumber($data) {
            $temp = $data;
            if(preg_match('/\*/', $temp)) {
                $data = 1234567890000000;
            }
            $digits = preg_split('/\B/', $data);
            if(count($digits) > 16) {
                throw new InvalidTabException('card number cannot be more than 16 digits');
            }
    
            if(preg_match('/\*/', $temp)) {
                $this->new('text_tabs')
                    ->setTabLabel("{$this->config['name']}-card")
                    ->setConditionalParentLabel("{$this->config['name']}-monthly-type")
                    ->setConditionalParentValue('credit card')
                    ->setRequired(true)
                    ->setXPosition(183)
                    ->setYPosition(442)
                    ->setWidth(400)
                    ->setLocked(false);
            }
            
            //$x = 94;
            //array_walk($digits, function($digit, $index) use (&$x, $temp) {
            //    if(preg_match('/\*/', $temp)) {
            //        $this->new('text_tabs')
            //            ->setTabLabel("{$this->config['name']}-card{$index}")
            //            ->setConditionalParentLabel("{$this->config['name']}-monthly-type")
            //            ->setConditionalParentValue('credit card')
            //            ->setRequired(false)
            //            ->setXPosition(($x - 5))
            //            ->setYPosition(461)
            //            ->setLocked(false);
            //    } else {
            //        $this->new('text_tabs')
            //            ->setTabLabel("{$this->config['name']}-card{$index}")
            //            ->setConditionalParentLabel("{$this->config['name']}-monthly-type")
            //            ->setConditionalParentValue('credit card')
            //            ->setRequired(false)
            //            ->setXPosition($x)
            //            ->setYPosition(461)
            //            ->setLocked(false)
            //            ->setValue($digit);
            //    }
            //    $x += 27;
            //});
        }
    
        protected function OLDcardType($data) {
            $this->new('radio_group_tabs')
                ->setGroupName("{$this->config['name']}-card-type")
                ->setConditionalParentLabel("{$this->config['name']}-monthly-type")
                ->setConditionalParentValue('credit card')
                ->setRadios([
                    $this->new('radio_tab')
                        ->setAnchorString('Amex')
                        ->setAnchorXOffset(-27)
                        ->setAnchorYOffset(-5)
                        ->setAnchorCaseSensitive(true)
                        ->setAnchorIgnoreIfNotPresent(false)
                        ->setAnchorUnits('pixels')
                        ->setSelected((boolean) preg_match('/amex/i', $data))
                        ->setValue('amex'),
                    $this->new('radio_tab')
                        ->setAnchorString('MC/Visa')
                        ->setAnchorXOffset(-29)
                        ->setAnchorYOffset(-5)
                        ->setAnchorIgnoreIfNotPresent(false)
                        ->setAnchorUnits('pixels')
                        ->setSelected((boolean) preg_match('/mc\/visa/i', $data))
                        ->setValue('mc/visa')
                ]);
        }
    
        protected function OLDexpiration($data) {
            if(preg_match('/\*/', $data)) {
                $this->new('text_tabs')
                    ->setTabLabel("{$this->config['name']}-expiration")
                    ->setConditionalParentLabel("{$this->config['name']}-monthly-type")
                    ->setConditionalParentValue('credit card')
                    ->setXPosition(298)
                    ->setYPosition(484)
                    ->setWidth(60)
                    ->setLocked(false);
            } else {
                $date = explode(' ', Carbon::parse($data)->isoFormat('YYYY MM'));
                $this->new('text_tabs')
                    ->setTabLabel("{$this->config['name']}-expiration")
                    ->setConditionalParentLabel("{$this->config['name']}-monthly-type")
                    ->setConditionalParentValue('credit card')
                    ->setXPosition(298)
                    ->setYPosition(486)
                    ->setLocked(false)
                    ->setValue("{$date[1]}/{$date[0]}");
            }
        }
    
        protected function OLDsecurityCode($data) {
            if(preg_match('/\*/', $data)) {
                $this->new('text_tabs')
                    ->setTabLabel("{$this->config['name']}-security-code")
                    ->setConditionalParentLabel("{$this->config['name']}-monthly-type")
                    ->setConditionalParentValue('credit card')
                    ->setXPosition(484)
                    ->setYPosition(484)
                    ->setWidth(50)
                    ->setLocked(false);
            } else {
                $this->new('text_tabs')
                    ->setTabLabel("{$this->config['name']}-security-code")
                    ->setConditionalParentLabel("{$this->config['name']}-monthly-type")
                    ->setConditionalParentValue('credit card')
                    ->setXPosition(484)
                    ->setYPosition(486)
                    ->setLocked(false)
                    ->setValue($data);
            }
        }
    
        protected function phone1($data) {
            preg_match_all('/^\D*(\d{3})\D*(\d{3})\D*(\d{4})$/', $data, $matches);
            if(empty($matches[0])) {
                throw new InvalidTabException("{$this->config['name']} phone1 is invalid format");
            }
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-phone1-prefix")
                ->setXPosition(383)
                ->setYPosition(572)
                ->setLocked(true)
                ->setValue("{$matches[1][0]}");
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-phone1-postfix")
                ->setXPosition(415)
                ->setYPosition(572)
                ->setLocked(true)
                ->setValue("{$matches[2][0]}-{$matches[3][0]}");
        }
    
        protected function phone2($data) {
            preg_match_all('/^\D*(\d{3})\D*(\d{3})\D*(\d{4})$/', $data, $matches);
            if(count($matches) < 4) {
                throw new InvalidTabException("{$this->config['name']} phone2 is invalid format");
            }
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-phone2-prefix")
                ->setXPosition(382)
                ->setYPosition(606)
                ->setLocked(true)
                ->setValue("{$matches[1][0]}");
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-phone2-postfix")
                ->setXPosition(415)
                ->setYPosition(606)
                ->setLocked(true)
                ->setValue("{$matches[2][0]}-{$matches[3][0]}");
        }
        
        protected function salesperson($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-salesperson")
                ->setXPosition(180)
                ->setYPosition(695)
                ->setLocked(true)
                ->setValue($data);
        }
        
        public function loadDefaults() {
            $this->signature1();
            $this->signature2();
            $this->dateSigned();
            $this->OLDcardType('*');
            $this->OLDmonthlyType('*');
            $this->OLDsecurityCode('*');
            $this->OLDexpiration('*');
            $this->OLDcreditCardNumber('*');
            $this->OLDroutingNumber('*');
            $this->OLDaccountNumber('*');
        }
    
        protected function signature1() {
            $this->new('sign_here_tabs')
                ->setTabLabel("{$this->config['name']}-signature1")
                ->setXPosition(82)
                ->setYPosition(538);
        }
        
        protected function signature2() {
            $this->new('sign_here_tabs')
                ->setTabLabel("{$this->config['name']}-signature2")
                ->setOptional(true)
                ->setXPosition(82)
                ->setYPosition(573);
        }
    
        protected function dateSigned() {
            $this->new('date_signed_tabs')
                ->setTabLabel("{$this->config['name']}-date-signed")
                ->setXPosition(440)
                ->setYPosition(697);
        }
    }
