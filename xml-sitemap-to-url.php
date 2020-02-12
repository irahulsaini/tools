<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
$meta['title']                  = 'XML Sitemap to URL';
$meta['description']            = 'XML Sitemap to URL';
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

<script type="text/javascript">
    var app = {
        'data_table'    : {
                "retrieve"          : true,
                "scrollY"           : '300px',
                "scrollX"           : true,
                "scrollCollapse"    : true,
                "paging"            : false
        },
        'table_export'  : {},
    }
</script>


        <div class="container bg-white py-5 my-3 shadow-sm">
        	
            <form class="_rstool">
                <div class="bg-light border pt-3 px-3 pb-1 rounded">
                	<h6>XML Sitemap to URL</h6>
                    <div class="row justify-content-center">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
                            <div class="form-group mb-0">
                                <textarea id="input" class="form-control form-control-sm bg-white callout mb-0 callout-primary" placeholder="Start typing..." rows="10"></textarea>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    
                                </div>
                                <div class="col-12 col-sm-6 text-center text-sm-right">
                                    <label type="button" class="btn btn-primary btn-sm py-0 mb-0" data-toggle="tooltip" title="Load File From Your Device">
                                        <span id="filename"></span>
                                        <i class="fa fa-plus-circle"></i>
                                        <input type="file" id="loadFile" name="loadfile" class="d-none"/>
                                    </label>
                                    <button type="button" class="btn btn-primary btn-sm py-0" data-toggle="tooltip" title="Copy Text" id="copy_text"><i class="fa fa-file-text"></i></button>
                                    <button type="reset" class="btn btn-primary btn-sm py-0" data-toggle="tooltip" title="Reset All Fields"><i class="fa fa-eraser mr-1"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-4 text-center my-1">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-play mr-2"></i>Convert Text Case</button><br/>
                            
                        </div>
                    </div>
                    
                </div>
            </form>
            <div class="collapse my-4" id="results">
                <div class="table-responsive-r">
                    <table class="display small" id="results_table" width="100%">
                        <thead style="width:100%">
                            <tr>
                                <th width="50">S.No.</th>
                                <th>URL</th>
                            </tr>
                        </thead>
                        <tbody id="urls">

                        </tbody>
                    </table>
                </div>
                <div class="export-btn-group">
                    <button type="button" class="btn btn-primary btn-sm px-3" id="export-csv">Export CSV</button>
                    <button type="button" class="btn btn-primary btn-sm px-3" id="export-txt">Export Text</button>
                </div>
            </div>

        </div>

<div class="modal" id="scanning" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Please Wait</span>
                </div>
                <div class="font-weight-bold text-primary">Extracting...</div>

            </div>
        </div>
    </div>
</div>
<script type='javascript/worker' id='xml-url'>
    self.addEventListener('message',function(e){

        if(e.data.file == true){
                var reader = new FileReader();
                reader.readAsText(e.data.input);
                reader.onload = function(fi){
                    if(!fi.target.result || !(fi.target.result).trim()){
                        return;
                    }
                    extract_url(fi.target.result);
                };
        }else{
            extract_url(e.data.input);
        }

        function extract_url(str){
            loc = str.match(/<\s*loc[^>]*>(.*?)<\s*\/\s*loc>/g);
            urls = [];
            for(i=0;i<loc.length;i++){
                var url = loc[i].replace(/<\/?[^>]+(>|$)/g, "");
                urls.push('<tr><td>'+(i+1)+'</td><td>'+url+'</td></tr>');
                //postMessage(url);
            }
            //postMessage('done');
            postMessage(urls.join(''));
        }
    });

</script>
<script>
window.addEventListener('load',function(){
    var url = [], input = '';
    var config_export = {
        filename:'XML_to_URL'
    }
    $('#export-csv').on('click',function(e){
        e.preventDefault();
        $('.tableexport-caption .button-default.csv').trigger('click');
    });
    $('#export-txt').on('click',function(e){
        e.preventDefault();
        $('.tableexport-caption .button-default.txt').trigger('click');
    });
    $('#loadFile').on('change',function(){
        var file = ($(this)[0].files)[0];
        if(file.type != 'text/xml'){
            this.value = '';
            alert('The File Type is not supported, Please Select a XML File');
            return;
        }
        $('#filename').html(file.name);
    })
	$('#copy_text').click2copy('#input');
    
    $('._rstool').submit(function(e){
        e.preventDefault();

        input = $('#input').val().trim();
        var file = $('#loadFile').prop('files')[0];
        var type;

        if(input){
            type = {
                'file':false,
                'input':input
            }
        }
        if(file && file.name){
            type = {
                'file':true,
                'input':file
            }
        }
        if(!type){
            return;
        }
        $('#scanning').modal('show');
        inlineWorker('#xml-url',function(worker){
            worker.postMessage(type);
            var count = 1;
            worker.onmessage = function(e){
                worker.terminate();
                worker = undefined;
                //console.log(e.data);
                $('#scanning .modal-body').append('<div class="small">Extraction Completed!! Now Formatting Data...</div>');
                setTimeout(function(){
                    $('#urls').html(e.data);
                    $('#scanning .modal-body').append('<div class="small">Preparing Data into Tables... It can take sometime depending on numbers of URLs</div>');
                    setTimeout(function(){
                        $('button[type="submit"]').hide();
                        $('#scanning').modal('hide');
                        var table = $("#results_table").DataTable(app.data_table);
                        $("#results_table").tableExport(config_export);
                        $('.export-btn-group').addClass('show');
                        $('#tip').addClass('show');
                        $("#results").collapse('show');
                        table.columns.adjust().draw();
                        $(document).scrollto('results_table',130);
                    },500)
                },500);
                return;
                //if(e.data == 'done'){

                //}
                //$('#urls').append('<tr><td class="text-center">'+count+'</td><td>'+e.data+'</td></tr>');
                //count++;              
            }
        });

    });

});
</script>
<?php get_template('inc/tools.php');?>
<?php _footer(); ?>
<?php _foot(array(
	'after_foot'=>'
            <script src="https://weforit-tools.github.io/development/js/global.js"></script>
            <script src="https://weforit-tools.github.io/development/js/functions.js"></script>
            <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"/> -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/jquery.dataTables.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/1.3.8/FileSaver.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/TableExport/5.2.0/js/tableexport.min.js"></script>'
)); ?>