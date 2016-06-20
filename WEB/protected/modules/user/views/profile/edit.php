<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Profile");
$this->breadcrumbs=array(
	UserModule::t("Profile")=>array('profile'),
	UserModule::t("Edit"),
);
/*
$this->menu=array(
	((UserModule::isAdmin())
		?array('label'=>UserModule::t('Hallitse käyttäjiä'), 'url'=>array('/user/admin'))
		:array()),
    array('label'=>UserModule::t('Listaa käyttäjät'), 'url'=>array('/user')),
    array('label'=>UserModule::t('Profiili'), 'url'=>array('/user/profile')),
    array('label'=>UserModule::t('Vaihda salasana'), 'url'=>array('changepassword')),
    array('label'=>UserModule::t('Kirjaudu ulos'), 'url'=>array('/user/logout')),
);
*/
?><h1><?php echo UserModule::t('Muokkaa profiilia'); ?></h1>


<?php if(Yii::app()->user->hasFlash('profileMessage')): ?>
<div class="success">
<?php echo Yii::app()->user->getFlash('profileMessage'); ?>
</div>
<?php endif; ?>

  
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'profile-form',
	'enableAjaxValidation'=>true,
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note"><?php echo UserModule::t('Tähdellä<span class="required">*</span> merkityt kentät ovat pakollisia.'); ?></p>

	<?php echo $form->errorSummary(array($model,$profile)); ?>

<?php 
		$profileFields=$profile->getFields();
		if ($profileFields) {

echo '<div class="row form">';

echo '
<div class="row">
 <div class="col-sm-3">
  <div class="panel panel-info">
   <div class="panel-heading">Yhteystiedot</div>
   <div class="panel-body">';

		 foreach($profileFields as $field) 
		 {
		 if(
			$field->varname == 'lastname'
			or $field->varname == 'firstname'
			or $field->varname == 'puhelinnumero'
		 ){
		    echo '<div class="row" id="My_'.$field->varname.'">';
			lomake($profile,$field,$form);
		    echo '</div>';
		 }

		 }

?>
	<hr>
	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>20,'maxlength'=>20,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128,'class'=>'form-control')); ?>

		<?php echo $form->error($model,'email'); ?>
	</div>

<?php
echo '
   </div>
  </div>
 </div>

 <div class="col-sm-4">
  <div class="panel panel-info">
   <div class="panel-heading">Yleiset</div>
   <div class="panel-body">';

		 foreach($profileFields as $field) 
		 {
		 if(
			$field->varname == 'ppkkvvvv'
			or $field->varname == 'sukupuoli'
			or $field->varname == 'pituus'
			or $field->varname == 'paino'
			or $field->varname == 'varoitukset'
		 ){
		    echo '<div class="row" id="My_'.$field->varname.'">';
			lomake($profile,$field,$form);
		    echo '</div>';
		 }
		 }
echo '
   </div>
  </div>
 </div>


 <div class="col-sm-5">
  <div class="panel panel-info">
   <div class="panel-heading">Tavoite</div>
   <div class="panel-body">';

		 foreach($profileFields as $field) 
		 {
		 if(
			$field->varname == 'tavoitepaino'
			or $field->varname == 'tavoitepaino_itse'
			or $field->varname == 'ruokavalio'
			or $field->varname == 'muokkaa_ruokavalio_suositusta'
			or $field->varname == 'proteiini'
			or $field->varname == 'rasva'
			or $field->varname == 'energia'
			or $field->varname == 'muokkaa_energia_suositusta'
			or $field->varname == 'laihtumisnopeus_viikossa'
			or $field->varname == 'energiavaje_energialisa'
			or $field->varname == 'energiatavoite_kiintea'
			or $field->varname == 'liikunta'
			or $field->varname == 'liikunnan_kesto_viikossa'
			or $field->varname == 'maarita_itse'
			or $field->varname == 'liikunta_kertojen_maara_viikossa'
			or $field->varname == 'aineenvaihdunta'
			or $field->varname == 'lepoaineenvaihdunta'
			or $field->varname == 'aktiivisuuskerroin'
			or $field->varname == 'Ravitsemus_ja_liikuntasuositukset'
			or $field->varname == 'proteiinia_1'
			or $field->varname == 'hiilihydraatteja'
			or $field->varname == 'rasvaa'
		 ){
		    echo '<div class="row" id="My_'.$field->varname.'">';
			lomake($profile,$field,$form);
		    echo '</div>';
		 }

		 }
echo '
   </div>
  </div>
 </div>
</div>
';



echo '</div>'; //form
		}
?>

<style>
@media (min-width: 768px) {
.radio1 {
   width: 40px;
   height: 20px;
   margin-top: auto;
   background: #fff;
   border: none;
   border-radius: 2px;
   -webkit-border-radius: 2px;
   -moz-border-radius: 2px;
}
}


@media (max-width: 767px) {
  .form-inline .radioLabel {
    display: inline-block;
    width: auto;
    vertical-align: middle;
  }
}
@media (max-width: 767px) {
  .form-inline .radioLabel {
    font-size: 80%;
    display: inline-block;
    margin-bottom: 0;
    vertical-align: middle;
  }
}

@media (max-width: 480px) {
  .form-inline .radioLabel {
    font-size: 70%;
  }
  .form-inline .radioLabel {
    margin-top: -5px;
  }
}
</style>


<?php
function lomake($profile,$field,$form){

		/* lomake */
		echo $form->labelEx($profile,$field->varname);
		if ($widgetEdit = $field->widgetEdit($profile)) {
			echo $widgetEdit;
		} elseif ($field->range) {


		$ex = explode(";",$field->range);


		foreach($ex as $k=>$v)
		{

			$ex2 = array();
			$ex2 = explode("==",$v);

			if($profile[$field->varname] == $ex2[0])
			$checked = 'checked';
			else
			$checked = '';

			echo '
			<div class="row">
			<div class="form-inline">
			   <input type="radio" class="radio1" name="Profile['.$field->varname.']" '.$checked.' value="'.$ex2[0].'">
			   <span class="radioLabel">'.$ex2[1].'</span>
			</div>
			</div>
			';
		}



		} elseif ($field->field_type=="TEXT") {
			echo $form->textArea($profile,$field->varname,array('rows'=>6, 'cols'=>50,'class'=>'form-control'));
		} elseif ($field->field_type=="FLOAT") {
			echo $form->numberField($profile,$field->varname,array('class'=>'form-control', 'step'=>'0.01'));
		} elseif ($field->varname=="ppkkvvvv") {

		   $UserAgent = $_SERVER['HTTP_USER_AGENT']; 
		   $WindowsPhone = trim(strpos($UserAgent,"Windows Phone"));
  		   if(!empty($WindowsPhone))
		   {
			echo $form->textField($profile,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255),'class'=>'form-control datepicker'));

		   } else {

			echo $form->dateField($profile,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255),'class'=>'form-control'));

		   }


		} else {
			echo $form->textField($profile,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255),'class'=>'form-control'));
		}
		echo $form->error($profile,$field->varname); 
		/* lomake */
}
?>

<div class="row form">
<div class="col-sm-3">

	<div class="row">
		<?php echo CHtml::link('Vaihda salasana','changepassword',array('class'=>'btn btn-primary btn-block')) ?>
	<br>
		<?php echo CHtml::submitButton($model->isNewRecord ? UserModule::t('Luo') : UserModule::t('Tallenna'),array('class'=>'btn btn-primary btn-block')); ?>
	</div>

<?php $this->endWidget(); ?>
 </div>
</div><!-- form -->





<script type="text/javascript">
$(document).ready(function(){





 $('[name="Profile[aineenvaihdunta]"]').change(function(){
 	TarkistaAineVaihdu();
 });

 	TarkistaAineVaihdu();

 function TarkistaAineVaihdu(){
	var thisVal = $('[name="Profile[aineenvaihdunta]"]:checked').val();

 	if(thisVal == '0')
 	{
	  $('#My_lepoaineenvaihdunta').hide('slow');
 	} else {
	  $('#My_lepoaineenvaihdunta').show('slow');
	}


 }

/* -- */

 $('[name="Profile[muokkaa_energia_suositusta]"]').change(function(){
	  $('#My_energiavaje_energialisa input').val('');
	  $('#My_energiatavoite_kiintea input').val('');

	if($(this).val() == '0')
	{
	  $('#My_laihtumisnopeus_viikossa').hide('slow');
	  $('[name="Profile[laihtumisnopeus_viikossa]"]');
	}

 	TarkistaEnergiaSuositus();
 });

 	TarkistaEnergiaSuositus();

 function TarkistaEnergiaSuositus(){
	var thisVal = $('[name="Profile[muokkaa_energia_suositusta]"]:checked').val();
	var energia = $('[name="Profile[energia]"]:checked').val();

 	if((thisVal == '1') && (energia == 1))
 	{
	  $('#My_laihtumisnopeus_viikossa').show('slow');
	  $('#My_energiavaje_energialisa').hide('slow');
	  $('#My_energiatavoite_kiintea').hide('slow');
 	}

 	if((thisVal == '2') && (energia == 1))
 	{
	  $('#My_laihtumisnopeus_viikossa').hide('slow');
	  $('#My_energiavaje_energialisa').show('slow');
	  $('#My_energiatavoite_kiintea').hide('slow');
 	}

 	if((thisVal == '3') && (energia == 1))
 	{
	  $('#My_laihtumisnopeus_viikossa').hide('slow');
	  $('#My_energiavaje_energialisa').hide('slow');

	  $('#My_energiatavoite_kiintea').show('slow');
 	}


 }

/* -- */


 $('[name="Profile[energia]"]').change(function(){
 	TarkistaEnergia();
 });

 	TarkistaEnergia();

 function TarkistaEnergia(){
	var thisVal = $('[name="Profile[energia]"]:checked').val();


 	if(thisVal == '0')
 	{
	  $('#My_muokkaa_energia_suositusta').hide('slow');
	  $('#My_laihtumisnopeus_viikossa').hide('slow');
	  $('#My_energiavaje_energialisa').hide('slow');
	  $('#My_energiatavoite_kiintea').hide('slow');
 	} else {
	  $('#My_muokkaa_energia_suositusta').show('slow');
	  $('#My_laihtumisnopeus_viikossa').show('slow');
	}


 }

/* -- */



 $('[name="Profile[liikunta]"]').change(function(){
 	TarkistaLiikunta();
 });

 	TarkistaLiikunta();

 function TarkistaLiikunta(){
	var thisVal = $('[name="Profile[liikunta]"]:checked').val();

 	if(thisVal == '0')
 	{
	  $('#My_liikunta_kertojen_maara_viikossa').hide('slow');
	  $('#My_liikunnan_kesto_viikossa').hide('slow');
	  $('#My_maarita_itse').hide('slow');
	  $('[name="Profile[maarita_itse]"]').val('');
	  $('[name="Profile[liikunnan_kesto_viikossa]"][value=0]' ).prop( "checked", true );
 	} else {
	  $('#My_liikunta_kertojen_maara_viikossa').show('slow');
	  $('#My_liikunnan_kesto_viikossa').show('slow');
	}


 }


/* -- */



 $('[name="Profile[liikunnan_kesto_viikossa]"]').change(function(){
 	TarkistaLiikuntaKestoViikossa();
 });

 	TarkistaLiikuntaKestoViikossa();

 function TarkistaLiikuntaKestoViikossa(){
	var thisVal = $('[name="Profile[liikunnan_kesto_viikossa]"]:checked').val();

 	if(thisVal == '5')
 	{
	  $('#My_maarita_itse').show('slow');
 	} else {
	  $('#My_maarita_itse').hide('slow');
	}


 }

/* -- */


 $('[name="Profile[muokkaa_ruokavalio_suositusta]"]').change(function(){
 	TarkistaRuokavalioSuositusta();

	var thisVal = $(this).val();
 	if(thisVal == '0')
 	{
	  $('#My_proteiini').show('slow');
	  $('#My_rasva').show('slow');
	  $('[name="Profile[proteiinia_1]"]').val('');
	  $('[name="Profile[hiilihydraatteja]"]').val('');
	  $('[name="Profile[rasvaa]"]').val('');
	} 

 });

 	TarkistaRuokavalioSuositusta();

 function TarkistaRuokavalioSuositusta(){
	var thisVal = $('[name="Profile[muokkaa_ruokavalio_suositusta]"]:checked').val();

 	if(thisVal == '1')
 	{
	  $('#My_proteiinia_1').show('slow');
	  $('#My_hiilihydraatteja').show('slow');
	  $('#My_rasvaa').show('slow');
	  $('#My_proteiini').hide('slow');
	  $('#My_rasva').hide('slow');
 	} else {
	  $('#My_proteiinia_1').hide('slow');
	  $('#My_hiilihydraatteja').hide('slow');
	  $('#My_rasvaa').hide('slow');
	}

 }


/* -- */


 $('[name="Profile[ruokavalio]"]').change(function(){

	var thisVal = $(this).val();

 	if(thisVal == '0')

 	{

	  $('#My_proteiinia_1').hide('slow');
	  $('#My_hiilihydraatteja').hide('slow');
	  $('#My_rasvaa').hide('slow');

	  $('[name="Profile[muokkaa_ruokavalio_suositusta]"]');
	  $('[name="Profile[proteiinia_1]"]').val('');
	  $('[name="Profile[hiilihydraatteja]"]').val('');
	  $('[name="Profile[rasvaa]"]').val('');

	} 

 	TarkistaRuokavalio();
 });

 	TarkistaRuokavalio();

 function TarkistaRuokavalio(){
	var thisVal = $('[name="Profile[ruokavalio]"]:checked').val();

 	if(thisVal == '0')
 	{
	  $('#My_rasvaa').hide('slow'); 
	  $('#My_hiilihydraatteja').hide('slow'); 
	  $('#My_proteiinia_1').hide('slow'); 
	  $('#My_muokkaa_ruokavalio_suositusta').hide('slow'); 
	  $('#My_proteiini').hide('slow');
	  $('#My_rasva').hide('slow');
 	} else {
	  $('#My_muokkaa_ruokavalio_suositusta').show('slow'); 
	  $('#My_proteiini').show('slow');
	  $('#My_rasva').show('slow');
	}


 }

/* -- */

	TarkistaLiikuntasuositukset();

 $('[name="Profile[Ravitsemus_ja_liikuntasuositukset]"]').change(function(){
	TarkistaLiikuntasuositukset();
 });

 function TarkistaLiikuntasuositukset(){
	var thisVal = $('[name="Profile[Ravitsemus_ja_liikuntasuositukset]"]:checked').val();


 	if(thisVal == '0')
 	{

	  $( '[name="Profile[ruokavalio]"][value=0]' ).prop( "checked", true );
	  $( '[name="Profile[liikunta]"][value=0]' ).prop( "checked", true );
	  $( '[name="Profile[energia]"][value=0]' ).prop( "checked", true );
	  $( '[name="Profile[muokkaa_energia_suositusta]"][value=0]' ).prop( "checked", true );
	  $( '[name="Profile[aineenvaihdunta]"][value=0]' ).prop( "checked", true );
	  //$( '[name="Profile[aktiivisuuskerroin]"][value=0]' ).prop( "checked", true );

	  $('[name="Profile[lepoaineenvaihdunta]"]').val(0);



	  $('#My_ruokavalio').hide('slow');
	  $('#My_lepoaineenvaihdunta').hide('slow');
	  $('#My_liikunta').hide('slow');
	  $('#My_energia').hide('slow');
	  $('#My_aineenvaihdunta').hide('slow');
	  //$('#My_aktiivisuuskerroin').hide('slow');
	  $('#My_laihtumisnopeus_viikossa').hide('slow');

 	} 

 	if(thisVal == '1')
 	{

	  $('#My_ruokavalio').show('slow'); 
	  $('#My_liikunta').show('slow');
	  $('#My_energia').show('slow');
	  $('#My_aineenvaihdunta').show('slow');
	  $('#My_aktiivisuuskerroin').show('slow');

	}

 	TarkistaRuokavalio();
 	TarkistaLiikunta();
 	TarkistaEnergia();
 	TarkistaEnergiaSuositus();
 	TarkistaAineVaihdu();
 	TarkistaRuokavalioSuositusta();
 	TarkistaLiikuntaKestoViikossa();
 }


 

 $('[name="Profile[proteiinia_1]"]').keyup(function(){
	var thisVal = $(this).val();
	max100(thisVal);
 });

 $('[name="Profile[hiilihydraatteja]"]').keyup(function(){
	var thisVal = $(this).val();
	max100(thisVal);
 });

 $('[name="Profile[rasvaa]"]').keyup(function(){
	var thisVal = $(this).val();
	max100(thisVal);
 });

 function max100(val)
 {
	var pr = parseFloat($('[name="Profile[proteiinia_1]"]').val());
	var hi = parseFloat($('[name="Profile[hiilihydraatteja]"]').val());
	var rasv = parseFloat($('[name="Profile[rasvaa]"]').val());
	var sum = pr+hi+rasv;

	if(sum > 100)
	{
		$('[name="Profile[proteiinia_1]"]').val('');
		$('[name="Profile[hiilihydraatteja]"]').val('');
		$('[name="Profile[rasvaa]"]').val('');
		alert('Yhteenlaskettu arvo saa olla maksimissaan 100')
	}
 }



 $('[name="Profile[maarita_itse]"]').attr('placeholder','Laita arvo minuuteissa').attr('type', 'number');
 $('[name="Profile[lepoaineenvaihdunta]"]').attr('placeholder','Laita arvo minuuteissa').attr('type', 'number');




/* laskuri */
 $('[name="Profile[pituus]"]').keyup(function(){
	laskuri(null);
 });
 $('[name="Profile[paino]"]').keyup(function(){
	laskuri(null);
 });



 function laskuri(sel)
 {
   var pituus = $('[name="Profile[pituus]"]').val();
   var paino = $('[name="Profile[paino]"]').val();
   var alaraja = '';

   $.ajax({
   url: 'alaraja_ajax',
      type: "POST",
      data: { pituus : pituus },
      	success: function(data){
  	  	console.log(data);
		alaraja = data;
		replaCer(paino,pituus,alaraja,sel);
      	},
  	error:function(data){
  		console.log(data); 
  	}
   });

 }

 laskuri($('[name="Profile[tavoitepaino]"]').val());

 $('[name="Profile[tavoitepaino_itse]"]').attr('type', 'number');

 if($('[name="Profile[tavoitepaino_itse]"]').val() !== '')
 {
   $('#My_tavoitepaino_itse').show();
 } else {
   $('#My_tavoitepaino_itse').hide();
 }


 function replaCer(paino,pituus,alaraja,sel){

   $('#My_tavoitepaino').replaceWith(
	'<div class="row" id="My_tavoitepaino">' +
	'<label for="Profile_tavoitepaino">Tavoitepaino</label>' +
	'<select class="form-control" name="Profile[tavoitepaino]" id="Profile_tavoitepaino">' +
	'<option value="nykyinen:'+(paino)+'">Nykyinen paino '+(paino)+'kg</option>' +
	'<option value="normaali:'+(pituus-100)+'">Normaalipaino '+(pituus-100)+'kg</option>' +
	'<option value="ihanne:'+(pituus-100-8)+'">Ihannepaino '+(pituus-100-8)+'kg</option>' +
	'</select>' +
	'<div class="errorMessage" id="Profile_tavoitepaino_em_" style="display:none"></div>' +
	'</div>'); 

        if(alaraja !== '')
		$('#Profile_tavoitepaino').append('<option value="alaraja:'+alaraja+'">Alin turvallinen paino '+alaraja+'kg</option>');

	$('#Profile_tavoitepaino').append('<option value=":itse">Määritä itse tavoitepaino</option>');


 $('[name="Profile[tavoitepaino]"]').change(function(){
	var thisVal = $(this).val();
	if(thisVal == ':itse'){
	$('#My_tavoitepaino_itse').show('slow');
	} else {
	$('#My_tavoitepaino_itse').hide('slow');
	$('#Profile_tavoitepaino_itse').val('');
	}
 });

   $("#Profile_tavoitepaino option[value='"+sel+"']").prop('selected', true);
 }

   $("#Profile_tavoitepaino option[value='"+$("#Profile_tavoitepaino").val()+"']").prop('selected', true);



   if($('#Profile_pituus').val() == 0)
   {
   $('#Profile_pituus').val('');
   $('#Profile_pituus').attr('placeholder','cm');
   }

   if($('#Profile_paino').val() == 0)
   {
   $('#Profile_paino').val('');
   $('#Profile_paino').attr('placeholder','kg');
   }


   $('#Profile_proteiinia_1').attr('placeholder','%');
   $('#Profile_hiilihydraatteja').attr('placeholder','%');
   $('#Profile_rasvaa').attr('placeholder','%');
   $('#Profile_energiavaje_energialisa').attr('placeholder','kcal');
   $('#Profile_energiatavoite_kiintea').attr('placeholder','kcal');
   $('#Profile_lepoaineenvaihdunta').attr('placeholder','kcal');

   if($('#Profile_lepoaineenvaihdunta').val() == 0)
   {
   $('#Profile_lepoaineenvaihdunta').val('');
   $('#Profile_lepoaineenvaihdunta').attr('placeholder','kcal');
   }

});
</script>








