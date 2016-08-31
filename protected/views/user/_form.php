<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>



    <div class="center-block container_mid">

        <div class="profile_edit">
            <div class="profile_edit_title">
                <span class="title_img"></span>
                <div class="title">profil</div>
            </div>


            <div class="profile_form">
                <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'user-form',
                    'htmlOptions'=>array('enctype'=>'multipart/form-data',
                        'onsubmit'=>'return checkSize(3*1024)'),
                     'enableAjaxValidation'=>false,
                )); ?>
                <div class="title">Meine persönlichen Informationen</div>

                <div class="row geschlecht">
                    <div class="label"><?php echo $form->labelEx($model,'geschlecht'); ?></div>
                    <div class="field radio">
                        <?php /*echo $form->hiddenField($model,'geschlecht',array('size'=>60,'maxlength'=>128)); ?>
                        <?php echo $form->error($model,'geschlecht'); */?>

                        <div class="btn-group" data-toggle="buttons">

                            <label class="btn btn-primary <? if($model->geschlecht == 1) echo "active"; ?>">
                                <input type="radio" name="User1[geschlecht]" id="" value="1" autocomplete="off"
                                    <? if($model->geschlecht == 1) echo "checked='checked'"; ?> > Mann
                            </label>
                            <label class="btn btn-primary <? if($model->geschlecht == 2) echo "active"; ?>">
                                <input type="radio" name="User1[geschlecht]" id="" value="2" autocomplete="off"
                                    <? if($model->geschlecht == 2) echo "checked='checked'"; ?>> Frau
                            </label>

                        </div>
                        <input type="hidden" name="User[geschlecht]" value="<?=$model->geschlecht?>">
                    </div>
                </div>
                <div class="row">
                    <div class="label"><?php echo $form->labelEx($model,'vorname'); ?></div>
                    <div class="field">
                        <? ?>
                        <?php echo $form->textField($model,'vorname',array('size'=>60,'maxlength'=>128,
                            "class"=>((empty($model->vorname))?"error":"")
                        )); ?>
                        <?php// echo $form->error($model,'vorname'); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="label"><?php echo $form->labelEx($model,'nachname'); ?></div>
                    <div class="field">
                        <?php echo $form->textField($model,'nachname',array('size'=>60,'maxlength'=>128)); ?>
                        <?php// echo $form->error($model,'nachname'); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="label"><?php echo $form->labelEx($model,'form_stadt'); ?></div>
                    <div class="field">
                        <?php echo $form->textField($model,'form_stadt',array('size'=>60,'maxlength'=>128)); ?>
                        <?php// echo $form->error($model,'form_stadt'); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="label"><?php echo $form->labelEx($model,'form_handy'); ?></div>
                    <div class="field">
                        <?php echo $form->textField($model,'form_handy',array('size'=>60,'maxlength'=>128,
                            'placeholder'=>'(+49) ',
                            "class"=>((empty($model->form_handy))?"error":"")
                        )); ?>
                        <?php// echo $form->error($model,'form_handy'); ?>
                    </div>
                </div>
                <div class="row email_3">
                    <div class="label"><?php echo $form->labelEx($model,'email'); ?></div>
                    <div class="field">
                        <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128,
                            "class"=>((empty($model->email))?"error":"")
                        )); ?>
                        <? if(!empty($model->email)){?><span></span><?}?>
                        <?php// echo $form->error($model,'email'); ?>
                    </div>
                </div>



                <link rel="stylesheet" href="/css/js/bootstrap-datepicker-1.6.1-dist/css/bootstrap-datepicker.min.css" />
                <link rel="stylesheet" href="/css/js/bootstrap-datepicker-1.6.1-dist/css/bootstrap-datepicker3.min.css" />
                <script src="/css/js/bootstrap-datepicker-1.6.1-dist/js/bootstrap-datepicker.min.js"></script>
                <script src="/css/js/bootstrap-datepicker-1.6.1-dist/locales/bootstrap-datepicker.de.min.js" charset="UTF-8"></script>

                <script>
                    $(document).ready(function() {
                        /*$('#datePicker4')
                            .datepicker({
                                autoclose: true,
                                format: 'dd.mm.yyyy',
                                language: "de"
                              //  startDate: '1990'
                            })
                            .on('changeDate', function (e) {
                                // Revalidate the date field
                                //$('#eventForm').formValidation('revalidateField', 'date');
                            });*/
                    })
                </script>
                <div class="row date_3">
                    <div class="label"><?php echo $form->labelEx($model,'geburtsdatum'); ?></div>
                    <div class="field">
                        <?php echo $form->textField($model,'geburtsdatum',array('size'=>60,'maxlength'=>128,
                            'placeholder'=>'tt.mm.jjjj', 'id'=>'datePicker4',
                            "class"=>((empty($model->geburtsdatum))?"error":"")
                        )); ?>
                        <?php echo $form->error($model,'geburtsdatum'); ?>
                    </div>
                </div>
                <div class="row form_uber_mich">
                    <div class="label"><?php echo $form->labelEx($model,'form_uber_mich'); ?></div>
                    <div class="field">
                        <?php echo $form->textArea($model,'form_uber_mich',array('size'=>160,'maxlength'=>128,
                        )); ?>
                        <?php //echo $form->error($model,'form_uber_mich'); ?>
                    </div>
                </div>
                <div class="row upload_user_f">
                    <div class="label"><label>Profilfoto</label></div>
                    <div class="field">
                        <span class="img"
                              <?
                              $Mix_f = new Mix_f;
                              $img_code = $Mix_f->show_user_pic($model->id, "pr_edit");
                              ?>
                              style="<?=$img_code?>"
                        ></span>
                        <div class="mid_data">
                            <span class="button" onclick="choose_u_pic(this)">Datei auswählen</span>
                            <br>
                            <span class="sh_desc">PNG, JPG oder GIF, max. 3 MB</span><br>
                            <span id="sho_u_pic_path"></span>
                        </div>
                        <a href="?id=<?=$model->id?>&delf=y" class="del"></a>
                        <input style="display: none;" id="choose_u_pic" type="file" name="user_pic">
                    </div>
                </div>



                <div class="title praferenzen">
                    Ihr Auto
                </div>
                <div class="row">
                    <div class="label"><?php echo $form->labelEx($model,'form_automarke'); ?></div>
                    <div class="field">
                        <?php echo $form->textField($model,'form_automarke',array('size'=>60,'maxlength'=>128)); ?>
                        <?php //echo $form->error($model,'form_automarke'); ?>
                    </div>
                </div>

                <div class="row">
                    <div class="label"><?php echo $form->labelEx($model,'farbe'); ?></div>
                    <div class="field">
                        <?php echo $form->textField($model,'farbe',array('size'=>60,'maxlength'=>128)); ?>
                        <?php //echo $form->error($model,'farbe'); ?>
                    </div>
                </div>
                <div class="row upload_user_f auto_foto">
                    <div class="label"><label for="">Autobild</label></div>
                    <div class="field">

                        <span class="img"
                            <?
                            $Mix_f = new Mix_f;
                            $img_code = $Mix_f->show_user_pic($model->id, "pr_auto_edit");
                            ?>
                              style="<?=$img_code?>"
                            ></span>
                        <div class="mid_data">
                            <span class="button" onclick="choose_a_pic(this)">Datei auswählen</span>
                            <br>
                            <span class="sh_desc">PNG, JPG oder GIF, max. 3 MB</span><br>
                            <span id="sho_a_pic_path"></span>
                        </div>
                        <a href="?id=<?=$model->id?>&adel=y" class="del"></a>


                        <input style="display: none;" id="choose_a_pic" type="file" name="auto_photo">
                    </div>
                </div>

                <div class="title praferenzen">
                    Präferenzen

                </div>

                <div class="row radio_2 raucher">
                    <div class="label"><?php echo $form->labelEx($model,'raucher'); ?></div>
                    <div class="field spec_radio">

                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-primary  <? if($model->raucher == 1) echo "active"; ?>">
                                <input type="radio" name="User1[raucher]" id="" value="1" autocomplete="off"
                                    <? if($model->raucher == 1) echo "checked='checked'"; ?>>
                            </label>
                            <label class="btn btn-primary  <? if($model->raucher == 2) echo "active"; ?>">
                                <input type="radio" name="User1[raucher]" id="" value="2" autocomplete="off"
                                    <? if($model->raucher == 2) echo "checked='checked'"; ?>>
                            </label>

                        </div>
                        <input type="hidden" name="User[raucher]" value="<?=$model->raucher?>">
                        <?php /*echo $form->textField($model,'raucher',array('size'=>60,'maxlength'=>128)); ?>
                        <?php echo $form->error($model,'raucher'); */?>
                    </div>
                </div>
                <div class="row radio_2 haustiere">
                    <div class="label"><?php echo $form->labelEx($model,'haustiere'); ?></div>
                    <div class="field spec_radio">
                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-primary <? if($model->haustiere == 1) echo "active"; ?>">
                                <input type="radio" name="User1[haustiere]" id="" value="1" autocomplete="off"
                                    <? if($model->haustiere == 1) echo "checked='checked'"; ?>>
                            </label>
                            <label class="btn btn-primary  <? if($model->haustiere == 2) echo "active"; ?>">
                                <input type="radio" name="User1[haustiere]" id="" value="2" autocomplete="off"
                                    <? if($model->haustiere == 2) echo "checked='checked'"; ?>>
                            </label>

                        </div>
                        <input type="hidden" name="User[haustiere]" value="<?=$model->haustiere?>">
                        <?php /*echo $form->textField($model,'haustiere',array('size'=>60,'maxlength'=>128)); ?>
                        <?php echo $form->error($model,'haustiere');*/ ?>
                    </div>
                </div>
                <div class="row radio_2 musik">
                    <div class="label"><?php echo $form->labelEx($model,'musik'); ?></div>
                    <div class="field spec_radio">
                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-primary  <? if($model->musik == 1) echo "active"; ?>">
                                <input type="radio" name="User1[musik]" id="" value="1" autocomplete="off"
                                    <? if($model->musik == 1) echo "checked='checked'"; ?>>
                            </label>
                            <label class="btn btn-primary  <? if($model->musik == 2) echo "active"; ?>">
                                <input type="radio" name="User1[musik]" id="" value="2" autocomplete="off"
                                    <? if($model->musik == 2) echo "checked='checked'"; ?>>
                            </label>

                        </div>
                        <input type="hidden" name="User[musik]" value="<?=$model->musik?>">
                        <?php /*echo $form->textField($model,'musik',array('size'=>60,'maxlength'=>128)); ?>
                        <?php echo $form->error($model,'musik'); */?>
                    </div>
                </div>

                <div class="button_form">
                <?php echo CHtml::submitButton($model->isNewRecord ? 'Speichern' : 'Speichern'); ?>

                </div>
                <?php $this->endWidget(); ?>
            </div>

        </div>
    </div>


<div class="sidebar_comments" >
<div class="pr_comments">
    <div class="comment_view_title">
        <span class="title_img"></span>
        <div class="title"><? echo $dataProviderReviews->getTotalItemCount();?>  Bewertungen</div>
    </div>
    <div class="pr_comments_list">
        <?php
        //print_r($dataProviderReviews);
        //
        $this->widget('zii.widgets.CListView', array(
            'dataProvider'=>$dataProviderReviews,
            //'itemView'=>'_review',
            'emptyText'=>'',
            'itemView'=>'application.views.reviews._view',
            'template'=>"{items} ",
        ));
        ?>

       <div style="text-align: center"> <a href="/reviews/" class="all_reviews_btn">Alle Bewertungen anzeigen</a></div>
        <div style="clear:both"></div>
    </div><!--pr_comments_list-->

</div>
</div><!--sidebar_comments-->
<? return false;?>

<hr>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
    'htmlOptions'=>array('enctype'=>'multipart/form-data'),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
asd
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


    <input type="file" name="user_pic">

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'profile'); ?>
		<?php echo $form->textArea($model,'profile',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'profile'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'form_name'); ?>
        <?php echo $form->textField($model,'form_name',array('size'=>60,'maxlength'=>128)); ?>
        <?php echo $form->error($model,'form_name'); ?>
    </div>

    <!---->


    <div class="row">
        <?php echo $form->labelEx($model,'form_boden'); ?>
        <?php echo $form->textField($model,'form_boden',array('size'=>60,'maxlength'=>128)); ?>
        <?php echo $form->error($model,'form_boden'); ?>
    </div>


    <div class="row">
        <?php echo $form->labelEx($model,'form_stadt'); ?>
        <?php echo $form->textField($model,'form_stadt',array('size'=>60,'maxlength'=>128)); ?>
        <?php echo $form->error($model,'form_stadt'); ?>
    </div>


    <div class="row">
        <?php echo $form->labelEx($model,'form_handy'); ?>
        <?php echo $form->textField($model,'form_handy',array('size'=>60,'maxlength'=>128)); ?>
        <?php echo $form->error($model,'form_handy'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'form_email'); ?>
        <?php echo $form->textField($model,'form_email',array('size'=>60,'maxlength'=>128)); ?>
        <?php echo $form->error($model,'form_email'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'form_automarke'); ?>
        <?php echo $form->textField($model,'form_automarke',array('size'=>60,'maxlength'=>128)); ?>
        <?php echo $form->error($model,'form_automarke'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'form_alter'); ?>
        <?php echo $form->textField($model,'form_alter',array('size'=>60,'maxlength'=>128)); ?>
        <?php echo $form->error($model,'form_alter'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'form_uber_mich'); ?>
        <?php echo $form->textField($model,'form_uber_mich',array('size'=>60,'maxlength'=>128)); ?>
        <?php echo $form->error($model,'form_uber_mich'); ?>
    </div>






	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->