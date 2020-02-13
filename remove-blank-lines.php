<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
$meta['title']                  = 'Remove Blank Lines Online';
$meta['description']            = 'Remove Blank Lines Online';
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
<?php _header(); ?>



        <div class="container bg-white py-5 my-3 shadow-sm">
        	
            <form class="_rstool">
                <div class="bg-light border pt-3 px-3 pb-1 rounded">
                	<h6>Remove Blank Lines Online</h6>
                    <div class="row justify-content-center">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 mb-3">
                            <div class="form-group mb-0">
                                <textarea id="input" class="form-control form-control-sm bg-white callout mb-0 callout-primary" placeholder="Start typing..." rows="6"></textarea>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="counter text-primary">
                                        <div class="d-flex small justify-content-center justify-content-md-start">
                                            <div class="mr-3">
                                                Total: <span class="font-weight-bold lead" id="lines">0</span>
                                            </div>
                                            <div class="mr-3">
                                                After: <span class="font-weight-bold lead" id="after">0</span>
                                            </div>
                                            <div class="mr-3">
                                                Removed: <span class="font-weight-bold lead" id="removed">0</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 text-center text-sm-right">

                                    <label type="button" class="btn btn-primary btn-sm py-0 mb-0" data-toggle="tooltip" title="Load File From Your Device">
                                    <span id="filename"></span>
                                        <i class="fa fa-plus-circle"></i>
                                        <input type="file" id="load_file" name="load_file" class="d-none"/>
                                    </label>
                                    <button type="reset" class="btn btn-primary btn-sm py-0" data-toggle="tooltip" title="Reset All Fields"><i class="fa fa-eraser mr-1"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 small">
                            <strong class="d-block mb-2">Options:</strong>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="trim" id="trim" checked="true">
                                <label class="custom-control-label" for="trim">Trim Lines (Start &amp; End)</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="ltrim" id="trim_before">
                                <label class="custom-control-label" for="trim_before">Trim From Start (Every Line)</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="rtrim" id="trim_after">
                                <label class="custom-control-label" for="trim_after">Trim From End (Every Line)</label>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-4 text-center my-1">
                            <button type="submit" class="btn btn-primary btn-sm py-3 px-4" id="submit"><i class="fa fa-eraser mr-2"></i>Remove Blank Lines</button><br/>
                            
                        </div>
                    </div>
		            <div id="results" class="collapse">
		            	<textarea class="form-control form-control-sm bg-white callout mb-0 callout-primary" id="output" rows="8" readonly="true"></textarea>
		            	<div class="text-center my-4">
		            		<button type="button" class="btn btn-dark" data-toggle="tooltip" title="Copy Text" id="copy_text"><i class="fa fa-clipboard mr-2"></i>Copy Code</button>
		            	</div>
		            </div>
                    
                </div>
            </form>
        </div>

<div class="modal" id="process" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-body text-center">
				<div class="spinner-border text-primary" role="status">
					<span class="sr-only">Please Wait</span>
				</div>
				<div class="font-weight-bold text-primary">Removing Blank Lines...</div>
			</div>
		</div>
	</div>
</div>
<script type="javascript/worker" id="removelines">
self.importScripts('https://weforit-tools.github.io/development/js/functions.js');
self.onmessage = function(e){
	if(e.data.file == true){
			var reader = new FileReader();
			reader.readAsText(e.data.input);
			reader.onload = function(fi){
				if(!fi.target.result || !(fi.target.result).trim()){
					return;
				}
				remove_lines(fi.target.result,e.data.trim);
			};

	}else{
		remove_lines(e.data.input,e.data.trim);
	}

	function remove_lines(input,options){
		var trim = {
			'trim':options.trim,
			'left':options.left,
			'right':options.right,
		}
		var string = input;
		string = trim.trim==1?string.trim():string;
		var lines = string.split(/\r|\n/);
		var new_lines = [];
		var total = 0;
		for(i=0;i<lines.length;i++){
			if(!lines[i] || !lines[i].trim()){
				continue;
			}
			var v = lines[i];
			if(trim.left == 1 && total != 1){
				v = v.ltrim();
			}
			if(trim.right == 1){
				v = v.rtrim();
			}
			if(!v){
				continue;
			}
			new_lines.push(v);
			total++;
		}
		postMessage({
			"before":lines.length,
			"after":total,
			"data":new_lines.join('\r\n')
		});

	}
}
</script>
<script>
window.addEventListener('load',function(){
	var ltrim = 0, rtrim = 0, setrim = true;
	$('#copy_text').click2copy('#output');
    $('#load_file').on('change',function(){
        var file = ($(this)[0].files)[0];
        $('#filename').html(file.name);
    })
    $('._rstool').submit(function(e){
        e.preventDefault();

        input = $('#input').val();
        ltrim = $('[name="ltrim"]').is(':checked');
        rtrim = $('[name="rtrim"]').is(':checked');
        setrim = $('[name="trim"]').is(':checked');

        var file = $('#load_file').prop('files')[0];
        var type;

        if(input){
            type = {
                'file':false,
                'input':input,
				'trim' : {
					'trim':setrim,
					'left':ltrim,
					'right':rtrim,
				}
            }
        }
        if(file && file.name){
            type = {
                'file':true,
                'input':file,
				'trim' : {
					'trim':setrim,
					'left':ltrim,
					'right':rtrim,
				}
            }
        }
        if(!type){
            return;
        }
        $('#process').modal('show');
		inlineWorker('#removelines',function(worker){
			worker.postMessage(type);
			worker.onmessage = function(e){
				worker.terminate();
				worker = undefined;
				$('#process .modal-body').append('<div class="small">Blank Lines Removed</div>');
				$('#process').modal('hide');
				$('#output').val(e.data.data);
				$('#lines').html(e.data.before);
				$('#after').html(e.data.after);
				$('#removed').html((e.data.before - e.data.after));
				$('#results').collapse('show');
			};

		});
    });
});
</script>
<?php get_template('inc/tools.php');?>
<?php _footer(); ?>
<?php _foot(array(
	'after_foot'=>'
            <script src="https://weforit-tools.github.io/development/js/global.js"></script>
            <script src="https://weforit-tools.github.io/development/js/functions.js"></script>'
)); ?>