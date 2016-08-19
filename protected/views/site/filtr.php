<?php
$this->pageTitle=Yii::app()->name . ' - Filtr';
$this->breadcrumbs=array(
	'Filtr',
);
?>

<script src="http://webondev.biz/simply_hop_dev/gm.php?js=map_api"></script>
<script src="/css/js/filtr_validation.js"></script>
<link rel="stylesheet" href="/css/js/bootstrap-datepicker-1.6.1-dist/css/bootstrap-datepicker.min.css" />
<link rel="stylesheet" href="/css/js/bootstrap-datepicker-1.6.1-dist/css/bootstrap-datepicker3.min.css" />
<script src="/css/js/bootstrap-datepicker-1.6.1-dist/js/bootstrap-datepicker.min.js"></script>
<script src="/css/js/bootstrap-datepicker-1.6.1-dist/locales/bootstrap-datepicker.de.min.js" charset="UTF-8"></script>

<?
if(!empty($_GET['clr'])){
    $_SESSION["filtr"]["city"] = "";
    $_SESSION["filtr"]["from"] = "";
    $_SESSION["filtr"]["to"] = "";
}

if(!empty($_SESSION["filtr"]["city"]) ){
    ?>
<script>$(document).ready(function() {
        setTimeout(function(){

            drow_rpute();
        }, 500)
    });</script>
<?
}
?>
<div class="center-block container_mid filtr_form">
    <div class="col-sm-7  content_info_block">
        <div class="content_info">
            <span class="title_img"></span>
            <div class="title">  Mitfahgelegenheit finden:</div>

            <div class="form">

                <form  autocomplete="off" onsubmit="return validate_form(this)" class="form_form form_form_filtr" action="/travels/">
                    <div class="form_line stadt">
                        <div class="form_label">
                            Stadt
                        </div>
                        <div class="form_input_1 select_input">
                            <input type="text"  class=" city_search" name="city" value="<?=(!empty($_SESSION["filtr"]["city"])?$_SESSION["filtr"]["city"]:"")?>" id="city_search" placeholder="Stadt eintragen">
                        </div>
                        <div class="separate"></div>
                        <div class="form_input_2">

                            <a href="/travels/index" onclick="return go_to_city_filtr(this)">zeige mir alle Fahrten<br>
                                in meiner Stadt </a>
                        </div>

                    </div>
                    <div class="form_line standart">
                        <div class="form_label">
                            Start
                        </div>
                        <div class="form_input_1">
                            <input type="text" name="from"  value="<?=(!empty($_SESSION["filtr"]["from"])?$_SESSION["filtr"]["from"]:"")?>" class="city_street"  id="start_point" placeholder="Treffpunkt">
                        </div>
                        <div class="separate"></div>
                        <div class="form_input_2  location">
                            <input type="text" id="start_location" placeholder="Location">
                        </div>

                    </div>
                    <div class="form_line standart">
                        <div class="form_label">
                            Ziel
                        </div>
                        <div class="form_input_1">
                            <input type="text" name="to"   value="<?=(!empty($_SESSION["filtr"]["to"])?$_SESSION["filtr"]["to"]:"")?>" class="city_street" id="end_point" placeholder="Ankunftspunkt">
                        </div>
                        <div class="separate"></div>
                        <div class="form_input_2 location">
                            <input type="text" id="end_location" placeholder="Location">
                        </div>

                    </div>
                    <script>
                        $(document).ready(function() {
                            $('#datePicker2')
                                .datepicker({
                                    autoclose: true,
                                    format: 'dd.mm.yyyy',
                                    language: "de",
                                    startDate: 'today'
                                })
                                .on('changeDate', function (e) {
                                    // Revalidate the date field
                                    //$('#eventForm').formValidation('revalidateField', 'date');
                                });
                        })
                    </script>
                    <div class="form_line date">
                        <div class="form_label">
                            Datum
                        </div>
                        <div class="form_input_1 date_callendar" >

                                <input type="text"  name="date"  value="<?=(!empty($_SESSION["filtr"]["date"])?$_SESSION["filtr"]["date"]:"")?>" id="datePicker2"  placeholder="tt.mm.jjjj">


                           <span> Uhrzeit</span>
                        </div>
                        <div class="separate"></div>
                        <div class="form_input_2 date_clock_2">
                            <input type="text" name="time"  id="date_clock"  onkeyup="return check_clock_time(this)"  value="<?=(!empty($_SESSION["filtr"]["time"])?$_SESSION["filtr"]["time"]:"")?>"  placeholder="00:00">
                        </div>
                    </div>
                    <div class="button_form">
                        <button >Suchen</button>
                    </div>
                </form>
            </div><!--form-->
        </div><!--content_info_block-->

        <div class="filtr_extra_pic"></div>
    </div>
    <div class="  map_field" >
        <div class="map_block">
            <span class="title_img"></span>
            <div class="title">Fahrtzusammenfassung</div>

            <div id="map-canvas" style=""></div>
            <script type="text/javascript"  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBiEx2SiglfERkZch_N74J4lDCyu00pdh0&callback=initMap"></script>
            <!--script src="/css/js/js_maps.js"></script-->
        </div>
    </div>
</div>



