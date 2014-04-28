$(window).load(function() {

	$.ajax({
		type: 'POST',
		url: './mypage_php/bloom_flower.php',
		dataType: 'json',
		success: function(json){
			//alert(JSON.stringify(json.drop_data) + JSON.stringify(json.flower_flag) + JSON.stringify(json.seed_id[0]) + JSON.stringify(json.flower_status));
			//alert(json.weather);

 			var drop = "<li><img class=\"water\" src=\"./images/drop_";
 			drop += json.drop_data;
  			drop += ".png\"></li>";
			$('#water_list').append(drop);

			var flower_img_f = json.seed_id.pop();
 			var flower_status = JSON.stringify(json.flower_status);
 			var flower_img_s;
 			if (flower_status < 3) {
				flower_img_s = 0;
 			}else if (flower_status < 7) {
				flower_img_s = 1;
 			}else if (flower_status < 11) {
				flower_img_s = 2;
 			}else if (flower_status < 15) {
				flower_img_s = 3;
 			}else {
 				flower_img_s = 0;				
 			}

			var flower = "<img class =\"flower\" src=\"./images/hana_";
			flower += flower_img_f;
			flower += "_";
			flower += flower_img_s;
			flower += ".png\">";
			$('#flower_area').html(flower);

			//json.seed_id.push(1);
			//json.seed_id.push(2);
			//json.seed_id.push(0);
			//json.seed_id.push(3);
			if (json.seed_id.length > 0) {
				blossom(json.seed_id);
			}

			if (json.weather > 0) {
				show_balloon();
			}
		}
	})

	$.ajax({
		type: 'POST',
		url: './mypage_php/search_name.php',
		data: {
			"name_key": ""
		},
		dataType: 'json',
		success: function(json){
			//alert(json);
			var name_line = "";

			for (var i = 0; i < json.length; i++) {
				name_line += "<li class=\"homeru\" onclick=\"homeru(";
				name_line += (JSON.stringify(json[i].staff_id)).replace( /\"/g, "");
				name_line += ", \'";
				name_line += (JSON.stringify(json[i].family)).replace( /\"/g, "");
				name_line += "\')\"><img class=\"homeru_btn1\" src=\"./images/homeru_btn_2.png\"><span class=\"fullname\">";
				name_line += (JSON.stringify(json[i].family)).replace( /\"/g, "");
				name_line += " ";
				name_line += (JSON.stringify(json[i].name)).replace( /\"/g, "");
				name_line += "</span></li>";						
			}

			$('#names').html(name_line);

			/*$('document').on('click', '.homeru',
				function(){
					$(this).jBubbles();
				}
			);*/
		}
	})
})

$(function() {
	$('#shain_list').hover(
		function(){
			$(this).find('span').stop().animate({'marginRight':'200px'},500);
		},
		function(){
			$(this).find('span').stop().animate({'marginRight':'0px'},300);
		}
	);

	$('#name_search').change(
		function(){
			$.ajax({
				type: 'POST',
				url: './mypage_php/search_name.php',
				data: {
					"name_key": $(this).val()
				},
				dataType: 'json',
				success: function(json){
					if(!json) {
						alert("一致する名前がありません。\n苗字のみ、または名前のみを入力してください。");
					}

					var name_line = "";

					for (var i = 0; i < json.length; i++) {
						name_line += "<li class=\"homeru\" onclick=\"homeru(";
						name_line += (JSON.stringify(json[i].staff_id)).replace( /\"/g, "");
						name_line += ", \'";
						name_line += (JSON.stringify(json[i].family)).replace( /\"/g, "");
						name_line += "\')\"><img class=\"homeru_btn1\" src=\"./images/homeru_btn_2.png\"><span class=\"fullname\">";
						name_line += (JSON.stringify(json[i].family)).replace( /\"/g, "");
						name_line += " ";
						name_line += (JSON.stringify(json[i].name)).replace( /\"/g, "");
						name_line += "</span></li>";						
					}

					$('#names').html(name_line);
				}
			})
		}
	);

/*	$('#homeru').click(
		function(){
			$(this).jBubbles();
		}
	);*/

	$('#go_all').hover(
		function(){
			$(this).stop().fadeTo("fast", 0.6);
		},
		function(){
			$(this).stop().fadeTo("fast", 1.0);
		}
	);

	$('#go_all').click(
		function(){
			window.location.href = 'garden.php';
		}
	);

	$('#gray_panel').click(
		function(){
			$('#gray_panel').fadeOut('fast');
			$('#blossom_popup').fadeOut('fast');			
		}
	);

	$('#blossom_popup').corner('20px');
});

function blossom(seed_id) {
	var popup_width = 350 * seed_id.length;
	var popup_top = $('body').height()/2 - $('#blossom_popup').height()/2;
	var popup_left = $('body').width()/2 - popup_width/2;

	$('#gray_panel').fadeIn('fast');
	$('#blossom_popup')
		.css('display', 'inline')
		.css('width', popup_width)
		.css('top', popup_top)
		.css('left', popup_left);

	for (var i = 0; i < seed_id.length; i++) {
		var blossom_flower = "<img class =\"blossom_flower\" src=\"./images/hana_";
		blossom_flower += seed_id[i];
		blossom_flower += "_4.png\">";
		$('#blossom_popup').append(blossom_flower);
	}
}

function homeru(staff_id, staff_family) {
	$.ajax({
		type: 'POST',
		url: './mypage_php/homeru.php',
		data: {
			"staff_id": staff_id
		},
		success: function(result){
			if(result == 0) {
				alert('水がありません。');
			}else {
				alert(staff_family + 'さんをホメました。');
				location.reload();
			}
		}
	})
}

function show_balloon() {
	//alert("balloon");
	for (var i = 1; i < 5; i++) {
		var balloon_top = $('body').height()/3;
		var balloon_left = i * $('body').width()/5;
		var balloon_src = './images/balloon_' + i + '.png';
		var balloon = $('<img>').attr('src', balloon_src)
								.css('position', 'absolute')
								.css('top', balloon_top)
								.css('left', balloon_left)
								.css('width', 80);
		$(document.body).append(balloon);
		$(balloon).jqFloat();
	}
}
