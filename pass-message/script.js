document.querySelector('.btn-submit').addEventListener('click',function(){
    var displayMessage = document.getElementById('message');
    var input = document.getElementById('input-box')
    var inputMessage = input.value
    displayMessage.innerHTML = inputMessage
    input.value = ''    
})