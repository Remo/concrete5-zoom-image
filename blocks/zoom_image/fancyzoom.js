jQuery.fn.fancyZoom = function(options) {

options = options || {};
var directory = options && options.directory ? options.directory : 'images';
var zooming = false;

if ($('#zoom').length === 0) {
	var ext = (('browser' in $) && $.browser.msie) ? 'gif' : 'png';
	$('body').append([
		'<div id="zoom" style="display:none; position: relative; z-index: 900;">',
			'<table id="zoom_table" style="border-collapse:collapse; width:100%; height:100%;">',
				'<tbody>',
					'<tr>',
						'<td class="tl" style="background:url(' + directory + '/tl.' + ext + ') 0 0 no-repeat; width:20px; height:20px; overflow:hidden;" />',
						'<td class="tm" style="background:url(' + directory + '/tm.' + ext + ') 0 0 repeat-x; height:20px; overflow:hidden;" />',
						'<td class="tr" style="background:url(' + directory + '/tr.' + ext + ') 100% 0 no-repeat; width:20px; height:20px; overflow:hidden;" />',
					'</tr>',
					'<tr>',
						'<td class="ml" style="background:url(' + directory + '/ml.' + ext + ') 0 0 repeat-y; width:20px; overflow:hidden;" />',
						'<td class="mm" style="background:#fff; vertical-align:top; padding:10px;">',
							'<div id="zoom_content">',
							'</div>',
						'</td>',
						'<td class="mr" style="background:url(' + directory + '/mr.' + ext + ') 100% 0 repeat-y; width:20px; overflow:hidden;" />',
					'</tr>',
					'<tr>',
						'<td class="bl" style="background:url(' + directory + '/bl.' + ext + ') 0 100% no-repeat; width:20px; height:20px; overflow:hidden;" />',
						'<td class="bm" style="background:url(' + directory + '/bm.' + ext + ') 0 100% repeat-x; height:20px; overflow:hidden;" />',
						'<td class="br" style="background:url(' + directory + '/br.' + ext + ') 100% 100% no-repeat; width:20px; height:20px; overflow:hidden;" />',
					'</tr>',
				'</tbody>',
			'</table>',
			'<a href="#" title="Close" id="zoom_close" style="position:absolute; top:0; left:0;">',
				'<img src="' + directory + '/closebox.' + ext + '" alt="Close" style="border:none; margin:0; padding:0;" />',
			'</a>',
		'</div>',
	''].join(''));
	$('html').click(function(e){if($(e.target).parents('#zoom:visible').length === 0) hide();});
	$(document).keyup(function(event){
		if (event.keyCode == 27 && $('#zoom:visible').length > 0) hide();
	});
	$('#zoom_close').click(hide);
}

var zoom_close = $('#zoom_close');
var zoom_content = $('#zoom_content');
var current_zoom = null;

this.each(function() {
	$($(this).attr('href')).hide();
	$(this).click(show);
});

return this;

function show(e) {
	if (zooming) {
		return false;
	}
	current_zoom = $(this);
	zooming = true;
	var content_div = $(current_zoom.attr('href'));
	var window_size = {
		width: window.innerWidth || (window.document.documentElement.clientWidth || window.document.body.clientWidth),
		height: window.innerHeight || (window.document.documentElement.clientHeight || window.document.body.clientHeight),
		x: window.pageXOffset || (window.document.documentElement.scrollLeft || window.document.body.scrollLeft),
		y: window.pageYOffset || (window.document.documentElement.scrollTop || window.document.body.scrollTop)

	};
	var width = (options.width || content_div.width()) + 60;
	var height = (options.height || content_div.height()) + 60;
	if(current_zoom.data('limit-max-zoom') === 'yes') {
		var maxWidth = Math.max(70, Math.min(width, window_size.width - 60));
		var maxHeight = Math.max(70, Math.min(height, window_size.height - 60));
		if((width > maxWidth) || (height > maxHeight)) {
			var ratio = width / height;
			if(ratio > (maxWidth / maxHeight)) {
				width = maxWidth;
				height = Math.ceil(width / ratio);
			}
			else {
				height = maxHeight;
				width = Math.ceil(ratio * maxHeight);
			}
		}
	}
	// ensure that newTop is at least 0 so it doesn't hide close button
	var newTop = Math.max((window_size.height / 2) - (height / 2) + window_size.y, 0);
	var newLeft = (window_size.width / 2) - (width / 2);
	var curTop = e.pageY;
	var curLeft = e.pageX;

	zoom_close.attr('curTop', curTop);
	zoom_close.attr('curLeft', curLeft);
	zoom_close.attr('scaleImg', options.scaleImg ? 'true' : 'false');

	$('#zoom').hide().css({
		position: 'absolute',
		top: curTop + 'px',
		left: curLeft + 'px',
		width: '1px',
		height: '1px'
	});

	zoom_close.hide();

	if (options.closeOnClick) {
		$('#zoom').click(hide);
	}

	if (options.scaleImg) {
		zoom_content.html(content_div.html());
		$('#zoom_content img').css('width', '100%');
	}
	else {
		zoom_content.html('');
	}

	$('#zoom').animate(
		{
			top: newTop + 'px',
			left: newLeft + 'px',
			opacity: "show",
			width: width,
			height: height
		},
		500,
		null,
		function() {
			if (options.scaleImg != true) {
				zoom_content.html(content_div.html());
			}
			zoom_close.show();
			zooming = false;
		}
	);
	if(current_zoom.data('hide-original-on-zoom') === 'yes') {
		current_zoom.data('fancyzoom.initial-visibility', current_zoom.css('visibility'));
		current_zoom.css('visibility', 'hidden');
	}
	return false;
}

function hide() {
	if (zooming) {
		return false;
	}
	zooming = true;
	$('#zoom').unbind('click');
	if (zoom_close.attr('scaleImg') != 'true') {
		zoom_content.html('');
	}
	zoom_close.hide();
	$('#zoom').animate(
		{
			top: zoom_close.attr('curTop') + 'px',
			left: zoom_close.attr('curLeft') + 'px',
			opacity: "hide",
			width: '1px',
			height: '1px'
		},
		500,
		null,
		function() {
			if (zoom_close.attr('scaleImg') == 'true') {
				zoom_content.html('');
			}
			zooming = false;
			if(current_zoom.data('hide-original-on-zoom') === 'yes') {
				current_zoom.css('visibility', current_zoom.data('fancyzoom.initial-visibility'));
				current_zoom.data('fancyzoom.initial-visibility', null);
			}
		}
	);
	return false;
}

function switchBackgroundImagesTo(to) {
	$('#zoom_table td').each(function() {
		var bg = $(this).css('background-image').replace(/\.(png|gif|none)\"\)$/, '.' + to + '")');
		$(this).css('background-image', bg);
	});
	var close_img = zoom_close.children('img');
	var new_img = close_img.attr('src').replace(/\.(png|gif|none)$/, '.' + to);
	close_img.attr('src', new_img);
}

};