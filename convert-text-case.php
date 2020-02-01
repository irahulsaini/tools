<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Convert Text Case</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" id="bootstrap-css"  href="https://www.irahulsaini.com/views/assets/css/bootstrap.css" type="text/css" media="all" />
        <link rel="stylesheet" id="stylesheet-css"  href="https://www.irahulsaini.com/views/assets/css/style.css" type="text/css" media="all" />
        <link rel="stylesheet" id="fontawesome-css"  href="https://irahulsaini.b-cdn.net/css/font-awesome.min.css?ver=5.2.3" type="text/css" media="all" />
        <link rel="stylesheet" href="./css/tools.css" type="text/css" media="all" />

    </head>
    <body class="bg-white">
        <style>

.snackbar{
    z-index:99999;
    position:fixed;
    left:50%;
    margin-left:-150px;
    bottom:0;
    width:100%;
    max-width:300px; 
    max-height:100%;
    background:var(--dark);
    color:var(--white);
    overflow:hidden;
    transition: .3s;
}
.snackbar .content{
    padding:.6rem 1rem; 
}
.snackbar button{
    position:absolute;
    top:0;
    bottom:0;
    right:1rem;
    max-height:100%;
    padding:0;
    min-width:1rem;
    text-align:center;
    font-weight:bold;
    line-height: 100%;
    border:0;
    background:transparent;
    color:var(--white);
}
@media screen and (min-width: 768px){
    .snackbar{
        left:40px;
        bottom:50px;
        margin-left:-20px;
    }
}
</style>
        <div class="container">
            <form class="_rstool">
                <div class="bg-light border pt-3 px-3 pb-1 rounded">
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
                                                Characters: <span class="font-weight-bold lead" id="length">0</span>
                                            </div>
                                            <div class="mr-3">
                                                Words: <span class="font-weight-bold lead" id="words">0</span>
                                            </div>
                                            <div class="mr-3">
                                                Lines: <span class="font-weight-bold lead" id="lines">0</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 text-center text-sm-right">
                                    <button type="button" class="btn btn-primary btn-sm py-0" data-toggle="tooltip" title="Copy Text" id="copy_text"><i class="fa fa-file-text"></i></button>
                                    <button type="button" class="btn btn-primary btn-sm py-0" data-toggle="tooltip" title="Undo Text" id="undo"><i class="fa fa-undo"></i></button>
                                    <button type="button" class="btn btn-primary btn-sm py-0" data-toggle="tooltip" title="Redo Text" id="redo"><i class="fa fa-repeat"></i></button>
                                    <button type="reset" class="btn btn-primary btn-sm py-0" data-toggle="tooltip" title="Reset All Fields"><i class="fa fa-eraser mr-1"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                            <div class="row small">
                                <div class="col-6">
                                    <strong class="d-block mb-2">Case Functions:</strong>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="uppercase" value="Upper" name="textcase" class="custom-control-input">
                                        <label class="custom-control-label" for="uppercase">Upper Case</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="lowercase" value="Lower" name="textcase" class="custom-control-input">
                                        <label class="custom-control-label" for="lowercase">Lower Case</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="titlecase" value="Title" name="textcase" class="custom-control-input" checked>
                                        <label class="custom-control-label" for="titlecase">Title Case</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="capitalizecase" value="Capitalize" name="textcase" class="custom-control-input">
                                        <label class="custom-control-label" for="capitalizecase">Capitalize Case</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="sentencecase" value="Sentence" name="textcase" class="custom-control-input">
                                        <label class="custom-control-label" for="sentencecase">Sentence Case</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="alternativecase" value="Alternative" name="textcase" class="custom-control-input">
                                        <label class="custom-control-label" for="alternativecase">Alternative Case</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <strong class="d-block mb-2">URL Functions:</strong>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="slugify1" value="Slugify 1" name="textcase" class="custom-control-input">
                                        <label class="custom-control-label" for="slugify1">Slugify 1 (-)</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="slugify2" value="Slugify 2" name="textcase" class="custom-control-input">
                                        <label class="custom-control-label" for="slugify2">Slugify 2 (_)</label>
                                    </div>
                                    <strong class="d-block mb-2 mt-3">Other Functions:</strong>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="removeslug" value="Remove Slug" name="textcase" class="custom-control-input">
                                        <label class="custom-control-label" for="removeslug">Remove Slug</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-4 text-center my-1">
                            <div class="custom-control custom-switch">
                              <input type="checkbox" name="trim" class="custom-control-input" id="trim" value="1" checked>
                              <label class="custom-control-label" for="trim">Trim Text</label>
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-play mr-2"></i>Convert Text Case</button><br/>
                            
                        </div>
                    </div>
                    
                </div>
            </form>
        </div>
        <script type="text/javascript" src="https://irahulsaini.b-cdn.net/js/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="https://irahulsaini.b-cdn.net/js/bootstrap.bundle.min.js"></script>
    	<script type="text/javascript" src="https://irahulsaini.b-cdn.net/js/main.js"></script>
    	<script type="text/javascript" src="https://www.irahulsaini.com/views/assets/js/global.js"></script>
        <script src="https://weforit-tools.github.io/development/js/global.js"></script>
        <script src="https://weforit-tools.github.io/development/js/functions.js"></script>
<script>
    var _case = 'title', pos = 0, str = [];
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
        _case = $("input[name='textcase']:checked").val();
        _trim = $("input[name='trim']:checked").val();
        var input = $('#input').val();
        if(!input){
            return;
        }
        if(_trim == 1){
            input = input.trim();
        }
        var output = '';
        if(input != str[pos]){
            str.push(input);
            pos++;
        }
        _case = _case.toLowerCase();
        switch(_case){
            case 'lower':
                output = input.toLowerCase();
            break;
            case 'upper':
                output = input.toUpperCase();
            break;
            case 'title':
                output = input.toTitleCase();
            break;
            case 'capitalize':
                output = input.toCapitalizeCase();
            break;
            case 'sentence':
                output = input.toSentenceCase();
            break;
            case 'alternative':
                output = input.toAlternatingCase();
            break;
            case 'slugify 1':
                output = input.slugify(true);
            break;
            case 'slugify 2':
                output = input.slugify();
            break;
            case 'remove slug':
                output = input.removeSlug();
            break;
        }
        //console.log(output);
        $('#input').val(output).focus();;
    });

    $('#input').on('change keyup paste',function(){
        update_counts();
    });
    function update_counts(){
        var counter = text_counter($('#input').val());
        $('#length').html(counter.chars);
        $('#words').html(counter.words);
        $('#lines').html(counter.lines);        
    }
</script>
    </body>
</html>