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
        	<h5 class="text-uppercase text-center">CK HTML Editor</h5>
            <p class="text-center text-muted">Get Nice & Clean HTML Code, Start Type or Copy-Paste your Code</p>
            <form class="_rstool">
                <div class="rounded">
                    <div class="row justify-content-center">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-7 col-xl-7 mb-3">
                            <div class="form-group mb-0">
                                <div class="card card-primary">
                                    <div class="card-header bg-primary text-white font-weight-bold">HTML Editor</div>
                                    <textarea id="input" name="html-editor" class="card-body form-control form-control-sm bg-white callout mb-0 callout-primary" placeholder="Start typing..." rows="6"></textarea>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-5 col-xl-5">

                            <div class="card card-primary">
                                <div class="card-header bg-primary text-white font-weight-bold">HTML Output</div>
                                <textarea style="height:350px" id="output" class="card-body form-control form-control-sm bg-dark text-white mb-0 " placeholder="Start typing..." rows="6"></textarea>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </form>
        </div>


<script>
    var _case = 'title', pos = 0, str = [];
window.addEventListener('load',function(){
    $('#load_file').click2loadFile('#input');
    CKEDITOR.replace( 'input',{
        format_tags: 'p;h1;h2;h3;h4;h5;h6;pre;address;div',
        height:'245px'
    });
    CKEDITOR.instances['input'].on('change', function() { 
        $('#output').val(CKEDITOR.instances['input'].getData());
    });
    CKEDITOR.instances['input'].on('paste', function() { 
        $('#output').val(CKEDITOR.instances['input'].getData());
    });
});
</script>

<?php _footer(); ?>
<?php _foot(array(
	'after_foot'=>'
            <script src="https://weforit-tools.github.io/development/js/global.js"></script>
            <script src="https://weforit-tools.github.io/development/js/functions.js"></script>
            <script src="https://cdn.weforit.com/tool/ckeditor/4113-standard/ckeditor.js"></script>'
)); ?>