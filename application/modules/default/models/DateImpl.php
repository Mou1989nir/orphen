<?php
//namespace modules\default\models;
class Default_Model_DateImpl  {
  
      public function convToSysDate($mysqlDate){
      	$datetime = strtotime($mysqlDate);
      	$date = date("d/m/Y", $datetime);//H:i:s
      
      	return $date;
      }
      
      public function convToMysql($ordDate){
      	$datetime = strtotime($ordDate);
      	$date = date('Y-m-d', $datetime);
      
      	return $date;
      }
      
      public function frDate(){
          $jour = array("Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi");
          
          $mois = array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");
          
          $datefr = $jour[date("w")]." ".date("d")." ".$mois[date("n")]." ".date("Y");
          
          return $datefr;
      }
      
      public function arDate(){
      	$jour = array("الأحد","الاثنين","الثلاثاء","الأربعاء","الخميس","الجمعة","السبت");
      
      	$mois = array("","يناير","فبراير","مارس","أبريل","ماي","يونيو","يوليوز","غشت","شتنبر","أكتوبر","نونبر","دجنبر");
      
      	$arDate = $jour[date("w")]." ".date("d")." ".$mois[date("n")]." ".date("Y");
      
      	return $arDate;
      }
  
}


?>