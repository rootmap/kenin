<script src="{{asset('site/js/jquery-3.4.1.min.220afd743d.js')}}" type="text/javascript" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="{{asset('site/js/main.js')}}" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="{{asset('site/css/jquery.datetimepicker.min.css')}}"/>
<script src="{{asset('site/js/jquery.datetimepicker.js')}}"></script>
<script src="{{asset('site/js/site.js')}}"></script>
<!-- [if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->
<script>
    /* Booking Validation on Date STart */
    function KeninformateDateTime(keninTime){
        var m = new Date(keninTime);
        var dateString =
            m.getUTCFullYear() + "-" +
            ("0" + (m.getMonth()+1)).slice(-2) + "-" +
            ("0" + m.getDate()).slice(-2) + " 12:00";
        console.log(dateString);
        return dateString;
        
    }

    $(document).ready(function () {
        var dateToday = new Date(); 
        $('#datetimepicker').datetimepicker({
            format:'Y-m-d H:i',
            inline:false,
            minDate: dateToday,
            allowTimes:[
                '12:00'
            ],
            onClose: function( selectedDate ) {
                var keninTime=KeninformateDateTime(selectedDate);
                $('#datetimepicker').val(keninTime);
            }
        });
        var selectedDate = '';
        

        $('#datetimepicker2').datetimepicker({
            format:'Y-m-d H:i',
            inline:false,
            minDate: dateToday,
            allowTimes:[
                '12:00'
            ],
            onClose: function( selectedDate ) {
                var dateToday = new Date(); 
                $("#datetimepicker" ).datetimepicker({maxDate:selectedDate,minDate:dateToday});
                var keninTime=KeninformateDateTime(selectedDate);
                $('#datetimepicker4').val(keninTime);
                $('#datetimepicker2').val(keninTime);
            }
        });

        $('#datetimepicker3').datetimepicker({
            format:'Y-m-d H:i',
            inline:false,
            minDate: dateToday,
            allowTimes:[
                '12:00'
            ],
            onClose: function( selectedDate ) {
                var keninTime=KeninformateDateTime(selectedDate);
                $('#datetimepicker').val(keninTime);
                $('#datetimepicker3').val(keninTime);
            }
        });

        $('#datetimepicker4').datetimepicker({
            format:'Y-m-d H:i',
            inline:false,
            minDate: dateToday,
            allowTimes:[
                '12:00'
            ],
            onClose: function( selectedDate ) {
                var dateToday = new Date(); 
                $("#datetimepicker3" ).datetimepicker({maxDate:selectedDate,minDate:dateToday});
                var keninTime=KeninformateDateTime(selectedDate);
                $('#datetimepicker2').val(keninTime);
                $('#datetimepicker4').val(keninTime);
            }
        });
    });
</script>