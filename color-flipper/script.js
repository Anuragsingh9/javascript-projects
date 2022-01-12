const targetElement = {
    elementProperty : document.querySelector('.btn-change-color').addEventListener('click',function(){
        const element = document.querySelector('.page')
        const backgroundColor = element.style.backgroundColor
        let colorArr = backgroundColor.slice(
            backgroundColor.indexOf("(") + 1, 
            backgroundColor.indexOf(")")
        ).split(", ");
        var newColorArr = [];
        colorArr.forEach(element => {
        var randomNum = Math.round(Math.random() * 255)+ 1
           var newValue =  Math.round(element % randomNum)
            newColorArr += newValue +','
        });
        var newColorArray = newColorArr.split(',').slice(0,3)
        var newHexCode = rgbToHex(newColorArray[0],newColorArray[1],newColorArray[2])
        console.log(newHexCode)
        element.style.backgroundColor = newHexCode;
        var colorCode = document.querySelector('.color-code')
        colorCode.innerHTML = newHexCode
        colorCode.style.color = newHexCode
    }),
};

function rgbToHex(r, g, b) {
    var a = '';
    var hex = (r.toString(16)) + (g.toString(16)) + (b.toString(16));
    var newHex = hex;
    if(hex.length < 6){
        let count = 6 - hex.length;
        for(var i = 0; i < count; i++){
            a += 1;
        }
        console.log('a =>' + a)
        console.log(hex)
        newHex = hex.concat(a)
    }if(hex.length > 6){
        newHex = hex.slice(0,6)      
    }
    return "#" + newHex;
  }
  