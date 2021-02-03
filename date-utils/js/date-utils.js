var dateUtils = dateUtils ?? {};

/**
* Formats a date to look like this: Sunday January 11, 2018
* @method format
*
* @param {Date} date (optional)
* @return {string}
*/
	
dateUtils.format = function(date = new Date()){

    const dayName = this.getDayName(date);
    const monthName = this.getMonthName(date);

    const day = date.getDate();
    const year = date.getFullYear();
    
    return dayName + " " + monthName + " " + day + ", " + year;
    
}

/**
* Returns the day name for a given date.
* @method getDayName
* @param {Date} date
* @return {string}
*/
dateUtils.getDayName = function(date){
    const dayNames = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
    const dayName = dayNames[date.getDay()];
    return dayName;
}

/**
* Returns the month name for a given date.
* @method getMonthName
* @param {Date} date
* @return {string}
*/
dateUtils.getMonthName = function(date){
    const monthNames = ["January","February","March","April","May","June","July","August","September","October","November","December"];
    const monthName = monthNames[date.getMonth()];
    return monthName;
}

/**
* Checks to see if a Date object is more than 18 years prior to the current date
* @method isOldEnoughToVote
*
* @param {Date} birthDate		The date to check. 	
* @return {boolean}			True if the date is more than 18 years ago. False if not.
*/
dateUtils.isOldEnoughToVote = function(birthDate){
    if(typeof birthDate.getMonth !== 'function') throw new Error("Invalid argument, Date object expected");
    const today = new Date();
    const eighteenYearsAgo = new Date((today.getFullYear()-18), today.getMonth(), (today.getDate() +1))
    return Math.sign(eighteenYearsAgo - birthDate) == -1 ? false : true ;
}
