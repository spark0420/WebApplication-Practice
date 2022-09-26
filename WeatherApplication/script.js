// uncommented functions and declarations are for future weather weatherForecast
// I need to pay for the APIs for future forecast
// Therefore, only current weather status is available using API

const timeEl = document.getElementById('time');
const dateEl = document.getElementById('date');
const currentWeatherEl = document.getElementById('current-weather-items');
const timezoneEl = document.getElementById('city');
const countryEl = document.getElementById('contry');
const weatherForecastEl = document.getElementById('weather-forecast');
const currentTempEl = document.getElementById('current-temp');


const days = [`Sunday`, `Monday`, `Tuesday`, `Wednesday`, `Thursday`, `Friday`, `Saturday`];
const months = [`Jan`, `Feb`, `Mar`, `Apr`, `May`, `Jun`, `Jul`, `Aug`, `Sep`, `Oct`, `Nov`, `Dec`];

const API_KEY = '1efb6fe6d6513bac014a3a01f007dd08';

// this func will be called every 1sec
setInterval(() => {
    const time = new Date();
    const month = time.getMonth();
    const date = time.getDate();
    const day = time.getDay();
    const hours = time.getHours();
    const hoursIn12HrFormat = hours >= 13? hours %12 : hours
    const minutes = time.getMinutes();
    const minutesInTwoDigits = minutes < 10? '0'+minutes : minutes
    const ampm = hours >=12 ? 'PM' : 'AM'

    timeEl.innerHTML = (hoursIn12HrFormat < 10? '0'+hoursIn12HrFormat : hoursIn12HrFormat) + ':' + minutesInTwoDigits + ' ' + `<span id="am-pm">${ampm}</span>`

    dateEl.innerHTML = days[day] + ', ' + date + ' ' + months[month]
}, 1000);


getWeatherDate();
function getWeatherDate(){
    navigator.geolocation.getCurrentPosition((succes) => {

        //console.log(succes);
        //let{latitude, longitude} = succes.coords;
        const latitude = succes.coords.latitude;
        const longitude = succes.coords.longitude;

        

        fetch(`https://api.openweathermap.org/data/2.5/weather?lat=${latitude}&lon=${longitude}&units=metric&appid=${API_KEY}`).then(res => res.json()).then(data => {
            console.log(data)

            showWeatherData(data);
        })

        //uncommented APIs are for future weather forecasting.

        // fetch(`https://api.openweathermap.org/data/3.0/onecall?lat=${latitude}&lon=${longtitude}&exclude=hourly, minutely&units=metric&appid=${API_KEY}`).then(res => res.json()).then(data => {
        //     console.log(data)

        //     showWeatherData(data);
        // })


    })
}


function showWeatherData(data){
    let {humidity, pressure, temp_max, temp_min} = data.main;
    let {timezone, country, sunrise, sunset} = data.sys;
    let {speed} = data.wind;
    
    // timezoneEl.innerHTML = data.timezone;
    //countryEl.innerHTML = data.latitude + 'N ' + data.longitude + 'E'


    document.querySelector(".city").innerText = data.name;
    document.querySelector(".country").innerText = country;
    document.querySelector(".Humidity").innerText = humidity + "%";
    document.querySelector(".WindSpeed").innerText = speed + "km/h";
    document.querySelector(".Todaytemp_max").innerText = temp_max + " °C";
    document.querySelector(".Todaytemp_min").innerText = temp_min + " °C";

    
    // currentWeatherEl.innerHTML =
    // `<div class="weather-item">
    //     <div>Humidity</div>
    //     <div>${humidity}%</div>
    // </div>
    // <div class="weather-item">
    //     <div>${pressure}</div>
    //     <div>121</div>
    // </div>
    // <div class="weather-item">
    //     <div>Wind Speed</div>
    //     <div>${speed}</div>
    // </div>
    // <div class="weather-item">
    //     <div>Sunrise</div>
    //     <div>${window.moment(sunrise * 1000).format('HH:mm a')}</div>
    // </div>
    // <div class="weather-item">
    //     <div>Sunset</div>
    //     <div>${window.moment(sunset * 1000).format('HH:mm a')}</div>
    // </div>
    // `;

//     let otherDayForcast = ''
//     data.daily.forEach((day, index) => {
//         if(idx == 0){
//             currentTempEl.innerHTML = `<img src="http://openweathermap.org/img/wn/${day.weather[0].icon}@4x.png"
//             alt="weather-icon" class="w-icon">
//             <div class="others">
//                <div class="day">${window.moment(day.dt * 1000).format('ddd')}</div>
//                <div class="temp">Day ${day.temp.day}&#176;C</div>
//                <div class="temp">Night ${day.temp.night}&#176;C</div>
//             </div>
            
//             `
//         }else{
//             otherDayForcast += `
//             <div class="weather-forecast-item">
//                 <div class="day">${window.moment(day.dt * 1000).format('ddd')}</div>
//                 <img src="http://openweathermap.org/img/wn/${day.weather[0].icon}@2x.png"
//                 alt="weather-icon" class="w-icon">
//                 <div class="temp">Day ${day.temp.day}&#176;C</div>
//                 <div class="temp">Night ${day.temp.night}&#176;C</div>
//             </div>
            
//             `
//         }
//     })

//     weatherForecastEl.innerHTML = otherDayForcast;
}