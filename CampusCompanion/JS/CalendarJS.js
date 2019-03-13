"use strict";

var thisDay = new Date();

document.getElementById("cal").innerHTML = createCal(thisDay);

function createCal(date){
    var calHTML = "<table id='table'>";
    calHTML += calCap(date);
    calHTML += calWeekRow();
    calHTML += calDays(date);
    calHTML += "</table>";
    return calHTML;
}

function calCap(date){
    var month = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December"
    ];

    var thisMonth = date.getMonth();
    var thisYear = date.getFullYear();

    return "<caption>" + month[thisMonth] + " " + thisYear + "</caption>";
}

function calWeekRow(){
    var day = [
        "Sunday",
        "Monday",
        "Tuesday",
        "Wednesday",
        "Thursday",
        "Friday",
        "Saturday"
    ];
    var row = "<tr>";

    for(var i = 0; i < day.length; i++){
        row += "<th class='week'>" + day[i] + "</th>";
    }

    row += "</tr>";
    return row;
}

function totMonthDays(date){
    var dayCount = [
        31,
        28,
        31,
        30,
        31,
        30,
        31,
        31,
        30,
        31,
        30,
        31
    ];

    var thisYear = date.getFullYear();
    var thisMonth = date.getMonth();

    if(thisYear % 4 === 0){
        if((thisYear % 100 != 0) || (thisYear % 400 === 0)){
            daycount[1] = 29;
        }
    }

    return dayCount[thisMonth];
}

function calDays(date){
    var day = new Date(date.getFullYear(), date.getMonth(), 1);
    var weekDay = day.getDay();

    var htmlCode = "<tr>";
    for(var i = 0; i < weekDay; i++){
        htmlCode += "<td></td>";

    }

    var totDays = totMonthDays(date);

    var highlightDay = date.getDate();

    for(var i = 1; i <= totDays; i++){
        day.setDate(i);
        weekDay = day.getDay();

        if(weekDay === 0) htmlCode += "<tr>";
        if(i === highlightDay){
            htmlCode += "<td class='dates' id='today'>" + i /*+ evenList[i]*/ + "</td>";
        }else{
            htmlCode += "<td class='dates'>" + i /*+ eventList[i]*/ + "</td>";
        }
        if(weekDay === 6) htmlCode += "</tr>";
    }
    return htmlCode;
}