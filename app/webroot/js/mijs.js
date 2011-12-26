var runningRequest = false;
    var request;
   //Identify the typing action
    $('input#q').keyup(function(e){
        e.preventDefault();
        var $q = $(this);

        if($q.val() == ''){
            $('div#results').html('');
            return false;
        }

        //Abort opened requests to speed it up
        if(runningRequest){
            request.abort();
        }

        runningRequest=true;
        request = $.getJSON('search.php',{
            q:$q.val()
        },function(data){           
            showResults(data,$q.val());
            runningRequest=false;
        });

//Create HTML structure for the results and insert it on the result div
function showResults(data, highlight){
           var resultHtml = '';
            $.each(data, function(i,item){
                resultHtml+='<div class="result">';
                resultHtml+='<h2><a href="#">'+item.title+'</a></h2>';
                resultHtml+='<p>'+item.post.replace(highlight, '<span class="highlight">'+highlight+'</span>')+'</p>';
                resultHtml+='<a href="#" class="readMore">Read more..</a>'
                resultHtml+='</div>';
            });

            $('div#results').html(resultHtml);
        }

        $('form').submit(function(e){
            e.preventDefault();
        });
    });