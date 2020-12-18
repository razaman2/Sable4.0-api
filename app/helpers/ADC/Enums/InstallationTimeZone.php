<?php
    
    namespace App\Helpers\ADC\Enums;
    
    use App\Helpers\ApiBuilder\BaseEnum;
    use Wsdl\ADC\CustomerManagement\EnumType\TimeZoneEnum;

    class InstallationTimeZone extends BaseEnum
    {
        public function notSet() {
            $this->data(TimeZoneEnum::VALUE_NOT_SET);
        }
        
        public function central() {
            $this->data(TimeZoneEnum::VALUE_CENTRAL);
        }
        
        public function mountain() {
            $this->data(TimeZoneEnum::VALUE_MOUNTAIN);
        }
        
        public function pacific() {
            $this->data(TimeZoneEnum::VALUE_PACIFIC);
        }
        
        public function alaska() {
            $this->data(TimeZoneEnum::VALUE_ALASKA);
        }
        
        public function hawaii() {
            $this->data(TimeZoneEnum::VALUE_HAWAII);
        }
        
        public function westSamoa() {
            $this->data(TimeZoneEnum::VALUE_WEST_SAMOA);
        }
        
        public function atlanticNoDST() {
            $this->data(TimeZoneEnum::VALUE_ATLANTIC_NO_DST);
        }
        
        public function guam() {
            $this->data(TimeZoneEnum::VALUE_GUAM);
        }
        
        public function palau() {
            $this->data(TimeZoneEnum::VALUE_PALAU);
        }
        
        public function arizona() {
            $this->data(TimeZoneEnum::VALUE_ARIZONA);
        }
        
        public function newfoundland() {
            $this->data(TimeZoneEnum::VALUE_NEWFOUNDLAND);
        }
        
        public function atlantic() {
            $this->data(TimeZoneEnum::VALUE_ATLANTIC);
        }
        
        public function easternNoDST() {
            $this->data(TimeZoneEnum::VALUE_EASTERN_NO_DST);
        }
        
        public function centralNoDST() {
            $this->data(TimeZoneEnum::VALUE_CENTRAL_NO_DST);
        }
        
        public function hawaiiAleutian() {
            $this->data(TimeZoneEnum::VALUE_HAWAII_ALEUTIAN);
        }
        
        public function wakeIsland() {
            $this->data(TimeZoneEnum::VALUE_WAKE_ISLAND);
        }
        
        public function pohnpei() {
            $this->data(TimeZoneEnum::VALUE_POHNPEI);
        }
        
        public function brasilia() {
            $this->data(TimeZoneEnum::VALUE_BRASILIA);
        }
        
        public function centralBrazilian() {
            $this->data(TimeZoneEnum::VALUE_CENTRAL_BRAZILIAN);
        }
        
        public function amazon() {
            $this->data(TimeZoneEnum::VALUE_AMAZON);
        }
        
        public function braziliaNoDST() {
            $this->data(TimeZoneEnum::VALUE_BRAZILIA_NO_DST);
        }
        
        public function fernando() {
            $this->data(TimeZoneEnum::VALUE_FERNANDO);
        }
        
        public function muchosransk() {
            $this->data(TimeZoneEnum::VALUE_MUCHOSRANSK);
        }
        
        public function centralMexico() {
            $this->data(TimeZoneEnum::VALUE_CENTRAL_MEXICO);
        }
        
        public function mountainMexico() {
            $this->data(TimeZoneEnum::VALUE_MOUNTAIN_MEXICO);
        }
        
        public function mountainMexicoNoDST() {
            $this->data(TimeZoneEnum::VALUE_MOUNTAIN_MEXICO_NO_DST);
        }
        
        public function pacificMexico() {
            $this->data(TimeZoneEnum::VALUE_PACIFIC_MEXICO);
        }
        
        public function southAfrican() {
            $this->data(TimeZoneEnum::VALUE_SOUTH_AFRICAN);
        }
        
        public function chile() {
            $this->data(TimeZoneEnum::VALUE_CHILE);
        }
        
        public function easterIsland() {
            $this->data(TimeZoneEnum::VALUE_EASTER_ISLAND);
        }
        
        public function argentina() {
            $this->data(TimeZoneEnum::VALUE_ARGENTINA);
        }
        
        public function colombia() {
            $this->data(TimeZoneEnum::VALUE_COLOMBIA);
        }
        
        public function newZealand() {
            $this->data(TimeZoneEnum::VALUE_NEW_ZEALAND);
        }
        
        public function turkey() {
            $this->data(TimeZoneEnum::VALUE_TURKEY);
        }
        
        public function centralAfrica() {
            $this->data(TimeZoneEnum::VALUE_CENTRAL_AFRICA);
        }
        
        public function venezuela() {
            $this->data(TimeZoneEnum::VALUE_VENEZUELA);
        }
        
        public function peru() {
            $this->data(TimeZoneEnum::VALUE_PERU);
        }
        
        public function ecuador() {
            $this->data(TimeZoneEnum::VALUE_ECUADOR);
        }
        
        public function australianEastern() {
            $this->data(TimeZoneEnum::VALUE_AUSTRALIAN_EASTERN);
        }
        
        public function australianCentral() {
            $this->data(TimeZoneEnum::VALUE_AUSTRALIAN_CENTRAL);
        }
        
        public function christmasIsland() {
            $this->data(TimeZoneEnum::VALUE_CHRISTMAS_ISLAND);
        }
        
        public function norfolk() {
            $this->data(TimeZoneEnum::VALUE_NORFOLK);
        }
        
        public function australianWestern() {
            $this->data(TimeZoneEnum::VALUE_AUSTRALIAN_WESTERN);
        }
    
        public function gmt() {
            $this->data(TimeZoneEnum::VALUE_GMT);
        }
        
        public function centralEuropean() {
            $this->data(TimeZoneEnum::VALUE_CENTRAL_EUROPEAN);
        }
        
        public function westernEuropean() {
            $this->data(TimeZoneEnum::VALUE_WESTERN_EUROPEAN);
        }
    
        public function gmtNoDST() {
            $this->data(TimeZoneEnum::VALUE_GMTNO_DST);
        }
        
        public function uruguayTime() {
            $this->data(TimeZoneEnum::VALUE_URUGUAY_TIME);
        }
        
        public function paraguayTime() {
            $this->data(TimeZoneEnum::VALUE_PARAGUAY_TIME);
        }
        
        public function boliviaTime() {
            $this->data(TimeZoneEnum::VALUE_BOLIVIA_TIME);
        }
        
        public function westAfricaTime() {
            $this->data(TimeZoneEnum::VALUE_WEST_AFRICA_TIME);
        }
        
        public function australianEasternNoDst() {
            $this->data(TimeZoneEnum::VALUE_AUSTRALIAN_EASTERN_NO_DST);
        }
        
        public function australianCentralNoDst() {
            $this->data(TimeZoneEnum::VALUE_AUSTRALIAN_CENTRAL_NO_DST);
        }
        
        public function indiaStandardTime() {
            $this->data(TimeZoneEnum::VALUE_INDIA_STANDARD_TIME);
        }
        
        public function easternMexico() {
            $this->data(TimeZoneEnum::VALUE_EASTERN_MEXICO);
        }
        
        public function indochinaTime() {
            $this->data(TimeZoneEnum::VALUE_INDOCHINA_TIME);
        }
        
        public function fiji() {
            $this->data(TimeZoneEnum::VALUE_FIJI);
        }
        
        public function greenwichMeanTimeIreland() {
            $this->data(TimeZoneEnum::VALUE_GREENWICH_MEAN_TIME_IRELAND);
        }
        
        public function malaysiaTime() {
            $this->data(TimeZoneEnum::VALUE_MALAYSIA_TIME);
        }
        
        public function testTimezone() {
            $this->data(TimeZoneEnum::VALUE_TEST_TIMEZONE);
        }
        
        public function gulfStandardTime() {
            $this->data(TimeZoneEnum::VALUE_GULF_STANDARD_TIME);
        }
        
        public function philippineTime() {
            $this->data(TimeZoneEnum::VALUE_PHILIPPINE_TIME);
        }
        
        public function easternEuropeanTime() {
            $this->data(TimeZoneEnum::VALUE_EASTERN_EUROPEAN_TIME);
        }
        
        public function japanStandardTime() {
            $this->data(TimeZoneEnum::VALUE_JAPAN_STANDARD_TIME);
        }
        
        public function arabStandardTime() {
            $this->data(TimeZoneEnum::VALUE_ARAB_STANDARD_TIME);
        }
        
        public function israelStandardTime() {
            $this->data(TimeZoneEnum::VALUE_ISRAEL_STANDARD_TIME);
        }
        
        public function singaporeTime() {
            $this->data(TimeZoneEnum::VALUE_SINGAPORE_TIME);
        }
        
        public function centralEuropeanTime() {
            $this->data(TimeZoneEnum::VALUE_CENTRAL_EUROPEAN_TIME);
        }
    
        public function gtbStandardTime() {
            $this->data(TimeZoneEnum::VALUE_GTBSTANDARD_TIME);
        }
        
        public function guyanaTime() {
            $this->data(TimeZoneEnum::VALUE_GUYANA_TIME);
        }
        
        public function centralTimeBelize() {
            $this->data(TimeZoneEnum::VALUE_CENTRAL_TIME_BELIZE);
        }
        
        public function easternEuropeanTimeFinland() {
            $this->data(TimeZoneEnum::VALUE_EASTERN_EUROPEAN_TIME_FINLAND);
        }
        
        public function westernIndonesianTime() {
            $this->data(TimeZoneEnum::VALUE_WESTERN_INDONESIAN_TIME);
        }
        
        public function centralIndonesianTime() {
            $this->data(TimeZoneEnum::VALUE_CENTRAL_INDONESIAN_TIME);
        }
        
        public function easternIndonesianTime() {
            $this->data(TimeZoneEnum::VALUE_EASTERN_INDONESIAN_TIME);
        }
    
        public function eastern() {
            $this->data(TimeZoneEnum::VALUE_EASTERN);
        }
    
        //public function taipeiStandardTime() {
        //    $this->value = "TaipeiStandardTime";
        //}
    
        public function default() {
            $this->notSet();
        }
    }