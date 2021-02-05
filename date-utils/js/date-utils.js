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
    if(typeof date.getMonth !== 'function') throw new Error("Invalid argument, Date object expected");
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
    if(typeof date.getMonth !== 'function') throw new Error("Invalid argument, Date object expected");
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

/**
* Converts milliseconds to days.
* @method convertMillisecondsToDays
*
* @param {number} ms
* @return {number}
*/
dateUtils.convertMillisecondsToDays = function(ms){
    if(!Number.isFinite(ms)){
     throw new Error("Invalid argument, Number expected");
    }else{ 
        return (ms/1000/60/60/24);
    }
}


/**
* Returns the latter of two Date objects.
* If both Date objects are storing the exact same time, then the first param is returned.
* @method max
*
* @param {Date} date1
* @param {Date} date2
*
* @return {Date}        Returns the latter of the two date params.
*/
dateUtils.max = function(date1, date2){
    if(typeof date1.getMonth !== 'function' || typeof date2.getMonth !== 'function') throw new Error("Invalid argument, Date object expected");
    return date2 < date1 ? date1 : date2;
}

/**
* Compares two dates and determines the time difference (in days) between them.
* @method diff
*
* @param {Date} date1
* @param {Date} date2
* 
* @return {number}          The number of days between the two dates.
*/
dateUtils.diff = function(date1, date2){
    if(typeof date1.getMonth !== 'function' || typeof date2.getMonth !== 'function') throw new Error("Invalid argument, Date object expected");
    const convertedDate1 = this.convertMillisecondsToDays(date1.getTime());
    const convertedDate2 = this.convertMillisecondsToDays(date2.getTime());
    return Math.floor(Math.abs(convertedDate1 - convertedDate2));
}
	