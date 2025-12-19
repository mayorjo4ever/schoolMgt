
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
    const countDownDate = {{ \Carbon\Carbon::parse($userSchedule->ends_at)->timestamp * 1000 }};

    const x = setInterval(function () {
        const now = new Date().getTime();
        const distance = countDownDate - now;

        if (distance <= 0) {
            clearInterval(x);

            // Lock UI
            document.getElementById("days").innerHTML = 0;
            document.getElementById("hours").innerHTML = 0;
            document.getElementById("minutes").innerHTML = 0;
            document.getElementById("seconds").innerHTML = 0;

            alert('TIME UP! Exam will be submitted now.');

            submitExam(); // ✅ auto-submit
            return;
        }

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById("days").innerHTML = days;
        document.getElementById("hours").innerHTML = hours;
        document.getElementById("minutes").innerHTML = minutes;
        document.getElementById("seconds").innerHTML = seconds;

        if (days <= 0) {
            $('button.days').hide();
        }
    }, 1000);
    
    /** **/
            function submitExam() {
                var exam_id  = $('#exam_id').val(); 
                $.ajax({ headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content') },
                    url: "submit-exam", method: "POST",
                    data: {
                        exam_id:exam_id 
                    },
                    success: function (res) {
                       // console.log(res);
                        window.location.href = res.redirect;
                    },
                    error: function () {
                        alert('Submission failed. Contact admin.');
                    }
                });
            }
</script>

