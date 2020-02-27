<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
$meta['title']                  = 'Add Prefix Suffix Online';
$meta['description']            = 'Add Prefix Suffix Online';
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



        <div class="container bg-white py-5 my-3 shadow-sm">
        	
            <form class="_rstool">
                <div class="bg-light border pt-3 px-3 pb-1 rounded">
                	<h6>Add Prefix Suffix Online</h6>
                    <div class="row justify-content-center">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 mb-3">
                            <div class="form-group mb-0">
                                <textarea id="input" class="form-control form-control-sm bg-white callout mb-0 callout-primary" placeholder="Start typing..." rows="8"></textarea>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 small">
                            <strong class="d-block mb-2">Options:</strong>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="trim" id="trim" checked="true">
                                <label class="custom-control-label" for="trim">Trim (Start &amp; End)</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="ltrim" id="trim_before">
                                <label class="custom-control-label" for="trim_before">Trim From Start (Every Line)</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="rtrim" id="trim_after">
                                <label class="custom-control-label" for="trim_after">Trim From End (Every Line)</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="remove_blank" id="remove_blank" checked="true">
                                <label class="custom-control-label" for="remove_blank">Exclude Blank Lines</label>
                            </div>
                            <div class="row mt-3">
                            	<div class="col-6">
		                            <div class="form-group">
		                            	<label class="mb-0"><strong>Prefix:</strong></label>
		                            	<input type="text" class="form-control form-control-sm" id="prefix" placeholder="Mr.">
		                            </div>
                            	</div>
                            	<div class="col-6">
		                            <div class="form-group">
		                            	<label class="mb-0"><strong>Suffix:</strong></label>
		                            	<input type="text" class="form-control form-control-sm" id="suffix" placeholder="(Organisation)">
		                            </div>
                            	</div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-4 text-center my-1">
                            <button type="submit" class="btn btn-primary btn-sm py-3 px-4" id="submit">
                            	<i class="fa fa-send mr-2"></i>Submit
                            </button>
                        </div>
                    </div>
		            <div id="results" class="collapse mt-4">
		            	<textarea class="form-control form-control-sm bg-white callout mb-0 callout-primary" id="output" rows="8" readonly="true"></textarea>
		            	<div class="text-center my-4">
		            		<button type="button" class="btn btn-primary mr-2" data-toggle="tooltip" title="Copy Text" id="copy_text"><i class="fa fa-clipboard mr-2"></i>Copy Code</button>
		            		<button type="button" class="btn btn-primary" data-toggle="tooltip" title="Copy Text" id="save_file"><i class="fa fa-save mr-2"></i>Download File</button>
		            	</div>
		            	<div class="callout callout-info collapse" id="download_info">
		            		We've transferred file into your device and it'll start downloading shortly. If no downloads then your system doesn't support file <code>window.webkitURL.createObjectURL(blob)</code>
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
				<div class="font-weight-bold text-primary" id="status">Adding Prefix Suffix...</div>
			</div>
		</div>
	</div>
</div>
<script type="javascript/worker" id="process_data">
self.importScripts('http://localhost/rs/views/assets/js/functions.js');
self.onmessage = function(e){
	process_data(e.data);
	function process_data(data){
		var input = data.input;
		var trim = data.trim;
		var ltrim = data.ltrim;
		var rtrim = data.rtrim;
		var prefix = data.prefix;
		var suffix = data.suffix;
		var remove_blank = data.rb;

		string = trim==1?input.trim():input;
		var lines = input.split(/\r|\n/);
		var new_lines = [];
		for(i=0;i<lines.length;i++){
			var line = lines[i];
			if(ltrim == 1){
				line = line.ltrim();
			}
			if(rtrim == 1){
				line = line.rtrim();
			}
			if(!line && remove_blank == true){
				continue;
			}
			new_lines.push(prefix + line + suffix);
		}
		postMessage({
			"total":lines.length,
			"data":new_lines.join('\r\n')
		});

	}
}
</script>
<script>

var ltrim = 0, rtrim = 0, trim = true, rb = true;
window.addEventListener('load',function(){
	$('#copy_text').click2copy('#output');

	$('#save_file').on('click',function(e){
		e.preventDefault();
		save_file($('#output').val(),'output.txt');
		$('#download_info').collapse('show');
	})
	//$('#save_file').click2download('#output',filename);
    $('._rstool').submit(function(e){
        e.preventDefault();

        var input = $('#input').val();
        var prefix = $('#prefix').val();
        var suffix = $('#suffix').val();
        ltrim = $('[name="ltrim"]').is(':checked');
        rtrim = $('[name="rtrim"]').is(':checked');
        trim = $('[name="trim"]').is(':checked');
        rb = $('#remove_blank').is(':checked');
        if(!input || (!prefix && !suffix)){
        	return;
        }

        $('#process').modal('show');
		inlineWorker('#process_data',function(worker){
			worker.postMessage({
				'input':input,
				'prefix':prefix,
				'suffix':suffix,
				'trim':trim,
				'ltrim':ltrim,
				'rtrim':rtrim,
				'rb':rb
			});
			worker.onmessage = function(e){
				worker.terminate();
				worker = undefined;
				$('#process #status').html('<div class="small">Blank Lines Removed</div>');
				$('#process').modal('hide');
				$('#output').html(e.data.data);
				$('#results').collapse('show');
			};

		});
    });
});
</script>
<?php get_template('inc/tools.php');?>
<?php get_template('inc/footer_tools'); ?>
<?php _foot(array(
	'after_foot'=>'
            <script src="https://weforit-tools.github.io/development/js/global.js"></script>
            <script src="https://weforit-tools.github.io/development/js/functions.js"></script>'
)); ?>