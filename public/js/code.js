$(function(){
	$.datepicker.setDefaults({
		  showOn: "both",
		  buttonImageOnly: true,
		  buttonImage: "http://localhost/assalamapp/public/images/datepicker.png",
		  buttonText: "تقويم",
		  dateFormat: "dd-mm-yy",
		  isRTL: true,
		  showAnim: "fadeIn",
		  firstDay: 1,
		  changeYear: true,
		  changeMonth: true,
		  yearRange: "1950:",
		  nextText: "التالي", 
		  prevText: "السابق",
		  //dayNamesMin: [ "Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa" ],
		 // dayNames: [ "Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi" ],
		  //dayNamesShort: [ "Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam" ],
		  //monthNames: [ "Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Decembre" ],
		  //monthNamesShort: [ "Jan", "Fev", "Mar", "Avr", "Mai", "Jui", "Jul", "Aoû", "Sep", "Oct", "Nov", "Dec" ],
		  monthNames: [ "يناير", "فبراير", "مارس", "أبريل", "ماي", "يونيو", "يوليوز", "غشت", "شتنبر", "أكتوبر", "نونبر", "دجنبر" ],
		  monthNamesShort: [ "يناير", "فبراير", "مارس", "أبريل", "ماي", "يونيو", "يوليوز", "غشت", "شتنبر", "أكتوبر", "نونبر", "دجنبر" ],
		  dayNames: [ "الأحد", "الاثنين", "الثلاثاء", "الأربعاء", "الخميس", "الجمعة", "السبت" ],
		  dayNamesMin: [ "الأح","الإ","الث", "الأر", "الخ", "الج", "الس" ]
		  
		});
	
	$('#datepicker').datepicker();
	$('#dateNaissance').datepicker();
    
});