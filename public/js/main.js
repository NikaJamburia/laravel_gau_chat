function ajax(type, url, parameters, callback,){
    var xhr = new XMLHttpRequest();
    xhr.open(type, url, true);

    var metas = document.getElementsByTagName('meta');
    for (i=0; i<metas.length; i++) { 
        if (metas[i].getAttribute("name") == "csrf-token") {  
            xhr.setRequestHeader("X-CSRF-Token", metas[i].getAttribute("content"));
        } 
    }
    if(type = 'POST'){
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    }
    var params = parameters;

    xhr.onload = function(){
        if(this.status == 200){
            callback(this.responseText);
        }
    }
    xhr.send(params);
}


window.addEventListener('load',function(){

    document.getElementById('sendMsg').addEventListener('click', function(e){
        e.preventDefault();
        
        if(document.getElementById('body').value == ""){
            return 0;
        }
        else{

            chat_id = document.getElementById('chat_id').value;
            body = document.getElementById('body').value;
            var params = "chat_id="+chat_id+"&body="+body;

            ajax('POST', 'chat/', params, function(response){
                var msg = JSON.parse(response);

                output = "";

                if(msg.sender_id == userid){
                    output += "<div class='mb-3'>"+
                                    "<div class='clearfix '>"+
                                        "<div class='bg-primary p-2 float-right ml-auto text-white msg'>"+
                                            msg.body+
                                        "</div>  "+
                                    "</div>"+
                                    "<div class='clearfix'>"+
                                        "<small class=' float-right ml-2'>"+msg.created_at+"</small>"+
                                    "</div>"+
                                    "</div>";
                }
                else{
                    output += "<div class='mb-3'>"+
                                "<div class='clearfix d-flex items-align-content-center'>"+
                                    "<div class='bg-reply p-2 float-left text-dark msg'>"+
                                        msg.body+
                                    "</div>  "+
                                    
                                "</div>"+
                                "<div class='clearfix'>"+
                                    "<small class=' float-left mr-2'>"+msg.created_at+"</small>"+
                                "</div>"+
                                "</div>";
                }

                if (msg.sender_id == userid && msg.status == 'Seen'){
                    output += "<div class='clearfix'> <small class='float-right'>"+msg.status+" at "+msg.updated_at+" </small> </div>";
                }
                child = document.getElementById('flex'+chat_id).children;
                for(var i in child){
                    console.log(child[i]);
                    if(child[i].tagName == "SMALL"){
                        child[i].innerHTML = body;
                        break;
                    }
                }
                document.getElementById('body').value = "";
                document.getElementById('body').innerHTML = "";

                document.getElementById('msg-box').innerHTML += output;
                document.getElementById('msg-box').scrollTop = document.getElementById('msg-box').scrollHeight;
            });
        }
    });

    
});

function showChat(event){
    chatId = event.currentTarget.id;
    userid = document.getElementById('user_id').value;

    if(event.currentTarget.getAttribute('unseen') == 'yes'){
        try {
            document.getElementById('msgsBadge').classList.add('fade');
        } catch (error) {
            return 0;
        }
    }

    ajax('GET','chat/'+chatId, "", function(response){
        if(response == "No Messages yet"){
            output = response;
        }
        else{
            var msgs = JSON.parse(response);

            output = "";
            for(var i in msgs){
                if(msgs[i].sender_id == userid){
                    output += "<div class='mb-3'>"+
                                 "<div class='clearfix '>"+
                                     "<div class='bg-primary p-2 float-right ml-auto text-white msg'>"+
                                         msgs[i].body+
                                     "</div>  "+
                                 "</div>"+
                                 "<div class='clearfix'>"+
                                     "<small class=' float-right ml-2'>"+msgs[i].created_at+"</small>"+
                                 "</div>"+
                                 "</div>";
                }
                else{
                 output += "<div class='mb-3'>"+
                             "<div class='clearfix d-flex items-align-content-center'>"+
                                 "<div class='bg-reply p-2 float-left text-dark msg'>"+
                                     msgs[i].body+
                                 "</div>  "+
                                 
                             "</div>"+
                             "<div class='clearfix'>"+
                                 "<small class=' float-left mr-2'>"+msgs[i].created_at+"</small>"+
                             "</div>"+
                             "</div>";
                }
            }
            if (msgs[i].sender_id == userid && msgs[i].status == 'Seen'){
                output += "<div class='clearfix'> <small class='float-right'>"+msgs[i].status+" at "+msgs[i].updated_at+" </small> </div>";
            }

        }
             
        document.getElementById('msg-box').innerHTML = output;
        document.getElementById('msg-box').scrollTop = document.getElementById('msg-box').scrollHeight;
        document.getElementById('chat_id').value = chatId;

        document.getElementById('body').removeAttribute('disabled');
        document.getElementById('sendMsg').removeAttribute('disabled');

    });

}



