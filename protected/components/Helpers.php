<?php

/**
 * Various common functions
 */
class DateHelper extends CComponent{
        public static function getMonths() {
                $m=array('1','2','3','4','5','6','7','8','9','10','11','12');
                return array_combine(range(1,12),$m);
        }
        public static function getDays() {
            $m=array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31');
            return array_combine(range(1,31),$m);
        }
        public static function getYears() {
                return array_combine($a=range((date('Y') - 18),(date('Y') - 60)),$a);
        }
}