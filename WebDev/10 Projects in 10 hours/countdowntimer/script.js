const daysE1 = document.getElementById('days');
const hoursE1 = document.getElementById('hours'); 
const minutesE1 = document.getElementById('minutes'); 
const secondsE1 = document.getElementById('seconds'); 

const newYears = '1 Jan 2023';

function countdown() {
    const newYearsDate = new Date(newYears);
    const currentDate = new Date();

    const totalseconds = (newYearsDate - currentDate)/1000 ;
    const days = Math.floor(totalseconds/3600/24);
    const hours = Math.floor(totalseconds/3600) % 24;
    const minutes = Math.floor(totalseconds/60) % 60;

    const seconds = Math.floor(totalseconds) % 60;

    console.log(seconds,minutes,hours,days);

    daysE1.innerHTML = days;
    hoursE1.innerHTML = formatTime(hours);
    minutesE1.innerHTML = formatTime(minutes);
    secondsE1.innerHTML = formatTime(seconds);

}

function formatTime(time){
    return time < 10 ? (`0${time}` ) : time;
}

// initial call

countdown();


setInterval(countdown,1000);