$(document).ready(function() {
	//Gọi dong hồ
	 if ($('#clock').length) {
        setInterval(updateTime, 1000);
    }
    
   	var weekday=new Array(7);
   	weekday[0]="Chủ nhật";
   	weekday[1]="Thứ hai";
   	weekday[2]="Thứ ba";
   	weekday[3]="Thứ tư";
   	weekday[4]="Thứ năm";
   	weekday[5]="Thứ sáu";
   	weekday[6]="Thứ bảy";

	function updateTime() {
	    var now = new Date(Date.now() + delta_time);
	    time = addZero(now.getHours()) + ':' + addZero(now.getMinutes()) + ':' + addZero(now.getSeconds());
	    // date = now.getFullYear() + '-' + addZero(now.getMonth() + 1) + '-' + addZero(now.getDate()) + ' ' + weekday[now.getDay()];
	    date = weekday[now.getDay()] + ' ' + addZero(now.getDate()) + '-' + addZero(now.getMonth() + 1) + '-' + now.getFullYear();
	    $('#clock').html('<span class="date">'+time+' | '+date+'</span>');
	}

	function addZero(i) {
	    if (i < 10) {
	        i = "0" + i;
	    }
	    return i;
	}
});
