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

function slotDuration(profileId, profilesInt, intervalMins)
{
    return $.inArray(profileId, profilesInt) !== -1 ? appInterval(intervalMins) : appInterval()
}


function appInterval(intervalMins=30)
{
    return '00:'+intervalMins+':00'
}
