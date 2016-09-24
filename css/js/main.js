$(document).ready(function(){



    $(".input").click(function(){
        $(this).parent().find(".search_ul").toggle()
    })
    $(".input").parent().find(".search_ul li").click(function(){
        console.log( $(this).text());
        $(this).parent().parent().find("input").val( $(this).text())
        $(this).parent().parent().find(".input").text( $(this).text()).ready(function(){

            $(".search_ul").hide();
        })

    })


    var forCenteredBottom=($(document).width()/2)-($('#bottom').width()/2);

    if($('#container').height() + $('#bottom').height() < $(window).height() ){
        $('#bottom').css({
            width: '100%',
            position:'absolute',
            bottom: 0,
            left: forCenteredBottom
        })
    }else{
        $('#bottom').css({
            position:'relative'
        })
    }


    $("#choose_u_pic").change(function(){
      //  $("#sho_u_pic_path").text($(this).val());
    })
    $("#choose_a_pic").change(function(){
      //  $("#sho_a_pic_path").text($(this).val());
    })

   /* $(".btn-group .btn-primary").click(function(){
        var e = this;
        setTimeout(function(){
           if( $(e).hasClass("active")){
               $(e).parent().find("input").attr("checked",false).ready(function(){

                   $(e).find("input").attr("checked",true)
                   console.log($(e).find("input").val())
               })

           }

        }, 800)
    })*/
    $(".radio .btn-group .btn-primary,.radio_2 .btn-group .btn-primary").click(function(){
        var e = this;
        setTimeout(function(){
            if( $(e).hasClass("active")){
                $(e).parent().find("input[type=radio]").attr("checked",false).ready(function(){

                    $(e).find("input[type=radio]").attr("checked",true)
                   // console.log($(e).find("input[type=radio]").val())
                    $(e).parent().parent().find("input[type=hidden]").val($(e).find("input[type=radio]").val())
                })
            }
        }, 300)
    })
    $(".checkbox_2 .btn-primary").click(function(){

        var e = this;
        setTimeout(function(){
            if( $(e).hasClass("active")){
                $(e).parent().parent().find("input[type=hidden]").val(2)
            }else{
                $(e).parent().parent().find("input[type=hidden]").val(1)
            }
        }, 300)
    })
})
function checkSize(max_img_size)
{
    max_img_size = 1024*1024*3;

    var input = document.getElementById("choose_u_pic");
    // check for browser support (may need to be modified)
    if(input.files && input.files.length == 1)
    {
       // console.log(input.files[0].size)
        if (input.files[0].size > max_img_size)
        {

            alert("The file must be less than 3MB");
            return false;
        }
    }
     input = document.getElementById("choose_a_pic");
    // check for browser support (may need to be modified)
    if(input.files && input.files.length == 1)
    {
        console.log(input.files[0].size)
        console.log(max_img_size)
        if (input.files[0].size > max_img_size)
        {

            alert("The file must be less than 1 3MB");
            return false;
        }
    }

    return true;
}
function choose_u_pic( e){
    $("#choose_u_pic").click();
}
function choose_a_pic( e){
    $("#choose_a_pic").click();
}

function send_request(e){


//console.log(  $(e).parent().parent().parent())
    var data =  $(e).parent().parent().parent().serialize();
    console.log(data)
    //return;
    ajaxurl = "/request/";
    $.post(
        ajaxurl,
        data,
        function(response){
           // console.log(response);
            try{
                //console.log(44333);
               // res = jQuery.parseJSON(response);
                //console.log(res);
                if(response == "ok"){
                   // console.log(333);
                   // console.log($(e).parent().parent().parent())
                    $(e).parent().parent().parent().hide()
                    $(e).parent().parent().parent().parent().find(".r_sended").show()
                }

            }catch(err){

            }

        }
    ).fail(function() {
            alert("Error happend!")
    });;
}

function go_to_city_filtr( e){
    var r = $("#city_search").val();
    if(r.length < 1){
        $("#city_search").addClass("error")
        return false;
    }
    window.location.href = '/travels/index/?city='+r;
    return false;
}
function check_clock_time(e){
    var t = $(e).val()

    patt2 = /^[0-2][0-9]:[0-5][0-9]$/g;

    result2 = patt2.test(t);

    //console.log(result2)

    if(result2){
        $(e).removeClass("error")
    }else{
        $(e).addClass("error")
    }

}


function redirectTravel(url, el, e){

    console.log($(e.target).hasClass("view_send_request"))

//return false;
    var senderElementName = e.target.tagName.toLowerCase();
    //console.log(senderElementName)
    if(senderElementName == "a" && $(e.target).hasClass("view_send_request")){
        return false;
    }

   // return false;
    window.location = url;
}