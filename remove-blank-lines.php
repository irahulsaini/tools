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
<?php /*_header();*/ ?>



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
                                        <i class="fa fa-plus-circle"></i>
                                        <input type="file" id="load_file" name="load_file" class="d-none" accept="text/plain"/>
                                    </label>
                                    <button type="button" class="btn btn-primary btn-sm py-0" data-toggle="tooltip" title="Copy Text" id="copy_text"><i class="fa fa-file-text"></i></button>
                                    <button type="button" class="btn btn-primary btn-sm py-0" data-toggle="tooltip" title="Undo Text" id="undo"><i class="fa fa-undo"></i></button>
                                    <button type="button" class="btn btn-primary btn-sm py-0" data-toggle="tooltip" title="Redo Text" id="redo"><i class="fa fa-repeat"></i></button>
                                    <button type="reset" class="btn btn-primary btn-sm py-0" data-toggle="tooltip" title="Reset All Fields"><i class="fa fa-eraser mr-1"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 small">
                            <strong class="d-block mb-2">Options:</strong>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="trim" checked="true">
                                <label class="custom-control-label" for="trim">Trim Lines (Start &amp; End)</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="trim_before">
                                <label class="custom-control-label" for="trim_before">Trim From Start (Every Line)</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="trim_after">
                                <label class="custom-control-label" for="trim_after">Trim From End (Every Line)</label>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-4 text-center my-1">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-play mr-2"></i>Remove Blank Lines</button><br/>
                            
                        </div>
                    </div>
                    
                </div>
            </form>
        </div>

<script type="javascript/process" id="loadfile">
self.onmessage = function(e){
    var input = e.data;
    console.log(input);
    //postMessage(sitemap.join('\n'));
}
</script>
<script>
    var _case = 'title', pos = 0, str = [];
window.addEventListener('load',function(){
    $('#load_file').click2loadFile('#input');
    /*
    $('#load_file').on('change',function(e){
        var file = this;
        start_process('#loadfile',function(process){
            process.postMessage();
        });
    });
    */
	$('#copy_text').click2copy('#input');
    $('#undo').on('click',function(e){
        if(str.length > 0){
            pos--;
            if(!str[pos]){
                pos++;
                return;
            }
            $('#input').val(str[pos]);
        }

    });
    $('#redo').on('click',function(e){
        e.preventDefault();
        if(str.length > 0){
            pos++;
            if(!str[pos]){
                pos--;
                return;
            }
            $('#input').val(str[pos]);
        }        
    });
    
    $('._rstool').submit(function(e){
        e.preventDefault();
    });
});
</script>
<?php /*_footer();*/ ?>
<?php _foot(array(
	'after_foot'=>'
            <script src="https://weforit-tools.github.io/development/js/global.js"></script>
            <script src="https://weforit-tools.github.io/development/js/functions.js"></script>'
)); ?>