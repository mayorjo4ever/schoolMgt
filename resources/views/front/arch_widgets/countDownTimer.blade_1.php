
<style>
p {
  text-align: center;
  font-size: 60px;
  margin-top: 0px;
}
span#days, span#hours, span#minutes, span#seconds {
    font-size: 20px;
}
</style>
<button class="btn btn-dark btn-icon btn-lg days">Day<br/><span class=" font-weight-bolder" id="days"></span></button>
<button class="btn btn-dark btn-icon btn-lg hours">Hour<br/><span class=" font-weight-bolder" id="hours"></span></button>
<button class="btn btn-dark btn-icon btn-lg minutes">Min<br/><span class=" font-weight-bolder" id="minutes"></span></button>
<button class="btn btn-dark btn-icon btn-lg seconds">Sec<br/><span class="font-weight-bolder" id="seconds"></span></button>

<script>
    //  var countDownDate = new Date(dateTo).getTime();
     var countDownDate = new Date("{{$min}}").getTime();
        // Update the count down every 1 second
    var x = setInterval(function() {

      // Get today's date and time
      var now = new Date().getTime();

      // Find the distance between now and the count down date
      var distance = countDownDate - now;

      // Time calculations for days, hours, minutes and seconds
      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);

      // Output the result in an element with id="demo"
      document.getElementById("days").innerHTML = days ;// + "d " + hours + "h "
      // + minutes + "m " + seconds + "s ";
      document.getElementById("hours").innerHTML =  hours; // + "h "
      // + minutes + "m " + seconds + "s ";
      document.getElementById("minutes").innerHTML =  minutes ; //+ "m " + seconds + "s ";

      document.getElementById("seconds").innerHTML =  seconds ; //+ "m " + seconds + "s ";

      if(days<=0){
          $('button.days').hide();
      }

      // If the count down is over, write some text 
      if (distance < 0) {
        clearInterval(x);
        document.getElementById("demo").innerHTML = "TIME UP";
      }
     }, 1000);    
</script>
