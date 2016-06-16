$(function(){
	
		function error(msg) {
		$("body").append('<div class="d_error" style="display:block;"><div class="d_error2"><p>' + msg + '</p></div>');
		setTimeout(function() {
			$(".d_error").remove();
		}, 1500)
	}
	
	$(".d_man").click(function(){
		$(this).css("background-color","#29abe2");
			$(this).addClass('active')
		$(".d_women").css("background-color","#919191");
			$(".d_women").removeClass('active')
	})
		$(".d_women").click(function(){
			$(this).addClass('active')
		$(this).css("background-color","#fe73a3");
		$(".d_man").css("background-color","#919191");
			$(".d_man").removeClass('active')
	})
		$(".d_next").click(function() {

		var _name = $("#d_name").val();
		var _date = $("#d_date").val();


		if (_name == "") {
			error("请填写昵称");
			return false
		};
		if (_date == "" ) {
			error("请填写生日");
			return false
		};
		if(	!$(".d_nei>span").hasClass('active')){
				error("请填写性别");
			return false
		}
//		location.href = '';
       var _sex=$(".d_nei>span.active").attr("js_sex");
       		$.ajax({
			type: "get",
			url: "",
			data:{
				_name,
				_date,
				__sex,
			},
			success: function(data) {
				if (data.status == 10000) {
					location.href = '';
					//					$(".d_next").attr("js_text",data.data.timestamp);
				} else {
					error(data.message);
				}
			}
		});
	})
	
	
})