<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
$meta['title']                  = 'FAQPage JSON-LD Schema Generator';
$meta['description']            = 'FAQPage JSON-LD Schema Generator';
$meta['page_url']               = '';
$meta['og_title']               = $meta['title'];
$meta['og_description']         = $meta['description'];
//$meta['og_image']               = 'https://www.irahulsaini.com/images/giveaways.jpg';
//$meta['og_image_width']         = '1200';
//$meta['og_image_height']        = '628';
//$meta['twitter_title']          = $meta['title'];
//$meta['twitter_description']    = $meta['description'];
//$meta['twitter_image']          = $meta['og_image'];

?>
<?php _head(array(
    'meta'          => $meta,
)); ?>
<?php get_template('inc/header_tools'); ?>



        <div class="container my-3 ">

			<div class="action-btn ">
				<button type="button" class="add-question btn btn-primary px-2 btn-sm"><i class="fa fa-plus mr-2"></i>Add Question</button>
				<button type="button" data-toggle="modal" data-target="#import-modal" class="btn btn-primary px-2 btn-sm"><i class="fa fa-folder-open-o mr-2"></i>Import</button>
				<button type="button" class="export btn btn-primary px-2 btn-sm"><i class="fa fa-external-link mr-2"></i>Export</button>
				<button type="button" class="test_code btn btn-primary px-2 btn-sm"><i class="fa fa-cogs mr-2"></i>Test Code</button>
				<button type="button" class="copy_text btn btn-dark px-2 btn-sm"><i class="fa fa-code mr-2"></i>Copy Code</button>
				<button type="button" class="delete_all btn btn-danger px-2 btn-sm"><i class="fa fa-trash mr-2"></i>Empty</button>
			</div>
			<form class="row mt-3">
				<div class="col-12 col-md-7 col-xl-7">
					<div id="faq-page">
						<div class="text-center">
							<div class="text-center spinner-border text-primary" role="status">
							  <span class="sr-only">Loading...</span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-5 col-xl-5">
					<div class="sticky-top" style="top:10px">
						<div class="card border-0 small shadow-sm mb-2 sticky-top"  id="card-output">
							<div class="card-header border-0 bg-white py-2 px-3">
								<strong>JSON-LD FAQ Schema</strong>
								<div class="card-tool">
									<button type="button" class="copy_text btn btn-sm py-2"><i class="fa fa-clipboard"></i></button>
									<button type="button" id="save_file" class=" btn btn-sm py-2"><i class="fa fa-download"></i></button>
								</div>
							</div>
							<div class="card-body p-0">
								<textarea id="output" style="height:200px;" class="border-0 bg-white form-control form-control-sm px-3" placeholder="Output" readonly="true"></textarea>
								<div class="row px-2 py-2 border-top">
									<div class="col-6">
										<div class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" id="remove-empty">
											<label style="padding-top:2px" class="custom-control-label" for="remove-empty">Remove Empty Questions</label>
										</div>
									</div>
									<div class="col-6">
										<div class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" id="minify">
											<label style="padding-top:2px" class="custom-control-label" for="minify">Minify Code</label>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="text-center">
							<button type="button" data-toggle="tooltip" title="Test Code" class="test_code btn btn-primary px-2 btn-sm mb-1"><i class="fa fa-cogs"></i></button>
							<button type="button" data-toggle="tooltip" title="Copy Code" class="copy_text btn btn-dark px-2 btn-sm mb-1"><i class="fa fa-clipboard"></i></button>
							<button type="button" data-toggle="tooltip" title="Empty or Delete All Questions" class="delete_all btn btn-danger px-2 btn-sm mb-1"><i class="fa fa-trash"></i></button>
						</div>
					</div>
				</div>
			</form>
        </div>

<div class="modal fade" id="import-modal" data-keyboard="false" data-backdrop="static"  tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<ul class="nav nav-tabs" id="input-method" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="direct-input-tab" data-toggle="tab" href="#direct-input" role="tab" aria-controls="direct-input" aria-selected="true">Direct Input</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="upload-file-tab" data-toggle="tab" href="#upload-file" role="tab" aria-controls="upload-file" aria-selected="true">Upload File</a>
					</li>
				</ul>
				<div class="tab-content small p-3 border-left border-right border-bottom" id="input-method-content">
					<div class="tab-pane small fade show active" id="direct-input" role="tabpanel" aria-labelledby="direct-input-tab">
							<label>Code must be in valid JSON format without script tags</label>
							<textarea id="direct-input-textarea" class="form-control form-control-sm" style="height:200px;font-size:.7rem" placeholder='{
    "@context": "https://schema.org",
    "@type": "FAQPage",
    "mainEntity": [
        {
            "@type": "Question",
            "name": "What is Schema FAQ Page",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "A FAQPage is a WebPage presenting one or more \"Frequently asked questions\""
            }
        },
        {
            "@type": "Question",
            "name": "How to Add Schema FAQ Page into Website",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Pretty Simple, Use Markup or JSON-LD for Schema FAQPage"
            }
        }
    ]
}'></textarea>
					</div>
					<div class="tab-pane fade" id="upload-file" role="tabpanel" aria-labelledby="upload-file-tab">
						<div class="custom-file">
						  <input type="file" class="custom-file-input" id="json-file">
						  <label class="custom-file-label" for="json-file">Choose file</label>
						</div>
					</div>
				</div>
				<div class="mt-2 text-center">
					<button type="button" class="btn btn-primary px-3 btn-import">Import</button>
					<button type="button" data-dismiss="modal" class="btn btn-danger px-3">Cancel</button>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="javascript/process" id="readfile">
	var mainEntity = [], question = 0;
	self.onmessage = function(e){
		var type = e.data.type;
		if(type == 'file'){
			var file = e.data.response;
			var reader = new FileReader();
			reader.onload = function(e){
				var json = e.target.result;
				try{
					json = JSON.parse(json);
				}catch(e){
					postMessage('error');
					return;
				}
				if(!json['@context'] || json['@type'] != 'FAQPage' || !json.mainEntity.length){
					postMessage('error');
					return;
				}
				mainEntity = json.mainEntity;
				setTimeout(function(){process_question()},0);
			}
			reader.readAsText(file);
		}else{
			var json = e.data.response;
			try{
				json = JSON.parse(json);
			}catch(e){
				postMessage('error');
				return;
			}
			if(!json['@context'] || json['@type'] != 'FAQPage' || !json.mainEntity.length){
				postMessage('error');
				return;
			}
			mainEntity = json.mainEntity;
			setTimeout(function(){process_question()},0);
		}
	}
	function process_question(){
		if(question >= mainEntity.length){
			postMessage('done');
			return;
		}
		postMessage(mainEntity[question]);
		question++
		setTimeout(function(){process_question()},0);
	}
</script>

<script type="text/template" id="html_template">
	<!-- Question Start -->
	<div class="card border-0 small shadow-sm mb-2">
		<div class="card-header d-flex border-0 bg-white p-0">
			<input type="text" class="font-weight-bold question border-0 rounded-0 form-control form-control-sm py-3 px-3">
			<div class="card-tool bg-white position-relative d-flex h-100">
				<button type="button" title="Collapse" data-toggle="collapse" class="btn-collapse btn btn-sm"><strong>_</strong></button>
				<button type="button" title="Free Move (Up & Down)" data-toggle="tooltip" class="btn-move btn btn-sm"><i class="fa fa-arrows"></i></button>
				<button type="button" title="Delete" data-toggle="tooltip" class="btn btn-sm delete-ques"><i class="fa fa-trash text-danger"></i></button>
			</div>
		</div>
		<div class="collapse show">
			<div class="card-body p-0">
				<textarea class="border-0 answer form-control form-control-sm px-3" placeholder="Answer #{num}"></textarea>
			</div>
		</div>
	</div>
	<!-- /Question End -->
</script>
<script>
var count = 1;
window.addEventListener('load',function(){
	$('#faq-page').html('');
	$('#save_file').click2download('#output');
	$('.copy_text').click2copy('#output');
	//$('#input').on('keyup',callback_reverse_text);
	$('.delete_all').on('click',function(){
		var response = confirm('Do You want to Delete All Questions?');
		if(response == true){
			$('#faq-page').html('');
			generate_schema();
			count = 1;
		}
	});
	$('.add-question').on('click',function(){
		add_question();
		generate_schema();
	});
	$(document).on('click','.delete-ques',function(){
		var response = confirm('Do You want to Delete Question, It can\'t be Recover?');
		if(response == true){
			var id = $(this).attr('data-delete');
			var is_exists = $('#ques-'+id).html();
			
			if(id > 0 || is_exists || is_exists.length > 0){
				$('#ques-'+id).fadeOut('slow',function(){
					$('#ques-'+id).remove();
					re_order();
					sort_card();
					generate_schema();
				});
			}
		}
	});

	$('#faq-page').on('keyup paste',function(){
		generate_schema();
	})
	
	add_question(4);
	generate_schema();
	$(window).scroll(function(){
		var top = $(this).scrollTop();
		if(top > 150){
			$('.option-bar').addClass('bar-show');
		}else{
			$('.option-bar').removeClass('bar-show')
		}
	});
	$('#remove-empty').change(function(){generate_schema()});
	$('#minify').change(function(){generate_schema()});
	$('.test_code').on('click',function(){
		var $form = $('<form class="d-none" target="_blank" action="https://search.google.com/structured-data/testing-tool"><textarea id="output_code_test" name="code"></textarea></form>');
		$('body').append($form);
		$('textarea#output_code_test',$form).val($('#output').val());
		$form.trigger('submit');
		$form.remove();
	});
	$('.export').on('click',function(){
		export_json();
	});
	$('#json-file').on('change',function(){
        $(this).next('.custom-file-label').html($(this).prop('files')[0].name);
	})
	$('.btn-import').on('click',function(){
		import_json();		
	})
});
function add_question(num,ques,answ){
	if(!num){
		num = 1;
	}
	for(i=1;i<=num;i++){
		var $html_template = $($('#html_template').html());
		$html_template.attr('id','ques-'+count);
		$('.form-control.question',$html_template).attr({
			'placeholder':'Question #'+count
		}).val(ques?ques:'');
		$('.form-control.answer',$html_template).attr('placeholder','Answer #'+count).val(answ?answ:'');
		$('button.delete-ques',$html_template).attr('data-delete',count);
		$('.btn-collapse',$html_template).attr('data-target','#answ-'+count);
		$('.collapse',$html_template).attr('id','answ-'+count);
		count++;
		$('#faq-page').append($html_template);
	}
	sort_card();
}
function re_order(){
	$('#faq-page .card').each(function(i,v){
		$('.form-control.question',v).attr('placeholder','Question #'+(i+1));
		$('.form-control.answer',v).attr('placeholder','Answer #'+(i+1));
	})	
}
function generate_schema(){
	var minify = $('#minify').is(":checked");
	var output = [];
	output.push('<script type="application/ld+json">');
	var json = {
		"@context": "https://schema.org",
		"@type": "FAQPage",
		"mainEntity" : compile_question()
	}
	if(minify == true){
		json = JSON.stringify(json);
	}else{
		json = JSON.stringify(json,null, 4);
	}
	output.push(json);
	output.push('<\/script>');
	$('#output').val(output.join('\r\n'))	
}
function compile_question(){
	var main_entity = [];
	var remove_empty = $('#remove-empty').is(":checked");
	$('#faq-page .card').each(function(i,v){
		var ques = $('.form-control.question',v).val();
		var answ = $('.form-control.answer',v).val();
		if(!ques && !answ && remove_empty == true){
			return true;
		}
		main_entity.push({
			"@type":"Question",
			"name":ques,
			"acceptedAnswer":{
				"@type":"Answer",
				"text":answ
			}
		})
	});
	return main_entity;
}
function sort_card(){
	$("#faq-page" ).sortable({
		handle:'.btn-move',
		cancel: '',
		axis: 'y',
		update:function(event, ui){
			re_order();
			generate_schema();
		}
	});
}
function export_json(){
	var json = $('#output').val();
	json = json.replace('<script type="application/ld+json">','').replace('<\/script>','');
	json = JSON.parse(json);
	json = JSON.stringify(json);
	save_file(json,'FAQPage-JSON-Schema-'+timestamp(true)+'.json');
}
function import_json(){
	var input = $('#direct-input-textarea').val();
	var file = $('#json-file').prop('files');
	var type;
	if($("ul#input-method a.active")){
		if($("ul#input-method a.active").attr('id') == 'direct-input-tab'){
			type = 'direct'
			if(!input){
				return;
			}
		}
		if($("ul#input-method a.active").attr('id') == 'upload-file-tab'){
			type = 'file';
			if(!file.length){
				return;
			}
		}
	}
	if(!type){
		return;
	}

	var num = 0;
	start_process('#readfile',function(process){
		var btn_val = $('#import-modal .btn-import').html();
		$('#import-modal .btn-import').html('<i class="fa fa-spinner fa-spin"></i>').attr('disabled','disabled');
		process.postMessage({
			'type':type,
			'response':type=='file'?file[0]:input
		});
		process.onmessage = function(e){
			if(e.data == 'done'){
				process.terminate();
				process = undefined;
				re_order();
				generate_schema();
				$('#json-file').val('');
				$('#import-modal').modal('hide');
				snackbar(num + ' Question Imported!');
				$('#import-modal .btn-import').html(btn_val).removeAttr('disabled');
				return;
			}
			if(e.data == 'error'){
				snackbar('<i class="fa fa-times mr-2"></i>Invalid JSON');
				process.terminate();
				process = undefined;
				$('#import-modal .btn-import').html(btn_val).removeAttr('disabled');
				return;
			}
			num++;
			add_question(1,e.data['name']?e.data['name']:'',e.data.acceptedAnswer.text?e.data.acceptedAnswer.text:'');
		}
	});
}
</script>
<?php get_template('inc/tools.php');?>
<?php get_template('inc/footer_tools'); ?>
<?php _foot(array(
	'after_foot'=>'
            <script src="https://weforit-tools.github.io/development/js/global.js"></script>
            <script src="https://weforit-tools.github.io/development/js/functions.js"></script>'
)); ?>