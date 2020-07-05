
$(document).ready(function(e){
    $.getScript("https://cdn.jsdelivr.net/npm/sweetalert2@9");
    $("iframe").css("width","100%");
	$("iframe").css("height","500px");
});

var csrftLarVe = $('meta[name="csrf-token"]').attr("content");
function swalErrorMsg(msg) {
    Swal.fire({
        icon: 'error',
        title: '<h3 class="text-danger">Warning</h3>',
        html: '<h5>' + msg + '!!!</h5>'
    });
}

function swalSuccessMsg(msg) {
    Swal.fire({
        icon: 'success',
        title: '<h3 class="text-info">Thank You</h3>',
        html: '<h5>' + msg + '</h5>'
    });
}

function loadingOrProcessing(sms) {
    var strHtml = '';
    strHtml += '<div class="alert alert-icon-right alert-info alert-dismissible fade in mb-2" role="alert">';
    strHtml += '      <i class="icon-spinner10 spinner"></i> ' + sms;
    strHtml += '</div>';
    //strHtml += '<script>setTimeout(function(){ $(".alert-dismissible").hide(); }, 4000);</script>';

    return strHtml;

}

function warningMessage(sms) {
    var strHtml = '';
    strHtml += '<div class="alert alert-icon-left alert-danger alert-dismissible fade in mb-2" role="alert">';
    strHtml += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
    strHtml += '<span aria-hidden="true">×</span>';
    strHtml += '</button>';
    strHtml += sms;
    strHtml += '</div>';
    strHtml += '<script>setTimeout(function(){ $(".alert-dismissible").hide(); }, 4000);</script>';
    return strHtml;
}

function successMessage(sms) {
    var strHtml = '';
    strHtml += '<div class="alert alert-icon-left alert-info alert-dismissible fade in mb-2" role="alert">';
    strHtml += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
    strHtml += '<span aria-hidden="true">×</span>';
    strHtml += '</button>';
    strHtml += sms;
    strHtml += '</div>';
    strHtml += '<script>setTimeout(function(){ $(".alert-dismissible").hide(); }, 4000);</script>';
    return strHtml;
}

$(document).ready(function(){
    // $("#datetimepicker2").click(function(){
    //     var datetimepicker=$("#datetimepicker").val();
    //     if(datetimepicker.length==0){
    //         swalErrorMsg("Please Select Your Arrival Date First.");
    //         return false;
    //     }
    // });

    $(".main-book-now-button").click(function(){

    });
});

/* Booking Validation on Date STart */
function KeninformateDateTime(keninTime){
    var m = new Date(keninTime);
    var dateString =
        m.getUTCFullYear() + "-" +
        ("0" + (m.getMonth()+1)).slice(-2) + "-" +
        ("0" + m.getDate()).slice(-2) + " " +
        ("0" + m.getHours()).slice(-2) + ":" +
        ("0" + m.getMinutes()).slice(-2);
    console.log(dateString);
    return dateString;
    
}

$(document).ready(function () {
    var dateToday = new Date(); 
    $('#datetimepicker').datetimepicker({
        format:'Y-m-d H:i',
        inline:false,
        defaultDate: dateToday,
        minDate: dateToday,
    });
    var selectedDate = '';
    

    $('#datetimepicker2').datetimepicker({
        format:'Y-m-d H:i',
        inline:false,
        minDate: dateToday,
        onClose: function( selectedDate ) {
            var dateToday = new Date(); 
            $("#datetimepicker" ).datetimepicker({maxDate:selectedDate,minDate:dateToday});
            var keninTime=KeninformateDateTime(selectedDate);
            $('#datetimepicker4').val(keninTime);
        }
    });

    $('#datetimepicker3').datetimepicker({
        format:'Y-m-d H:i',
        inline:false,
        defaultDate: dateToday,
        minDate: dateToday,
    });

    $('#datetimepicker4').datetimepicker({
        format:'Y-m-d H:i',
        inline:false,
        minDate: dateToday,
        onClose: function( selectedDate ) {
            var dateToday = new Date(); 
            $("#datetimepicker3" ).datetimepicker({maxDate:selectedDate,minDate:dateToday});
            var keninTime=KeninformateDateTime(selectedDate);
            $('#datetimepicker2').val(keninTime);
        }
    });
});
/* Booking Validation on Date End */

/* footer Script Global End*/