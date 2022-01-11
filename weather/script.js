    let weather = {
        apiKey : "7e908c4bf85a0e65a0754838583e01f1",
        fetchWeather : function(city){
            fetch(
                "https://api.openweathermap.org/data/2.5/weather?q=" + city + 
                "&appid=7e908c4bf85a0e65a0754838583e01f1&units=metric"
            ).then((response) => response.json())
            .then((data)=>this.displayWeather(data));
        },
        displayWeather : function(data){
            console.log(data)
            const {name} = data;
            const { description,icon} = data.weather[0];
            const { speed } = data.wind;
            const { temp,humidity } = data.main
            document.querySelector(".location").innerHTML= "Weather in " + name ;
            document.querySelector(".temp").innerHTML= "Temp: " + temp + "°C";
            document.querySelector(".icon").src = "https://openweathermap.org/img/w/" +icon+ ".png";
            document.querySelector(".type").innerHTML = description;
            document.querySelector(".wind").innerHTML = "Wind: " + speed + "km/h";
            document.querySelector(".humidity").innerHTML = "Humidity: " + humidity;
            console.log(icon)
        },
        search : function (){
            this.fetchWeather(document.querySelector(".search-input").value);
        },
    }; 

document.querySelector(".search-bar button").addEventListener("click",function(){
    weather.search();
})
// °C
