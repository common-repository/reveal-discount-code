jQuery(document).ready(function($) {
		
	$('.rdc_box_button').click(function() {
		var offer_id = $(this).attr("data-id");
		var offer_code = $(this).attr("data-code");
		var offer_url = $(this).attr("href");
		rdc_showcode(offer_id,offer_code,offer_url);
	});

});

function rdc_showcode(element, code, url)
{
	//document.getElementById('rev_' + element).innerHTML = '<span style="color: #000000;">Enter this code at checkout:</span> ' + code;
	document.getElementById('offer_wrap_' + element).innerHTML = '<div class=\'rdc_box_code\'>' + code + '</div>';
	//document.getElementById('offer_wrap_' + element).innerHTML = '<strong>Use the code in the box below...</strong><br /><br /><div class=\'box_code\'>' + code + '</div>';
	//window.open(url, 'gowindow', 'width=700, height=500, directories=yes, location=yes, menubar=yes, resizable=yes, scrollbars=yes, status=yes, toolbar=yes');
	//document.getElementById('onceclicked_' + element).innerHTML = '<div class=\'box\'>The code to use has just been revealed in the box above and the retailers site has just opened in a new tab/window. If this didn\'t happen please <a class=\'s_main_color\' target=\'_blank\' href=\'' + url + '\'><strong>click here</strong></a> to open the site again.</div>';
	//document.getElementById('rev_' + element).onclick = '';
	document.getElementById('offer_wrap_' + element).className = 'rdc_clickarea_clicked';
	//document.getElementById('onceclicked_share_' + element).style.display="block";
}