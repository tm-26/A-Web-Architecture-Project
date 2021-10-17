var book = document.getElementById("booking");
var quest = document.getElementById("query");
var bookbutton = document.getElementById("booking-button");
var questbutton = document.getElementById("query-button");

// executes when the "Booking" button is pressed
function formSwitchToBooking(){
    quest.style.display = "none";
    questbutton.style.backgroundColor = "rgb(223, 190, 147)";
    questbutton.style.color = "black";

    book.style.display = "block";
    bookbutton.style.backgroundColor = "rgb(146, 73, 31)";
    bookbutton.style.color = "white";
}

// executes when the "Query" button is pressed
function formSwitchToQuery(){
    book.style.display = "none";
    bookbutton.style.backgroundColor = "rgb(223, 190, 147)";
    bookbutton.style.color = "black";

    quest.style.display = "block";
    questbutton.style.backgroundColor = "rgb(146, 73, 31)";
    questbutton.style.color = "white";
}

// handles the ranges of dates the user can select for their booking
function dateRange(){
    date = new Date();
    
	day = date.getDate() + 1; // +1 since user can book at minimum a day in advance
	month = date.getMonth() + 1; // +1 since month starts from 0
    year = date.getFullYear();
    
    daysfromnow = date.getDate() + 1;
    monthsfromnow = date.getMonth() + 2;
    // +1 since month starts from 0; and +1 for month and year since user can book a year and a month (and day) in advance
    yearfromnow = date.getFullYear() + 1;

    // if day and month are numbers less than 10, a 0 is added as a prefix to allow them to be placed in "today" and "inadvance"
    // thus allowing the "min" and "max" date to be set

	if (day < 10){
        day = "0" + day;
    }
    if (month < 10){
        month = "0" + month;
    }

    if(daysfromnow < 10){
        daysfromnow = "0" + daysfromnow;
    }
    if(monthsfromnow < 10){
        monthsfromnow = "0" + monthsfromnow;
    }
	

    today = year + "-" + month + "-" + day;
    inadvance = yearfromnow + "-" + monthsfromnow + "-" + daysfromnow;

    document.getElementById("form-date").setAttribute("min", today);
    document.getElementById("form-date").setAttribute("max", inadvance);
}