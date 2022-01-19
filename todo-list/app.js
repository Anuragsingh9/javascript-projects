function addItem(){
    var ul = document.getElementById('list');
    var li = document.createElement('li');
    var count = ul.childNodes.length
    li.className = 'list-item' + count;
    window.list = li
    var mark = document.createElement('span');
    var input = document.getElementById('input-value');
    var inputValue = input.value;
    if(!inputValue){
        alert('Please enter the title for the todo')
        return;
    }
    // mark.appendChild(document.createTextNode('\u2713'));
    li.append(mark)
    li.appendChild(document.createTextNode(inputValue));
    var close = document.createElement('div');
    window.closeBtn = close.className = 'close';
    close.appendChild(document.createTextNode('\u00D7'));
    li.appendChild(close);
    ul.appendChild(li);
    window.item = ul;
    window.sign = mark;
}

document.getElementById("list").addEventListener("click",function(e) {
    var lis = e.target;
    console.log(lis.classList)
    if(lis.classList.value === 'close'){
        console.log(lis.parentElement)
        lis.parentElement.style.display = 'none';
    }
    lis.classList.toggle("checked");
});
