
var currentposition1;
if(navigator.geolocation)
 {


 currentposition1 =  navigator.geolocation.getCurrentPosition(function(position){
    document.getElementById("main").innerHTML = `<iframe height="250px" width="250px" src= "https://www.openstreetmap.org/export/embed.html?bbox=${position.coords.longitude},${position.coords.latitude},&layer=mapnik"></iframe>`;
  
       console.log(position);
      
   },function(error){  console.log(error); } 
   
   );

 }