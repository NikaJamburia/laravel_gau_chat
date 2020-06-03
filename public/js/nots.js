function sendHideReq(event){
    event.preventDefault();

    form = "hideForm"+event.target.id;
    document.getElementById(form).submit();
}

window.addEventListener('load',function(){
    try {
        document.getElementById('notsBadge').classList.add('fade');
    } catch (error) {
        return 0;
    }
});