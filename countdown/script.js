
document.querySelector('.click-btn').addEventListener('click',function(){
var input = document.getElementById('input-value')
var inputSeconds = input.value;
var seconds = inputSeconds ? inputSeconds : 10;
if(seconds > 0){
    setInterval(incrementSeconds, 1000);
}
function incrementSeconds() {
var el = document.querySelector('.otp-desc');
if(seconds > 0){
    document.querySelector('.click-btn').innerHTML = 'Resend'
    seconds -= 1;
    console.log(seconds) 
    el.innerHTML = 'Get OTP again in ' + '(' + seconds + ') seconds' ;
}else{
    el.innerHTML = '';
    return;
    }
    }
});

