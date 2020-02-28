<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
$meta['title']                  = 'Online Tools &amp; Softwares';
$meta['description']            = 'Online Tools &amp; Softwares';
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
<?=get_template('inc/header_tools.php');?>
<?php get_template('inc/tools.php');?>
<style>
.tool-menu-toggler{
    display:none;
}
</style>

<div class="container my-4">
    <div class="row">
        <!-- Tool -->
        <div class="col-6 col-sm-6 col-md-4 col-lg-3 col-xl-2 d-none">
            <a class="tool-box bg-white shadow-sm pt-3 pb-1" href="<?=base_url('tools/htaccess-file-caching-generator');?>" data-toggle="tooltip" title="Caching Generator">
                <div class="icon">
                    <i class="fa fa-bolt"></i>                              
                </div>
                <div class="text">Caching Generator</div>
            </a>
        </div>
        <!-- /Tool -->
        <!-- Tool -->
        <div class="col-6 col-sm-6 col-md-4 col-lg-3 col-xl-2 d-none">
            <a class="tool-box bg-white shadow-sm pt-3 pb-1" href="<?=base_url('tools/reverse-text');?>" data-toggle="tooltip" title="Reverse Text">
                <div class="icon">
                    <i class="fa fa-refresh"></i>                               
                </div>
                <div class="text">Reverse Text</div>
            </a>
        </div>
        <!-- /Tool -->
        <!-- Tool -->
        <div class="col-6 col-sm-6 col-md-4 col-lg-3 col-xl-2 d-none">
            <a class="tool-box bg-white shadow-sm pt-3 pb-1" href="<?=base_url('tools/split-text');?>" data-toggle="tooltip" title="Split Text">
                <div class="icon">
                    <i class="fa fa-code-fork"></i>                             
                </div>
                <div class="text">Split Text</div>
            </a>
        </div>
        <!-- /Tool -->
        <!-- Tool -->
        <div class="col-6 col-sm-6 col-md-4 col-lg-3 col-xl-2">
            <a class="tool-box bg-white shadow-sm pt-3 pb-1" href="<?=base_url('tools/add-prefix-suffix');?>" data-toggle="tooltip" title="Add Prefix / Suffix">
                <div class="icon">
                    <i class="fa fa-plus-circle"></i>                               
                </div>
                <div class="text">Add Prefix / Suffix</div>
            </a>
        </div>
        <!-- /Tool -->
        <!-- Tool -->
        <div class="col-6 col-sm-6 col-md-4 col-lg-3 col-xl-2 d-none">
            <a class="tool-box bg-white shadow-sm pt-3 pb-1" href="<?=base_url('tools/convert-new-lines-into-spaces');?>" data-toggle="tooltip" title="Convert Line to Space">
                <div class="icon">
                    <i class="fa fa-unsorted"></i>                              
                </div>
                <div class="text">Convert Line to Space</div>
            </a>
        </div>
        <!-- /Tool -->
        <!-- Tool -->
        <div class="col-6 col-sm-6 col-md-4 col-lg-3 col-xl-2 d-none">
            <a class="tool-box bg-white shadow-sm pt-3 pb-1" href="<?=base_url('tools/convert-space-into-new-lines');?>" data-toggle="tooltip" title="Convert Space to Line">
                <div class="icon">
                    <i class="fa fa-bars"></i>                              
                </div>
                <div class="text">Convert Space to Line</div>
            </a>
        </div>
        <!-- /Tool -->
        <!-- Tool -->
        <div class="col-6 col-sm-6 col-md-4 col-lg-3 col-xl-2 d-none">
            <a class="tool-box bg-white shadow-sm pt-3 pb-1" href="<?=base_url('tools/encode-url-decode-url');?>" data-toggle="tooltip" title="Encode/Decode URL">
                <div class="icon">
                    <i class="fa fa-link"></i>                              
                </div>
                <div class="text">Encode/Decode URL</div>
            </a>
        </div>
        <!-- /Tool -->
        <!-- Tool -->
        <div class="col-6 col-sm-6 col-md-4 col-lg-3 col-xl-2">
            <a class="tool-box bg-white shadow-sm pt-3 pb-1" href="<?=base_url('tools/remove-blank-lines');?>" data-toggle="tooltip" title="Remove Blank Lines">
                <div class="icon">
                    <i class="fa fa-eraser"></i>                                
                </div>
                <div class="text">Remove Blank Lines</div>
            </a>
        </div>
        <!-- /Tool -->
        <!-- Tool -->
        <div class="col-6 col-sm-6 col-md-4 col-lg-3 col-xl-2">
            <a class="tool-box bg-white shadow-sm pt-3 pb-1" href="<?=base_url('tools/convert-text-case');?>" data-toggle="tooltip" title="Case Convert">
                <div class="icon">
                    <i class="fa fa-font"></i>                              
                </div>
                <div class="text">Case Convert</div>
            </a>
        </div>
        <!-- /Tool -->
        <!-- Tool -->
        <div class="col-6 col-sm-6 col-md-4 col-lg-3 col-xl-2">
            <a class="tool-box bg-white shadow-sm pt-3 pb-1" href="<?=base_url('tools/ck-html-editor');?>" data-toggle="tooltip" title="HTML Editor">
                <div class="icon">
                    <i class="fa fa-code"></i>                              
                </div>
                <div class="text">HTML Editor</div>
            </a>
        </div>
        <!-- /Tool -->
        <!-- Tool -->
        <div class="col-6 col-sm-6 col-md-4 col-lg-3 col-xl-2">
            <a class="tool-box bg-white shadow-sm pt-3 pb-1" href="<?=base_url('tools/web-scrapper-bot');?>" data-toggle="tooltip" title="Web Scrapper">
                <div class="icon">
                    <i class="fa fa-bullseye"></i>                             
                </div>
                <div class="text">Web Scrapper Bot</div>
            </a>
        </div>
        <!-- /Tool -->
        <!-- Tool -->
        <div class="col-6 col-sm-6 col-md-4 col-lg-3 col-xl-2">
            <a class="tool-box bg-white shadow-sm pt-3 pb-1" href="<?=base_url('tools/html-tag-extractor');?>" data-toggle="tooltip" title="HTML Tag Extractor">
                <div class="icon">
                    <i class="fa fa-share"></i>                             
                </div>
                <div class="text">HTML Tag Extractor</div>
            </a>
        </div>
        <!-- /Tool -->
        <!-- Tool -->
        <div class="col-6 col-sm-6 col-md-4 col-lg-3 col-xl-2">
            <a class="tool-box bg-white shadow-sm pt-3 pb-1" href="<?=base_url('tools/xml-sitemap-to-url');?>" data-toggle="tooltip" title="XML Sitemap to URL">
                <div class="icon">
                    <i class="fa fa-file-code-o"></i>                               
                </div>
                <div class="text">XML Sitemap to URL</div>
            </a>
        </div>
        <!-- /Tool -->
        <!-- Tool -->
        <div class="col-6 col-sm-6 col-md-4 col-lg-3 col-xl-2 d-none">
            <a class="tool-box bg-white shadow-sm pt-3 pb-1" href="<?=base_url('tools/url-to-xml-sitemap-generator');?>" data-toggle="tooltip" title="URL to XML Sitemap">
                <div class="icon">
                    <i class="fa fa-file-text"></i>                             
                </div>
                <div class="text">URL to XML Sitemap</div>
            </a>
        </div>
        <!-- /Tool -->
        <!-- Tool -->
        <div class="col-6 col-sm-6 col-md-4 col-lg-3 col-xl-2 d-none">
            <a class="tool-box bg-white shadow-sm pt-3 pb-1" href="<?=base_url('tools/file-list-generator');?>" data-toggle="tooltip" title="File List Generator">
                <div class="icon">
                    <i class="fa fa-list"></i>                              
                </div>
                <div class="text">File List Generator</div>
            </a>
        </div>
        <!-- /Tool -->
        <!-- Tool -->
        <div class="col-6 col-sm-6 col-md-4 col-lg-3 col-xl-2">
            <a class="tool-box bg-white shadow-sm pt-3 pb-1" href="<?=base_url('tools/faq-page-json-ld-schema-generator');?>" data-toggle="tooltip" title="FAQPage Generator">
                <div class="icon">
                    <i class="fa fa-code"></i>                              
                </div>
                <div class="text">FAQPage Generator</div>
            </a>
        </div>
        <!-- /Tool -->
    </div>
</div>

                <div class="container-fluid my-4">
                    <div class="row">
                    <?php foreach($tools as $tool){ ?>
                        <!-- Tool -->
                        <div class="col-6 col-sm-6 col-md-4 col-lg-3 col-xl-2">
                            <a class="tool-box bg-white shadow-sm pt-3 pb-1" href="<?php echo $tool['link'];?>" data-toggle="tooltip" title="<?php echo $tool['name'];?>">
                                <div class="icon">
                                    <?php echo $tool['icon'];?>
                                </div>
                                <div class="text"><?php echo $tool['name'];?></div>
                            </a>
                        </div>
                        <!-- /Tool -->
                    <?php } ?>
                    </div>
                </div>
<?=get_template('inc/footer_tools.php');?>
<?php _foot(); ?>