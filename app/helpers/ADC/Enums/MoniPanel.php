<?php
    
    namespace App\Helpers\ADC\Enums;
    
    class MoniPanel extends PanelType
    {
        //Go Control3 Panels
        public function alarmcomgocontrol33G() {
            $this->goControl3();
        }
        
        public function alarmcomgocontrol33gwifi() {
            $this->goControl3();
        }
        
        public function alarmcomgocontrol3lte() {
            $this->goControl3();
        }
        
        public function alarmcomgocontrol3wifi() {
            $this->goControl3();
        }
        
        //Go Control Panels
        public function alarmcomgocontrolgsm() {
            $this->goControl();
        }
        
        public function alarmcomgocontrollte() {
            $this->goControl();
        }
        
        //Qolsys Panels
        public function alarmcomqolsysiq3g() {
            $this->iqPanel();
        }
    
        public function AlarmcomQolsysIQ23G4G() {
            $this->iqPanel2();
        }
    
        public function alarmcomqolsysiq2lte() {
            $this->iqPanel2();
        }
        
        //DSC Panels
        public function alarmcomdscneo3g() {
            $this->neo();
        }
        
        public function DSC1616() {
            $this->semPowerSeries();
        }
        
        public function alarmcomdscsemlte() {
            $this->neo();
        }
        
        public function alarmcomdsctouchiq3g() {
            $this->neo();
        }
        
        public function dsctouchiq() {
            $this->neo();
        }
        
        public function DSCNEOHS2032() {
            $this->neo();
        }
        
        //GE Concord Panels
        public function geconcord() {
            $this->concord();
        }
        
        public function geconcord4() {
            $this->concord();
        }
        
        public function geconcord4express() {
            $this->concord();
        }
        
        public function geconcordexpress() {
            $this->concord();
        }
        
        public function alarmcomconcordltetw() {
            $this->concord();
        }
        
        public function alarmcomconcordgsmtw() {
            $this->concord();
        }
        
        public function alarmcomconcordgsm() {
            $this->concord();
        }
        
        public function alarmcomconcord3g() {
            $this->concord();
        }
    
        //Honeywell Panels
        public function honeywellVista20p() {
            $this->semVista();
        }
        
        public function honeywellVista15p() {
            $this->semVista();
        }
        
        //GE Simon Panels
        public function alarmcomsimon3gsm() {
            $this->greybox();
        }
        
        public function alarmcomsimonxt3g() {
            $this->greybox();
        }
        
        public function alarmcomsimonxtgsm() {
            $this->greybox();
        }
        
        public function alarmcomsimonxtgsmtw() {
            $this->greybox();
        }
        
        public function alarmcomsimonxtlte() {
            $this->greybox();
        }
        
        public function alarmcomsimonxtltetw() {
            $this->greybox();
        }
        
        public function gesimonversion2() {
            $this->greybox();
        }
        
        public function gesimonversion3() {
            $this->greybox();
        }
        
        public function gesimonversion4() {
            $this->greybox();
        }
        
        public function gesimonxtsia() {
            $this->greybox();
        }
        
        public function gesimonxtv13() {
            $this->greybox();
        }
        
        public function gesimonxtwithsuperswitch() {
            $this->greybox();
        }
        
        public function gesimonxti() {
            $this->greybox();
        }
        
        public function gesimonxti5() {
            $this->greybox();
        }
    }
