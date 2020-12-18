<?php
    
    namespace App\Helpers\ADC\Enums;
    
    use App\Helpers\ApiBuilder\BaseEnum;
    use Wsdl\ADC\CustomerManagement\EnumType\CultureEnum;

    class Culture extends BaseEnum
    {
        public function unknown() {
            $this->data(CultureEnum::VALUE_UNKNOWN);
        }
        
        public function frenchCanada() {
            $this->data(CultureEnum::VALUE_FRENCH_CANADA);
        }
        
        public function spanishUS() {
            $this->data(CultureEnum::VALUE_SPANISH_US);
        }
        
        public function portugueseBrazil() {
            $this->data(CultureEnum::VALUE_PORTUGUESE_BRAZIL);
        }
        
        public function spanishMexico() {
            $this->data(CultureEnum::VALUE_SPANISH_MEXICO);
        }
        
        public function englishSouthAfrica() {
            $this->data(CultureEnum::VALUE_ENGLISH_SOUTH_AFRICA);
        }
        
        public function spanishChile() {
            $this->data(CultureEnum::VALUE_SPANISH_CHILE);
        }
        
        public function spanishArgentina() {
            $this->data(CultureEnum::VALUE_SPANISH_ARGENTINA);
        }
        
        public function spanishColombia() {
            $this->data(CultureEnum::VALUE_SPANISH_COLOMBIA);
        }
        
        public function englishNewZealand() {
            $this->data(CultureEnum::VALUE_ENGLISH_NEW_ZEALAND);
        }
        
        public function spanishPanama() {
            $this->data(CultureEnum::VALUE_SPANISH_PANAMA);
        }
        
        public function spanishCostaRica() {
            $this->data(CultureEnum::VALUE_SPANISH_COSTA_RICA);
        }
        
        public function spanishVenezuela() {
            $this->data(CultureEnum::VALUE_SPANISH_VENEZUELA);
        }
        
        public function englishTrinidadTobago() {
            $this->data(CultureEnum::VALUE_ENGLISH_TRINIDAD_TOBAGO);
        }
        
        public function spanishEcuador() {
            $this->data(CultureEnum::VALUE_SPANISH_ECUADOR);
        }
        
        public function turkishTurkey() {
            $this->data(CultureEnum::VALUE_TURKISH_TURKEY);
        }
        
        public function englishJamaica() {
            $this->data(CultureEnum::VALUE_ENGLISH_JAMAICA);
        }
        
        public function englishCaribbean() {
            $this->data(CultureEnum::VALUE_ENGLISH_CARIBBEAN);
        }
        
        public function englishUK() {
            $this->data(CultureEnum::VALUE_ENGLISH_UK);
        }
        
        public function spanishSpain() {
            $this->data(CultureEnum::VALUE_SPANISH_SPAIN);
        }
        
        public function dutchNetherlands() {
            $this->data(CultureEnum::VALUE_DUTCH_NETHERLANDS);
        }
        
        public function frenchFrance() {
            $this->data(CultureEnum::VALUE_FRENCH_FRANCE);
        }
        
        public function norwegianBokmalNorway() {
            $this->data(CultureEnum::VALUE_NORWEGIAN_BOKMAL_NORWAY);
        }
        
        public function portuguesePortugal() {
            $this->data(CultureEnum::VALUE_PORTUGUESE_PORTUGAL);
        }
        
        public function swedishSweden() {
            $this->data(CultureEnum::VALUE_SWEDISH_SWEDEN);
        }
        
        public function englishCanada() {
            $this->data(CultureEnum::VALUE_ENGLISH_CANADA);
        }
        
        public function icelandicIceland() {
            $this->data(CultureEnum::VALUE_ICELANDIC_ICELAND);
        }
        
        public function hebrewIsrael() {
            $this->data(CultureEnum::VALUE_HEBREW_ISRAEL);
        }
        
        public function japaneseJapan() {
            $this->data(CultureEnum::VALUE_JAPANESE_JAPAN);
        }
        
        public function testNumeric() {
            $this->data(CultureEnum::VALUE_TEST_NUMERIC);
        }
    
        public function englishUS() {
            $this->data(CultureEnum::VALUE_ENGLISH_US);
        }
    
        public function default() {
            $this->englishUS();
        }
    }