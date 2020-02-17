<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
$meta['title']                  = 'Web Scrapper';
$meta['description']            = 'Web Scrapper';
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
                    <div class="row justify-content-center">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-3">
                            <div class="form-group mb-0">
                				<label class="small text-uppercase">Scrap From:</label>
                                <textarea id="input" class="form-control form-control-sm bg-white callout mb-0 callout-primary" placeholder="Enter the List of URLs" rows="6"></textarea>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-3">
                            <div class="form-group mb-0">
                				<label class="small text-uppercase">Save Into:</label>
                                <textarea id="format" class="form-control form-control-sm bg-white callout mb-0 callout-primary" placeholder="Enter the List of URLs" rows="6"><html>
 <head>
  <title>{title}</title>
  <meta name="description" content="{meta_description}"/>
  <link rel="canonical" href="{canonical}"/>
 </head>
 <body>
  {title}
 </body>
</html></textarea>
                                <code data-toggle="tooltip" title="Replace Title into File" class="code">{title}</code> <code data-toggle="tooltip" title="Replace Meta Description into File"  class="code">{meta_description}</code> <code data-toggle="tooltip" title="Replace Canonical into File" class="code">{canonical}</code>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-3">
                        	<div class="form-group">
								<label class="small text-uppercase">Output File Name Format:</label>
								<div class="input-group input-group-sm mb-2">
									<div class="input-group-prepend">
										<div class="input-group-text">{file_name}</div>
									</div>
									<div class="input-group-prepend">
										<div class="input-group-text">.</div>
									</div>
									<input type="text" class="form-control" id="extension" placeholder="html" value="html">
								</div>
                        	</div>

                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-3">
                        	<div class="from-group">
                        		<label class="small text-uppercase">Extra Elements:</label>
                        		<input type="text" class="form-control form-control-sm" placeholder="#content, .classname" />
                        	</div>
							<div class="custom-control custom-checkbox small mt-1">
								<input type="checkbox" class="custom-control-input" id="plaintext" checked="true">
								<label class="custom-control-label" for="plaintext" style="line-height:2">Extract Plain Text Only</label>
							</div>
                        </div>

                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center my-1">
                            <button type="submit" class="btn btn-primary btn-sm py-3 px-4" id="submit"><i class="fa fa-eraser mr-2"></i>Start Scrapping</button><br/>
                        </div>
                    </div>
                </div>
            </form>
            <div id="results" class="bg-white collapse-r mt-4">
            	<div class="table-responsive">
            		<table class="table table-sm small">
            			<thead>
            				<tr>
            					<th>URL</th>
            					<th>Status</th>
            				</tr>
            			</thead>
            			<tbody id="output_info">
            				<tr>
            					<td class="text-center" colspan="2">No Records</td>
            				</tr>
            			</tbody>
            		</table>
            	</div>
            </div>
            
        </div>

<script type="javascript/worker" id="replace_tags">
self.importScripts('https://weforit-tools.github.io/development/js/functions.js');
self.onmessage = function(e){
	var format = e.data.format;
	var tags = e.data.tags;
	var id = e.data.id;
	var filename = e.data.filename;
	//console.log(e.data);
	var html = format.
				replace(/{title}/g,tags.title).
				replace(/{meta_description}/g,tags.description).
				replace(/{canonical}/g,tags.canonical);
	self.postMessage({
		'id':id,
		'output':html,
		'filename':filename
	});

}
</script>
<script>

var start = 0, url_list = [], extension = 'html', plain_text = true;
window.addEventListener('load',function(){
    $('._rstool').submit(function(e){
        e.preventDefault();
        $submit = $('.btn-submit');
        var url = $('#input').val();
        if(!url){
        	return;
        }
        if($('#extension').val()){
        	extension = $('#extension').val();
        }
        url = url.split(/\r?\n/);
        //console.log(url)
        $submit.attr('disabled',1);
        $('#output_info').html('');
        process_url(url,0);
    });
});
function process_url(urls,num){
	if(num >= urls.length){
        $submit.removeAttr('disabled');
		return;
	}
	if(!urls[num]){
		num++;
		process_url(urls,num);
		return;
	}
	var url = urls[num];
	var tr = '<tr id="url_'+num+'"><td>'+url+'</td><td><span class="badge status badge-warning">Processing...</span></td></tr>';
	$('#output_info').append(tr);
	var $url = $('#url_'+num+' .status');
	$.ajax({
		url:'<?=base_url('api/webscrapper/');?>',
		type:'post',
		dataType:'json',
		data:{
			'url':url,
			'plaintext':plain_text
		},
		success:function(response){
			console.log(response);
			$url.removeClass('badge-warning');
			if(response.success){
				$url.addClass('badge-success').html('Preparing Download');
				inlineWorker('#replace_tags',function(worker){
					worker.postMessage({
						'format':$('#format').val(),
						'tags':response.success,
						'id':num,
						'filename':(response.filename)+'.'+extension
					});
					worker.onmessage = function(e){
						var d = e.data;
						var $badge = $('#url_'+d.id+' .status');

						var blob = new Blob([d.output], {type: "octet/stream"});

						url = window.URL.createObjectURL(blob);
						//window.URL.revokeObjectURL(url);
						$badge.replaceWith('<a target="_blank" class="badge badge-success" download="'+d.filename+'" href="'+url+'">Download File</a>');
					}
				});
			}else{
				$url.addClass('badge-danger').html('Failed');
			}
			num++;
			process_url(urls,num);
		},
		error:function(){
			$url.removeClass('badge-warning');
			$url.addClass('badge-danger').html('Failed');
			num++;
			process_url(urls,num);
		}
	})

}
</script>
<?php get_template('inc/tools.php');?>
<?php get_template('inc/footer_tools'); ?>
<?php _foot(array(
	'after_foot'=>'
            <script src="https://weforit-tools.github.io/development/js/global.js"></script>
            <script src="https://weforit-tools.github.io/development/js/functions.js"></script>'
)); ?>