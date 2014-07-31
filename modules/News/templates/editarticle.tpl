<div id="editarticle_result"></div>
{debug}
{$startform}
<div class="pageoverflow">
  <p class="pagetext">&nbsp;</p>
  <p class="pageinput">{$hidden}{$submit}{$cancel}{if isset($apply)}{$apply}{/if}</p>
</div>

{if isset($start_tab_headers)}
{$start_tab_headers}
{$tabheader_article}
<div style="display:none">
{$tabheader_preview}
</div>
{$end_tab_headers}

{$start_tab_content}
{$start_tab_article}
{/if}
<div id="edit_article">
{if $inputauthor}
	<div class="pageoverflow">
		<p class="pagetext">*{$authortext}:</p>
		<p class="pageinput">{$inputauthor}</p>
	</div>
{/if}
	<div class="pageoverflow">
		<p class="pagetext">*Nadpis Sk:</p>
		<p class="pageinput">{$inputtitle}</p>
	</div>
	{if isset($custom_fields)}
{foreach from=$custom_fields item='field'}
        <div class="pageoverflow" name="{$field->prompt}">
           <p class="pagetext">{$field->prompt}</p>
           <p class="pageinput">{$field->field}</p>
        </div>
{/foreach}
{/if}
	<div class="pageoverflow">
		<p class="pagetext">*{$categorytext}:</p>
		<p class="pageinput">{$inputcategory}</p>
	</div>
	<div class="pageoverflow">
		<p class="pagetext">*Obsah Sk:</p>
		<p class="pageinput">{$inputcontent}</p>
	</div>
{if !isset($hide_summary_field) or $hide_summary_field == '0'}
	<div class="pageoverflow">
		<p class="pagetext">Obsah En:</p>
		<p class="pageinput">{$inputsummary}</p>
	</div>
{/if}
	<!--<div class="pageoverflow">
		<p class="pagetext">{$extratext}:</p>
		<p class="pageinput">{$inputextra}</p>
		
	</div>
        <div class="pageoverflow">
                <p class="pagetext">{$urltext}:</p>
                <p class="pageinput">{$inputurl}</p>
        </div>  -->

	<div class="pageoverflow">
		<p class="pagetext">{$postdatetext}:</p>
		<p class="pageinput">{html_select_date prefix=$postdateprefix time=$postdate start_year="-30" end_year="+15"} {html_select_time prefix=$postdateprefix time=$postdate}</p>
	</div>
{if isset($statustext)}
	<div class="pageoverflow">
		<p class="pagetext">*{$statustext}:</p>
		<p class="pageinput">{$status}</p>
	</div>
{else}
	{$status}
{/if}
	<div class="expirationDate">
		<div class="pageoverflow">
			<p class="pagetext">{$useexpirationtext}:</p>
			<p class="pageinput"><input type="checkbox" name="{$actionid}useexp" {if $useexp == 1}checked="checked"{/if} onclick="togglecollapse('expiryinfo');" class="pagecheckbox"/></p>
		</div>
		<div id="expiryinfo" {if $useexp != 1}style="display: none;"{/if}>
		<div class="pageoverflow">
			<p class="pagetext">{$startdatetext}:</p>
			<p class="pageinput">{html_select_date prefix=$startdateprefix time=$startdate start_year="-10" end_year="+15"} {html_select_time prefix=$startdateprefix time=$startdate}</p>
		</div>
		<div class="pageoverflow">
			<p class="pagetext">{$enddatetext}:</p>
			<p class="pageinput">{html_select_date prefix=$enddateprefix time=$enddate start_year="-10" end_year="+15"} {html_select_time prefix=$enddateprefix time=$enddate}</p>
		</div>
		</div>
	</div>
</div>
{if isset($end_tab_article)}{$end_tab_article}{/if}

{if isset($start_tab_preview)}
{$start_tab_preview}
<script type="text/javascript">{literal}
jQuery(document).ready(function(){
	if($("#edit_article .cms_dropdown[name='m1_category'] option:selected").val() == 2){ //je zvolena historia
		hideHistoriaFields();
	}
	$("#edit_article .cms_dropdown[name='m1_category']").change(function(){
		console.log($(this).val());
		if($(this).val() == 2){
			hideHistoriaFields();
		}else{
			showHistoriaFields();
		}
	});
  jQuery('[name=m1_apply]').live('click',function(){
    if( typeof tinyMCE != 'undefined') tinyMCE.triggerSave();
    var data = jQuery('form').find('input:not([type=submit]), select, textarea').serializeArray();
    data.push({'name': 'm1_ajax', 'value': 1});
    data.push({'name': 'm1_apply', 'value': 1});
    data.push({'name': 'showtemplate', 'value': 'false'});
    var url = jQuery('form').attr('action');
    jQuery.post(url,data,function(resultdata,text){
      var resp = jQuery(resultdata).find('Response').text();
      var details = jQuery(resultdata).find('Details').text();
      var htmlShow = '';
      if( resp == 'Success' && details != '' )
      {
	 htmlShow = '<div class="pagemcontainer"><p class="pagemessage">'+details+'<\/p><\/div>';
      }
      else
      {
	 htmlShow = '<div class="pageerrorcontainer"><ul class="pageerror">';
	 htmlShow += details;
	 htmlShow += '<\/ul><\/div>';
      }
      jQuery('#editarticle_result').html(htmlShow);
    },'xml');
    return false;
  });
  function hideHistoriaFields(){
	$(".pageoverflow[name='Nadpis En']").hide();
	$("select[name='m1_postdate_Month']").hide();
	$("select[name='m1_postdate_Day']").hide();
	$("select[name='m1_postdate_Hour']").hide();
	$("select[name='m1_postdate_Minute']").hide();
	$("select[name='m1_postdate_Second']").hide();
	$(".expirationDate").hide();
  }
  function showHistoriaFields(){
		$(".pageoverflow[name='Nadpis En']").show();
		$("select[name='m1_postdate_Month']").show();
		$("select[name='m1_postdate_Day']").show();
		$("select[name='m1_postdate_Hour']").show();
		$("select[name='m1_postdate_Minute']").show();
		$("select[name='m1_postdate_Second']").show();
		$(".expirationDate").show();
	  }
  function news_dopreview()
  {
    if( typeof tinyMCE != 'undefined') tinyMCE.triggerSave();
    var data = jQuery('form').find('input:not([type=submit]), select, textarea').serializeArray();
    data.push({'name': 'm1_ajax', 'value': 1});
    data.push({'name': 'm1_preview', 'value': 1});
    data.push({'name': 'showtemplate', 'value': 'false'});
    data.push({'name': 'm1_previewpage', 'value': jQuery('#preview_returnid').val()});
    data.push({'name': 'm1_detailtemplate', 'value': jQuery('#preview_template').val()});
    var url = jQuery('form').attr('action');
    jQuery.post(url,data,function(resultdata,text){
      var resp = jQuery(resultdata).find('Response').text();
      var details = jQuery(resultdata).find('Details').text();
      var htmlShow = '';
      if( resp == 'Success' && details != '' )
      {
	 // preview worked... now the details should contain the url
         details = details.replace(/amp;/g,'');
         jQuery('#previewframe').attr('src',details);
      }
      else
      {
	 if( details == '' ) details = 'An unknown error occurred';

	 // preview save did not work.
	 htmlShow = '<div class="pageerrorcontainer"><ul class="pageerror">';
	 htmlShow += details;
	 htmlShow += '<\/ul><\/div>';
         jQuery('#editarticle_result').html(htmlShow);
      }
    },'xml');
  }

  jQuery('#preview').click(function(){
    news_dopreview();
    return false;
  });

  jQuery('#preview_returnid,#preview_template').change(function(){
    news_dopreview();
    return false;
  });
});
{/literal}</script>

{* display a warning *}
<div class="pagewarning">{$warning_preview}</div>
<fieldset>
  <label for="preview_template">{$prompt_detail_template}:</label>&nbsp;
  <select id="preview_template" name="preview_template">
  {html_options options=$detail_templates selected=$cur_detail_template}
  </select>&nbsp;

  <label for="preview_returnid">{$prompt_detail_page}:</label>&nbsp;
  {$preview_returnid}
</fieldset>
<br/>
<iframe id="previewframe" style="height: 800px; width: 100%; border: 1px solid black; overflow: auto;" src=""></iframe>
{$end_tab_preview}
{$end_tab_content}
{/if}

<div class="pageoverflow">
  <p class="pagetext">&nbsp;</p>
  <p class="pageinput">{$hidden}{$submit}{$cancel}{if isset($apply)}{$apply}{/if}</p>
</div>
{$endform}
