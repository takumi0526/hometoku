$(function() {
	$('#go_home').hover(
		function(){
			$(this).stop().fadeTo("fast", 0.6);
		},
		function(){
			$(this).stop().fadeTo("fast", 1.0);
		}
	);

	$('#go_home').click(
		function(){
			window.location.href = 'index.php';
		}
	);

	$.ajax({
		type: 'POST',
		url: './mypage_php/all_flower.php',
		dataType: 'json',
		success: function(json){
			//alert(json.flower_A_num);
			//json.flower_A_num = 10;

			// flower A
			for (var i = 0; i < json.flower_A_num; i++) {
				var top = Math.random() * $('body').height()/2 - 100 + $('body').height()/2;
				var left = Math.random() * ($('body').width() - 100);
				var img = $('<img>').attr('src','./images/hana_0_4.png');
  				img.attr('class','flower');
  				img.css('top', top);
  				img.css('left', left);
      			$('body').append(img);
      		}

			// flower B
			for (var i = 0; i < json.flower_B_num; i++) {
				var top = Math.random() * $('body').height()/2 - 100 + $('body').height()/2;
				var left = Math.random() * ($('body').width() - 100);
				var img = $('<img>').attr('src','./images/hana_1_4.png');
  				img.attr('class','flower');
  				img.css('top', top);
  				img.css('left', left);
      			$('body').append(img);
      		}

			// flower C
			for (var i = 0; i < json.flower_C_num; i++) {
				var top = Math.random() * $('body').height()/2 - 100 + $('body').height()/2;
				var left = Math.random() * ($('body').width() - 100);
				var img = $('<img>').attr('src','./images/hana_2_4.png');
  				img.attr('class','flower');
  				img.css('top', top);
  				img.css('left', left);
      			$('body').append(img);
      		}

			// flower D
			for (var i = 0; i < json.flower_D_num; i++) {
				var top = Math.random() * $('body').height()/2 - 100 + $('body').height()/2;
				var left = Math.random() * ($('body').width() - 100);
				var img = $('<img>').attr('src','./images/hana_3_4.png');
  				img.attr('class','flower');
  				img.css('top', top);
  				img.css('left', left);
      			$('body').append(img);
      		}

			// flower E
			for (var i = 0; i < json.flower_E_num; i++) {
				var top = Math.random() * $('body').height()/2 - 100 + $('body').height()/2;
				var left = Math.random() * ($('body').width() - 100);
				var img = $('<img>').attr('src','./images/hana_4_4.png');
  				img.attr('class','flower');
  				img.css('top', top);
  				img.css('left', left);
      			$('body').append(img);
      		}
		}
	})
});