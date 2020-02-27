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
<?php get_template('inc/header_tools'); ?>

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

        <div class="container bg-white py-2 my-3 shadow-sm">
            <h5 class="text-center mb-1">XML Sitemap to URL  Extractor</h5>
            <p class="small text-center">Extract URLs from a Sitemap.xml</p>
            <form class="_rstool">
                <div class="bg-light border pt-3 px-3 pb-1 rounded">
                    <div class="row justify-content-center">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
                            <div class="form-group mb-0">
                                <label>XML Sitemap:</label>
                                <textarea id="input" class="form-control form-control-sm bg-white callout mb-0 callout-primary" placeholder="Load Sitemap XML File or Copy-Paste Sitemap XML Code here..." rows="10"></textarea>
                            </div>
                            &mdash; OR &mdash;
                            <br/>
                            <label type="button" class="btn btn-dark border btn-sm py-1 mb-0" data-toggle="tooltip" title="Load File From Your Device">
                                <span id="filename">Load File</span>
                                <i class="fa fa-plus-circle"></i>
                                <input type="file" id="loadFile" name="loadfile" class="d-none"/>
                            </label>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-4 text-center mt-1 mb-4">
                            <button type="submit" class="btn btn-primary btn-sm py-3 px-4 rounded-0"><i class="fa fa-play mr-2"></i>Extract URLs</button><br/>
                            
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
<div class="container">
    <div class="row align-items-start">
        <div class="col-md-6 col-xl-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6 class="border-bottom pb-2 text-uppercase">About Tool</h6>
                    <p class="text-justify">The Tool can easly extract all urls from a sitemap.xml file. Please provide or enter valid XML format and here you go, you'll get a list of URLs that is exists in Sitemap File</p>
                </div>

            </div>

        </div>
        <div class="col-md-6 col-xl-6 mb-4">
            <div class="accordion accordion-arrow" id="faq">
                <!-- FAQ -->
                <div class="card shadow-sm">
                    <div class="card-header">
                        <button data-target="#about_1" data-toggle="collapse" class="collapsed" aria-expanded="false">
                            What is XML Sitemap to URL Extractor
                        </button>
                    </div>
                    <div id="about_1" class="collapse" data-parent="#faq">
                        <div class="card-body small">
                            
                        </div>
                    </div>
                </div>
                <!-- /FAQ -->     
                <!-- FAQ -->
                <div class="card shadow-sm">
                    <div class="card-header">
                        <button data-target="#about_2" data-toggle="collapse" class="collapsed" aria-expanded="false">
                            What is XML Sitemap to URL Extractor
                        </button>
                    </div>
                    <div id="about_2" class="collapse" data-parent="#faq">
                        <div class="card-body small">
                            The Tool can easly extract all urls from a sitemap.xml file. Please provide or enter valid XML format and here you go, you'll get a list of URLs that is exists in Sitemap File
                        </div>
                    </div>
                </div>
                <!-- /FAQ -->         
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
<?php get_template('inc/footer_tools'); ?>
<?php _foot(array(
	'after_foot'=>'
            <script src="https://weforit-tools.github.io/development/js/global.js"></script>
            <script src="https://weforit-tools.github.io/development/js/functions.js"></script>
            <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"/> -->
            <link rel="stylesheet" href="'.(base_url('views/assets/css/dataTables.min.css')).'"/>
            <script src="'.(base_url('views/assets/js/datatables.min.js')).'"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/1.3.8/FileSaver.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/TableExport/5.2.0/js/tableexport.min.js"></script>'
)); ?>