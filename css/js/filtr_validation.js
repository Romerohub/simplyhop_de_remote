function validate_form(e) {
    var errors = [];
 

    var v = $("#city_search").val();
    if (v.length < 2) {
        //alert("minimum 2 letters");
        errors.push({
            id: "city_search",
            error: "minimum 2 letters"
        });

    }
    v = $("#start_point").val();
    if (v.length < 2) {
        errors.push({
            id: "start_point",
            error: "minimum 2 letters"
        });
    }
    v = $("#end_point").val();
    if (v.length < 2) {
        errors.push({
            id: "end_point",
            error: "minimum 2 letters"
        });
    }
    v = $("#date_clock").val();
    if (v.length > 0) {
        patt2 = /^[0-2][0-9]:[0-5][0-9]$/g;
        result2 = patt2.test(v);
        if(!result2){
            errors.push({
                id: "date_clock",
                error: "wrong departure time"
            });
        }
    }else{
        $("#date_clock").removeClass("error")
    }



    console.log(errors);
    console.log(v);
    $.each(errors, function(key, val){
        console.log(val.id)
        $("#"+val.id).addClass("error")

    })
    // alert(errors[0].error);
    if(errors.length >0){
       /* $('html, body').animate({
            scrollTop: $("#city_search").offset().top
        }, 2000);*/
        return false;
    }
}