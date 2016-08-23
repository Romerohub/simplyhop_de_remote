<div class="r_sended" style=" ">REQUEST SENDED</div>

<form  autocomplete="off" class="form_form" method="post" onsubmit="return false;">
    <div class="title">
        SEND REQUEST
    </div>

    <input type="hidden" name="request_user_id" value="<?= Yii::app()->user->id?>">
    <input type="hidden" name="travel_id" value="<?=$model->id?>">
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
            <input type="hidden" class="" name="freie" value="1" id="" placeholder="">

        </div>
<div class="request_devider"></div>
        <div class="form_label form_label2">
            Gepäckstücke
        </div>
        <div class="form_input_2 form_input_2_2">
            <div class="input">1</div>
            <ul class="search_ul">
                <li >1</li>
                <li >2</li>
                <li >3</li>
                <li >4</li>
                <li >5</li>
            </ul>
            <input type="hidden" class="" name="gep" value="1" id="" placeholder="">
        </div>
        <div class="button_form">
            <button onclick="send_request(this)" >Fahrt eintragen</button>

        </div>
        <div style="clear: both;"></div>
    </div>

</form>