$(document).ready(function() {
	time();
});

	// TAO DONG HO
function time() {
   var today = new Date();
   var weekday=new Array(7);
   weekday[0]="Chủ nhật";
   weekday[1]="Thứ hai";
   weekday[2]="Thứ ba";
   weekday[3]="Thứ tư";
   weekday[4]="Thứ năm";
   weekday[5]="Thứ sáu";
   weekday[6]="Thứ bảy";
   var day = weekday[today.getDay()]; 
   var dd = today.getDate();
   var mm = today.getMonth()+1; //January is 0!
   var yyyy = today.getFullYear();
   var h=today.getHours();
   var m=today.getMinutes();
   var s=today.getSeconds();
   m=checkTime(m);
   s=checkTime(s);
   nowTime = h+":"+m+":"+s;
   if(dd<10){dd='0'+dd} if(mm<10){mm='0'+mm} today = day+', '+ dd+'/'+mm+'/'+yyyy;

   tmp='<span class="date">'+today+' | '+nowTime+'</span>';

   document.getElementById("clock").innerHTML=tmp;

   clocktime=setTimeout("time()","1000","JavaScript");
   function checkTime(i)
   {
      if(i<10){
	 i="0" + i;
      }
      return i;
   }
}
