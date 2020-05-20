function odliczanie()
	{
	
		var dzisiaj = new Date();
		
		var godzina = dzisiaj.getHours();
		if (godzina<10) godzina = "0"+godzina;
		
		var minuta = dzisiaj.getMinutes();
		if (minuta<10) minuta = "0"+minuta;
		
		var sekunda = dzisiaj.getSeconds();
		if (sekunda<10) sekunda = "0"+sekunda;
		
		document.getElementById("zegar").innerHTML = godzina+":"+minuta+":"+sekunda;
		 
		setTimeout("odliczanie()",1000);
		 
		 var time = new Date().getTime();
		$(document.body).bind("mousemove keypress", function(e) {
         time = new Date().getTime();
     });

     function refresh() {
         if(new Date().getTime() - time >= 60000) 
             window.location.reload(true);
         else 
             setTimeout(refresh, 10000);
     }

     setTimeout(refresh, 10000);
	}
	