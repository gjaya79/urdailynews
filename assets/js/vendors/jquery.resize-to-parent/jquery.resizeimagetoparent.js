/*
 * Plugin Name: Resize Image to Parent Container
 *
 * Author: Christian Varga
 * Author URI: http://christianvarga.com
 * Plugin Source: https://github.com/levymetal/jquery-resize-image-to-parent/
 *
 */

(function($) {
	$.fn.resizeToParent = function(opts) {
	
	if(opts === 'destroy') {
		$(window).off("resize");
		return;
	}
	if(opts === 'reload') {
		positionImage(this);
		return;
	}
	var defaults = {
		parent: 'div'
	}

	var opts = $.extend(defaults, opts);

	function positionImage(obj) {
	  // reset image (in case we're calling this a second time, for example on resize)
	  obj.css({'width': '', 'height': '', 'margin-left': '', 'margin-top': ''});

	  // dimensions of the parent
	  var parentWidth = obj.parents(opts.parent).width();
	  var parentHeight = obj.parents(opts.parent).height();

	  // dimensions of the image
	  var imageWidth = obj.width();
	  var imageHeight = obj.height();

	  // step 1 - calculate the percentage difference between image width and container width
	  var diff = imageWidth / parentWidth;

	  // step 2 - if height divided by difference is smaller than container height, resize by height. otherwise resize by width
	  if ((imageHeight / diff) < parentHeight) {
	   obj.css({'width': 'auto', 'height': parentHeight});

	   // set image variables to new dimensions
	   imageWidth = imageWidth / (imageHeight / parentHeight);
	   imageHeight = parentHeight;
	  }
	  else {
	   obj.css({'height': 'auto', 'width': parentWidth});

	   // set image variables to new dimensions
	   imageWidth = parentWidth;
	   imageHeight = imageHeight / diff;
	  }

	  // step 3 - center image in container
	  var leftOffset = (imageWidth - parentWidth) / -2;
	  var topOffset = (imageHeight - parentHeight) / -2;

	  obj.css({'margin-left': leftOffset, 'margin-top': topOffset});
	}

	return this.each(function() {
	  var obj = $(this);

	  // hack to force ie to run the load function... ridiculous bug 
	  // http://stackoverflow.com/questions/7137737/ie9-problems-with-jquery-load-event-not-firing
	  obj.attr("src", obj.attr("src"));

	  // bind to load of image
	  obj.load(function() {
		positionImage(obj);
	  });

	  // run the position function if the image is cached
	  if (this.complete) {
		positionImage(obj);
	  }
	  
	  $('#categorizr').on('click', '.full-page', function(e) {
		positionImage(obj);
	  });

	  // run the position function on window resize (to make it responsive)
	  $(window).on('resize', function() {
		positionImage(obj);
	  });
	});
  }
})( jQuery );