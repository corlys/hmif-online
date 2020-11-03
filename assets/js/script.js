$(document).ready(function(){
	$('#hamburger').click(function(){
        $('#navnav').slideToggle();
    });
});

var twitter_config = {
  "id": '640818044713865216',
  "domId": 'twitter-widget',
  "maxTweets": 2,
  "enableLinks": true,
  "showUser": true,
  "showTime": true,
  "showRetweet": false,
  "showInteraction": false,
  "showPermalinks": false,
  "dateFunction": dateFormatter
};
function dateFormatter(date) {
	var monthNames = [
		"January", "February", "March",
		"April", "May", "June", "July",
		"August", "September", "October",
		"November", "December"
	];
	var day = date.getDate();
	var monthIndex = date.getMonth();
	var year = date.getFullYear();
	var hours = date.getHours();
	var minutes = date.getMinutes();
	var ampm = hours >= 12 ? 'pm' : 'am';
	hours = hours % 12;
	hours = hours ? hours : 12; // the hour '0' should be '12'
	minutes = minutes < 10 ? '0'+minutes : minutes;
	var strTime = hours + ':' + minutes + ' ' + ampm;
	
	return 'Posted on ' + day + ' ' + monthNames[monthIndex] + ' ' + year + ' ' + strTime;
}
twitterFetcher.fetch(twitter_config);