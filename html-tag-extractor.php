<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
$meta['title']                  = 'HTML Tag Extractor';
$meta['description']            = 'HTML Tag Extractor';
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

<style type="text/css">
    .tableexport-caption{
        display:none;
    }
</style>


        <div class="container bg-white py-5 my-3 shadow-sm">
        	<h5 class="text-center mb-4">HTML Tag Extractor</h5>        	
            <form class="_rstool">
                <div class="bg-light border pt-3 px-3 pb-1 rounded">
                    <div class="row justify-content-center">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-8 mb-3">
                            <div class="form-group mb-0">
                				<label class="small text-uppercase">URL List</label>
                                <textarea id="input" class="form-control form-control-sm bg-white callout mb-0 callout-primary" placeholder="Enter the List of URLs" rows="6"></textarea>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-4 mb-3">
                        	<div class="from-group">
                        		<label class="small text-uppercase">Tag to Extract:</label>
                        		<input type="text" id="tag" class="form-control form-control-sm" placeholder="title or #content or .classname" />
                        	</div>
							<div class="custom-control custom-checkbox small mt-1">
								<input type="checkbox" class="custom-control-input" id="plaintext" checked="true">
								<label class="custom-control-label" for="plaintext" style="line-height:2">Extract Plain Text Only</label>
							</div>
                        </div>


                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center my-1">
                            <button type="submit" class="btn btn-primary btn-sm btn-submit py-3 px-4" id="submit"><i class="fa fa-eraser mr-2"></i>Start Extracting</button><br/>
                            <span class="response" id="response"></span>
                        </div>
                    </div>
                </div>
            </form>
            <div id="results" class="bg-white collapse-r mt-4">
            	<div class="table-responsive">
            		<table class="table table-sm small" id="results_table" style="width:100%">
            			<thead>
            				<tr>
            					<th>URL</th>
            					<th>Status</th>
            					<th id="tag_name">HTML Tag</th>
            				</tr>
            			</thead>
            			<tbody id="output_info" style="width:100%">
            				<tr>
            					<td class="text-center" colspan="3">No Records</td>
            				</tr>
            			</tbody>
            		</table>
            	</div>
                <div class="export-btn-group collapse">
                    <button type="button" class="btn btn-primary btn-sm px-3" id="export-csv">Export CSV</button>
                    <button type="button" class="btn btn-primary btn-sm px-3" id="export-txt">Export Text</button>
                </div>
            </div>
            
        </div>


<script>

var start = 0, url_list = [], extension = 'html', plain_text = true, html_tag = false, submit=0;
var config_export = {
    filename:'HTML_Tag_Export'
}
window.addEventListener('load',function(){
    $('#export-csv').on('click',function(e){
        e.preventDefault();
        $('.tableexport-caption .button-default.csv').trigger('click');
    });
    $('#export-txt').on('click',function(e){
        e.preventDefault();
        $('.tableexport-caption .button-default.txt').trigger('click');
    }); 
    $('._rstool').submit(function(e){
        e.preventDefault();
        $submit = $('.btn-submit');
        if(submit >= 1){
        	$('.response').html('<div class="alert alert-danger">Please Refresh the Page to Run Extractor Again</div>');
        	$(document).scrollto('response',0);
        	return;
        }
        submit = 1;
        var url = $('#input').val();
        html_tag = $('#tag').val();
        if(!url || !html_tag){
        	return;
        }
        html_tag = html_tag.trim()
        if($('#plaintext').prop('checked') == true){
        	plain_text = true;
        }else{
        	plain_text = false;
        }
        url = url.split(/\r?\n/);
        //console.log(url)
        $submit.attr('disabled',1);
        $('#output_info').html('');
        $('#tag_name').html(html_tag);
        process_url(url,0);
    });
});
function process_url(urls,num){
	if(num >= urls.length){
        $submit.removeAttr('disabled');
        var table = $("#results_table").DataTable({
                "retrieve"          : true,
                "scrollY"           : '300px',
                "scrollX"           : true,
                "scrollCollapse"    : true,
                "paging"            : false
        });
        $("#results_table").tableExport(config_export);
        $('.export-btn-group').fadeIn();
        $('#tip').addClass('show');
        table.columns.adjust().draw();
        $(document).scrollto('results_table',130);
        $submit.replaceWith('<div class="alert alert-success">All URLs are extracted!!</div>')
		return;
	}
	if(!urls[num]){
		num++;
		process_url(urls,num);
		return;
	}
	var url = urls[num];
	var tr = '<tr id="url_'+num+'"><td>'+url+'</td><td><span class="badge status badge-warning">Processing...</span></td><td class="tag"></td></tr>';
	$('#output_info').append(tr);
	var $url = $('#url_'+num);
	$.ajax({
		url:'<?=base_url('api/htmltagextract/');?>',
		type:'post',
		dataType:'json',
		data:{
			'url':url,
			'plaintext':plain_text,
			'tag':html_tag
		},
		success:function(response){
			console.log(response);
			$('.status',$url).removeClass('badge-warning');
			if(response.success){
				$('.status',$url).addClass('badge-success').html('Success');
				if(typeof response.success === 'string'){
					$('.tag',$url).html(response.success);
				}else{
					$('.tag',$url).html(response.success.join('<br/>'));
				}
				
			}else{
				$('.status',$url).addClass('badge-danger').html('Failed');
			}
			num++;
			process_url(urls,num);
		},
		error:function(){
			$('.status',$url).removeClass('badge-warning');
			$('.status',$url).addClass('badge-danger').html('Failed');
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
            <script src="https://weforit-tools.github.io/development/js/functions.js"></script>
            <link rel="stylesheet" href="'.(base_url('views/assets/css/dataTables.min.css')).'"/>
            <script src="'.(base_url('views/assets/js/datatables.min.js')).'"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/1.3.8/FileSaver.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/TableExport/5.2.0/js/tableexport.min.js"></script>'
)); ?>