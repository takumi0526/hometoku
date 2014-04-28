(function($){ 
      $.fn.jBubbles = function(opts) {	

	var defaults = { 
	      image : "./images/star.png",
	      count : 10,
	      bubbleRate : 70,
	      bubbleSpeed : 500,
	      minSize : 20,
	      maxSize : 60,
	      wind : -1000,
	      airPressure : 10,
	      burstOnHover : true
	};
	
	var opts = $.extend(defaults, opts);
	return this.each(function() {	      
	      var bbel = $(this);
	      var bbx = bbel.offset().left;
	      var bby = bbel.offset().top;
	      var alreadyjbubbling = 1;
	      bbel.addClass("bbel");
	      var i = 0;
	      if (alreadyjbubbling == 1) {
		var jbubblest = setInterval(function() {
		      i++;
		      var size = Math.floor(Math.random()*(opts.maxSize + 1))+opts.minSize;
		      $(".jbubbles:animated").animate({
			"left": bbx, 
			"top": bby
		      });
		      $("body").prepend("<img class='jbubbles jb"+i+"' src='"+opts.image+"' />");
		      var b = $(".jbubbles.jb"+i);
		      var startx = Math.floor(Math.random()*(bbel.width()+1)) + bbx - size / 2;
		      var starty = bby - opts.maxSize;
		      var endx = startx + (startx - bbx)*i + opts.wind * i;
		      if (endx > document.body.scrollWidth - size) endx = document.body.scrollWidth - size;
		      var endy = starty + (starty - bby)*i + (opts.airPressure * (opts.count -i) * 2) - 700;
		      if (endy > document.body.scrollHeight - size) endy = document.body.scrollHeight - size;
		      b.css({
			"position" : "absolute",
			"left" : startx,
			"top" : starty,
			"width" : size, 
			"height" : size
		      });
		      b.stop(true, true).animate({
			"width": 80 - i * 2,
			"height": 80 - i * 2,
			"left": endx,
			"top": endy
		      }, i * opts.bubbleSpeed, function() {
			b.remove();
		      });
		      if (i > opts.count){ 
			clearInterval(jbubblest);
			alreadyjbubbling = 0;
		      }
		}, opts.bubbleRate);
	      }
	      if (opts.burstOnHover == true) {
		$(".jbubbles").die().live("mouseover", function() {
		      $(this).remove();		
		});
	      }
	});
      };
})(jQuery);