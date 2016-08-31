<?php
/* @var $this TravelsController */
/* @var $model Travels */
/* @var $form CActiveForm */
?>



<!--script src="/css/js/map_api.js"></script-->
<script src="http://webondev.biz/simply_hop_dev/gm.php?js=map_api"></script>
<script src="http://webondev.biz/simply_hop_dev/gm.php?js=validation_add_form"></script>
<!--script src="/css/js/validation_add_form.js"></script-->


<!--https://silviomoreto.github.io/bootstrap-select/examples/#styling-->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/i18n/defaults-*.min.js"></script>


<!--link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script-->
<link rel="stylesheet" href="/css/js/bootstrap-datepicker-1.6.1-dist/css/bootstrap-datepicker.min.css" />
<link rel="stylesheet" href="/css/js/bootstrap-datepicker-1.6.1-dist/css/bootstrap-datepicker3.min.css" />
<script src="/css/js/bootstrap-datepicker-1.6.1-dist/js/bootstrap-datepicker.min.js"></script>
<script src="/css/js/bootstrap-datepicker-1.6.1-dist/locales/bootstrap-datepicker.de.min.js" charset="UTF-8"></script>

<script>
    $(document).ready(function(){
        $('.selectpicker_cust').selectpicker({
            style: 'btn-info',
            size: 4
        });


    })
    $(document).ready(function(){


        //
       $(document).click(function(event) {
           console.log($(event.target));
           if($(event.target).hasClass("input")){
               return;
           }
            if ($(event.target).closest(".search_ul").length) return;
            $(".search_ul").hide();
           drow_rpute()
            event.stopPropagation();
        });
    });
</script>

<div class="center-block container_mid">
    <div class="col111-sm-7 content_info add_form_info">
        <span class="title_img"></span>
        <div class="title"> Fahrt Eintragen</div>

        <div class="form add_form">

            <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'travels-form',
                // Please note: When you enable ajax validation, make sure the corresponding
                // controller action is handling ajax validation correctly.
                // There is a call to performAjaxValidation() commented in generated controller code.
                // See class documentation of CActiveForm for details on this.
                'enableAjaxValidation'=>false,
            )); ?>
            <?php echo $form->error($model,'form_stadt'); ?>
            <?php echo $form->error($model,'form_start'); ?>
            <?php echo $form->error($model,'form_ziel'); ?>
            <?php echo $form->error($model,'datum_start'); ?>
            <?php echo $form->error($model,'datum_start_time'); ?>
            <?php// echo $form->textField($model,'travel_owner_id'); ?>
            <?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save');
            //
            //
           // print_r($model) ?>

            <?php $this->endWidget(); ?>



            <form  autocomplete="off" class="form_form" method="post" id="eventForm" onsubmit="return validate_form(this)">



                <input type="hidden"  value="<?=Yii::app()->user->id?>" name="Travels[travel_owner_id]" >
                <input type="hidden"  value="1" name="Travels[position_from_id]" >
                <input type="hidden"  value="1" name="Travels[position_destination_id]" >

                <div class="form_line standart searching">
                    <div class="form_label">
                        Stadt
                    </div>
                    <div class="form_input_1 select_input1">

                        <input type="text"  name="Travels[form_stadt]" class=" city_search" id="city_search" placeholder="Stadt eintragen">

                    </div>
                    <div class="separate"></div>
                    <div class="form_input_2 location">

                    </div>

                </div>
                <div class="form_line standart searching">
                    <div class="form_label">
                        Start
                    </div>
                    <div class="form_input_1">

                        <input type="text" class="city_street"  name="Travels[form_start]"  id="start_point" placeholder="Treffpunkt">


                    </div>
                    <div class="separate"></div>
                    <div class="form_input_2 location">

                    </div>

                </div>
                <div class="form_line standart searching">
                    <div class="form_label">
                        Ziel
                    </div>
                    <div class="form_input_1">

                        <input type="text" class="city_street" name="Travels[form_ziel]"  id="end_point" placeholder="Ankunftspunkt">

                    </div>
                    <div class="separate"></div>
                    <div class="form_input_2 location" >
                        <input type="text" placeholder="Location">
                    </div>

                </div>

                <div id="exaple_field">
                    <div class="form_line standart searching extra_points" >
                        <div class="form_label">
                            Zwischenstopp 1
                        </div>
                        <div class="form_input_1">

                            <input type="text" name="extra[]" onkeyup="entering_name(this)" class=" city_street_extra" >

                        </div>
                        <div class="separate"></div>
                        <div class="form_input_2 location" >
                            <span class="del" onclick="remove_point(this)">del</span>
                            <input type="text" placeholder="Location">
                        </div>

                    </div>
                </div>
                <div class="form_line standart extra_point_add searching">
                    <div class="form_label">

                    </div>
                    <div class="form_input_1">

                        <span class="extra_point" name="extra[]" onclick="new_extra_point(this)">+ Zwischenstopp hinzufugen</span>

                    </div>
                    <div class="separate"></div>
                    <div class="form_input_2" >

                    </div>

                </div>
                <script>
                    $(document).ready(function() {
                        var newDate = new Date();
                        console.log(newDate);
                        $('#datePicker2')
                            .datepicker({
                                autoclose: true,
                                format: 'dd.mm.yyyy',
                                language: "de",
                               // startDate: 'today'
                                startDate:newDate
                            })
                            .on('changeDate', function (e) {
                               // console.log(newDate.today());
                                // Revalidate the date field
                                //$('#eventForm').formValidation('revalidateField', 'date');
                            });
                    })
                </script>

                <div class="form_line standart date">
                    <div class="form_label">
                        Datum <span>Start</span>
                    </div>
                    <div class="form_input_1 date_callendar" >
                        <input type="text" id="datePicker2"   name="Travels[datum_start]"  placeholder="tt.mm.jjjj">

                    </div>

                    <div class="form_input_2 date_clock">
                        <div class="field_name_2">Uhrzeit&nbsp;<span>Start</span></div>
                        <input type="text" id="date_clock" onkeyup="return check_clock_time(this)" name="Travels[datum_start_time]"  placeholder="00:00">
                    
                    <div id="passed_time" style="
                    font-size: 11px;;
                    display: none;
                      border: 1px solid rgb(216, 85, 85);
					  padding: 4px 16px;
					  color: rgb(228, 94, 94);
					  position: absolute;
					      margin-left: 89px;
                        margin-top: -6px;
					  width: 127px;
					  ">Die Uhrzeit liegt in <br>der Vergangenheit!</div>
                    </div>
                </div>



                <div class="form_line standart_2">
                    <div class="form_label">
                        Umweg
                    </div>
                    <div class="form_input_1">
                        <div class="input">5 Min.</div>
                        <ul class="search_ul">
                            <li >0 Min.</li>
                            <li >5 Min.</li>
                            <li >10 Min.</li>
                            <li >15 Min.</li>

                        </ul>
                        <input type="hidden" class="" name="Travels[form_umweg]" value="5" id="" placeholder="">
                    </div>
                </div>
                <? /*<div class="form_line standart_3">
                    <div class="form_label">
                        Automarke<br>
                        <span>und Model</span>
                    </div>
                    <div class="form_input_1">

                        <?
                        $u=User::model()->findByPk(Yii::app()->user->id);
                        $form_automarke = $u->form_automarke;
                        ?>
                        <input type="text" class="" value="<?=$form_automarke?>" name="111Travels[form_automarke]" id="start_point" placeholder="">
                    </div>
                </div>*/?>

<div style="clear: both"></div>
                <div class="form_line standart_textarea standart_textarea_2">
                    <div class="form_label form_label_textarea_2">
                        <div>Sonstige</div>
                       <div> Hinweise</div>
                        <span> Treffpunkt etc.</span>
                    </div>
                    <div class="form_input_1">
                        <textarea  name="Travels[form_sonstige_inweise]" ></textarea>
                    </div>
                </div>
                <div class="form_line standart_radio">
                    <div class="form_label">
                    </div>
                    <div class="form_input_1 radio">
                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-primary <? if($model->form_raucher == 1) echo "active"; ?>">
                                <input type="radio" name="Raucher" id="" value="1" autocomplete="off"
                                    <? if($model->form_raucher == 1) echo "checked"; ?>  > Raucher
                            </label>
                            <label class="btn btn-primary <? if($model->form_raucher == 2) echo "active"; ?>">
                                <input type="radio" name="Raucher" id="" value="2" autocomplete="off"
                                       <? if($model->form_raucher == 2) echo "checked"; ?> > Nichtraucher
                            </label>
                        </div>
                        <input type="hidden" name="Travels[form_raucher]" value="<?=$model->form_raucher?>">

                    </div>
                </div>
                <div style="clear: both;"></div>
                <div class="form_line standart_checkbox standart_checkbox_2">
                    <div class="form_label">
                    </div>
                    <div class="form_input_1 checkbox_2">
                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-primary <? if($model->form_max_2 == 2) echo "active"; ?>">
                                <input type="checkbox"
                                       <? if($model->form_max_2 == 2) echo 'checked="checked"'; ?>
                                        value="1" id="" name="form_max_2" autocomplete="off"> Max. 2 auf der Rückbank
                            </label>
                        </div>
                        <input type="hidden" name="Travels[form_max_2]" value="<?=$model->form_max_2?>">
                    </div>
                </div>
                <div class="form_line standart_celector_2">
                    <div class="form_label">
                        Freie Plätze
                    </div>
                    <div class="form_input_1">
                        <div class="input">1</div>
                        <ul class="search_ul">
                            <li >1</li>
                            <li >2</li>
                            <li >3</li>
                            <li >4</li>
                            <li >5</li>

                        </ul>
                        <input type="hidden" class="" name="Travels[form_freie_platze]" value="5" id="" placeholder="">

                    </div>

                    <div class="form_label">
                        Gepäckstücke
                    </div>
                    <div class="form_input_2">
                        <div class="input">1</div>
                        <ul class="search_ul">
                            <li >1</li>
                            <li >2</li>
                            <li >3</li>
                            <li >4</li>
                            <li >5</li>
                        </ul>
                        <input type="hidden" class="" name="Travels[form_gepack]" value="5" id="" placeholder="">
                    </div>
                </div>

                <div class="form_line standart_checkbox standart_checkbox_3">
                    <div class="form_label">
                    </div>
                    <div class="form_input_1">
                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-primary ">
                                <input type="checkbox"  id="confirm_rules" autocomplete="off"> AGBs akzeptieren
                            </label>
<span class="error_checkbox_block" style="

"></span>
                        </div>
                    </div> <span class="confirm_ruls_err" style="display:none; color:#ff6258;"> Confirm rules</span>
                </div>
                <div style="clear:both;"></div>
                <div class="button_form">
                    <button >Fahrt eintragen</button>

                </div>
            </form>



        </div><!--form-->
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




<? return false;?>


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'travels-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'travel_owner_id'); ?>
		<?php echo $form->textField($model,'travel_owner_id'); ?>
		<?php echo $form->error($model,'travel_owner_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'position_from_id'); ?>
		<?php echo $form->textField($model,'position_from_id'); ?>
		<?php echo $form->error($model,'position_from_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'position_from_name'); ?>
		<?php echo $form->textField($model,'position_from_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'position_from_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'position_destination_id'); ?>
		<?php echo $form->textField($model,'position_destination_id'); ?>
		<?php echo $form->error($model,'position_destination_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'position_destination_name'); ?>
		<?php echo $form->textField($model,'position_destination_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'position_destination_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_active'); ?>
		<?php echo $form->textField($model,'is_active'); ?>
		<?php echo $form->error($model,'is_active'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_add'); ?>
		<?php echo $form->textField($model,'date_add'); ?>
		<?php echo $form->error($model,'date_add'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_edit'); ?>
		<?php echo $form->textField($model,'date_edit'); ?>
		<?php echo $form->error($model,'date_edit'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'descrition'); ?>
		<?php echo $form->textArea($model,'descrition',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'descrition'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'form_stadt'); ?>
		<?php echo $form->textField($model,'form_stadt'); ?>
		<?php echo $form->error($model,'form_stadt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'form_start'); ?>
		<?php echo $form->textField($model,'form_start'); ?>
		<?php echo $form->error($model,'form_start'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'form_ziel'); ?>
		<?php echo $form->textField($model,'form_ziel'); ?>
		<?php echo $form->error($model,'form_ziel'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'form_automarke'); ?>
		<?php echo $form->textField($model,'form_automarke',array('size'=>60,'maxlength'=>244)); ?>
		<?php echo $form->error($model,'form_automarke'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'form_sonstige_inweise'); ?>
		<?php echo $form->textArea($model,'form_sonstige_inweise',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'form_sonstige_inweise'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'form_freie_platze'); ?>
		<?php echo $form->textField($model,'form_freie_platze'); ?>
		<?php echo $form->error($model,'form_freie_platze'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'form_anzahl_von_gepack'); ?>
		<?php echo $form->textField($model,'form_anzahl_von_gepack'); ?>
		<?php echo $form->error($model,'form_anzahl_von_gepack'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'form_raucher'); ?>
		<?php echo $form->textField($model,'form_raucher'); ?>
		<?php echo $form->error($model,'form_raucher'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->