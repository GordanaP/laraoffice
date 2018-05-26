/**
 * Get the event start time.
 *
 * @param  {string} view
 * @param  {string} momentDate
 * @param  {string timeFormat
 * @param  {number} hour
 * @return {string}
 */
function eventStart(view, momentDate, timeFormat, hour=9)
{
    return view.name == "month" ? momentDate.set('hour', hour).format(timeFormat)
                                : momentDate.format(timeFormat)
}

/**
 * Get the event time.
 *
 * @param  {string} momentDate
 * @param  {string} dateFormat
 * @return {string}
 */
function eventDate(momentDate, dateFormat)
{
    return momentDate.format(dateFormat)
}


function isNotPast(momentDate, dateFormat)
{
    var selectedDate = momentDate.format(dateFormat);
    var today = moment().format(dateFormat);

    return selectedDate >= today;
}

/**
 * Get the calendar time interval for the specified profile.
 *
 * @param  {int} profileId
 * @param  {array} profilesInt
 * @param  {int} intervalMins
 * @return {string}
 */
function slotDuration(profileId, profilesInt, intervalMins)
{
    return $.inArray(profileId, profilesInt) !== -1 ? slotDurationFormatted(intervalMins) : slotDurationFormatted()
}

/**
 * Get the fullcalendar time interval formatted.
 *
 * @param  {int} intervalMins
 * @return {string}
 */
function slotDurationFormatted(intervalMins=30)
{
    return '00:'+intervalMins+':00'
}

function timeFormatted(time)
{
    return time+':00'
}