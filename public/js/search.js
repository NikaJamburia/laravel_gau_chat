
window.addEventListener('load',function(){

    document.getElementById('searchbtn').addEventListener('click', function(e){
        e.preventDefault();

        if(document.getElementById('searchField').value == ''){
            return 0;
        }
        else{
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '/friends/search/'+document.getElementById('searchField').value, true);

            var metas = document.getElementsByTagName('meta');

            xhr.onload = function(){
                if(this.status == 200){
                    var response = JSON.parse(this.responseText);
                    output = "<h4>Search Results</h4><hr><ul class='list-group'>";
                    for(var user of response){
                        action = "";
                        if(user.status == "AlreadyExists"){
                            action = "Already your friend";
                        }
                        else if(user.status == "requestExists"){
                            action = "Request sent";
                        }
                        else{
                            action += "<button id='"+user.id+"' class='btn btn-sm btn-primary' onclick='sendFriendRequest(event)'>Send Request</button>";
                        }

                        output+="<li class='list-group-item'> <div class='clearfix'>"+
                                "<div class='float-left'>"+user.name+"</div>"+
                                "<div class='float-right'>"+action+"</div>"+
                                "</div></li>";
                    }
                    output+="</ul>";
                    document.getElementById('searchResults').innerHTML = output;
                }
            }
            xhr.send();

        }
    });

});

function sendFriendRequest(event){
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '/friends/requests/send/'+event.target.id, true);

    xhr.onload = function(){
        if(this.status == 200){
            if(this.responseText == "Sent"){
                event.target.style.display = "none";
                event.target.parentElement.innerHTML += "Request sent";
            }
            else{
                event.target.style.display = "none";
                event.target.parentElement.innerHTML += "Something went wrong";
            }
        }
    }
    xhr.send();
}