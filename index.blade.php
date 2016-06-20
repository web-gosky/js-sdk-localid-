<!doctype html>
<html class="no-js">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="">
		<meta name="keywords" content="">
	<meta name ="viewport" content ="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
		<title>上传</title>
		<!-- Set render engine for 360 browser -->
		<meta name="renderer" content="webkit">
		<!-- No Baidu Siteapp-->
		<meta http-equiv="Cache-Control" content="no-siteapp" />
		<link rel="icon" type="image/png" href="{{ $assets_path }}i/favicon.png">
		<!-- Add to homescreen for Chrome on Android -->
		<meta name="mobile-web-app-capable" content="yes">
		<link rel="icon" sizes="192x192" href="{{ $assets_path }}i/app-icon72x72@2x.png">
		<!-- Add to homescreen for Safari on iOS -->
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta name="apple-mobile-web-app-title" content="Amaze UI" />

    	<meta name="csrf-token" content="{{ csrf_token() }}">
    	<meta name="base-url" content="{{ config('app.url') . '/' . $expert_code }}">
		<link rel="apple-touch-icon-precomposed" href="{{ $assets_path }}i/app-icon72x72@2x.png">
		<!-- Tile icon for Win8 (144x144 + tile color) -->
		<meta name="msapplication-TileImage" content="{{ $assets_path }}i/app-icon72x72@2x.png">
		<meta name="msapplication-TileColor" content="#0e90d2">
		<link rel="stylesheet" href="http://cdn.amazeui.org/amazeui/2.7.0/css/amazeui.min.css">
		<link rel="stylesheet" href="{{ $assets_path }}css/app.css" />
		<style>
			.d_time {
				width: 100%;
				text-align: right;
				height: 20px;
				overflow: hidden;
				background-image: url({{ $assets_path }}images/audio.png);
				background-size: 100% 100%;
				padding-right: 8px;
				margin: 5px 0px;
				color: #fff;
				line-height: 20px;
				font-size: 1.1rem;
			}
				.d_top{
		width: 125px;
		height: 125px;
		display: inline-block;}
				/*background-image: url({{ $assets_path }}images/luyin.png);
				background-size: 100% 100%;
		border-radius: 125px;
		overflow: hidden;
		border: 2px solid #fff;
		z-index: 1000;
	}*/
	.d_ceng{
		width: 150px;
		height: 150px;

		position: absolute;
		top: 185px;
		left: 30%;
		z-index: 1000;
	}
	.d_curren{
    width: 75px;
    margin-top: 20px;
    height: 75px;
}
	a,img {
 	             }
		</style>
	</head>

	<body style="background-color: #FFF;">
		<div class="d_head">
			<p style="	margin-top: 10px;">上传阅读照片或录制音频故事均可参与活动</p>
			<p>每日可传2条内容，分享邀好友助力可获更多阅读力量哦！</p>
		</div>


		<div class="d_container">
			<div class="d_fen">
				<div class="d_audio" id="d_audio">
					<img src="{{ $assets_path }}images/adds.png">
					<p>上传音频</p>
				</div>
			</div>
			<div class="d_fen">
				<div class="d_img" id="d_img">
					<img src="{{ $assets_path }}images/adds.png">
					<p>上传图片</p>
				</div>
			</div>
			<a class="d_sub" id="d_sub" style="color: #fff;" js_voice="" js_img="">上传</a>
			<a class="d_huo" style="color: #f66400;"   href="{{ config('app.url') . '/' . $expert_code }}/document/rewards">如何获得奖励?</a>

		</div>
		<div class="d_xuan">
			<img src="{{ $assets_path }}images/3-media-06.png">
		</div>
		<div class="d_history">
			@if (empty($user_package_records))
			<p style="text: center;">您曾经上传的阅读记录</p>
			@else
			<p>您曾经上传的阅读记录</p>
			@endif
			@if (!empty($user_package_records))
			<ul>
				@foreach ($user_package_records as $upr)
				<li>
					<a href="{{ config('app.url') . '/' . $expert_code }}/share?upr_id={{ $upr['upr_id'] }}%26is_share=0"><img src="{{ $upr['photo_url'] }}" /></a>
					
				</li>
				@endforeach
			</ul>
			@endif
		</div>
			<div class="d_zhe">



		</div>
		<div class="d_tan">

			<img src="{{ $assets_path }}images/guanbi.png" class="d_guanbi"/>
			<img src="{{ $assets_path }}images/xx.png" class="d_changan">
				<p class="d_miao" style="opacity:0 ;"><span>0</span>s</p>

			<div class="d_top" id="moni" >
				<img src="{{ $assets_path }}images/luyin.png">
			</div>

			<p><img src="{{ $assets_path }}images/laji1.png" class="d_laji"></p>
			<div class="d_submit" js_localid="" js_miao="" js_imglocal>确定</div>
		</div>
	</body>
	<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
	    <script type="text/javascript" src="{{ $assets_path }}js/jquery.min.js" ></script>

	       	    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
	   <script>

    wx.config({
        debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
 		appId:'{{ $jssdk_config['appid']}}', // 必填，公众号的唯一标识
			timestamp:'{{ $jssdk_config['timestamp']}}', // 必填，生成签名的时间戳
			nonceStr:'{{ $jssdk_config['noncestr']}}', // 必填，生成签名的随机串
			signature:'{{ $jssdk_config['signature']}}', // 必填，签名，见附录1
        jsApiList: [
            'onMenuShareTimeline',
            'onMenuShareAppMessage',
            'onMenuShareQQ',
            'onMenuShareWeibo',
            'onMenuShareQZone',
            		'startRecord',
					'stopRecord',
					'onRecordEnd',
					'playVoice',
					'stopVoice',
					'uploadVoice',
					'onVoicePlayEnd',
					'downloadVoice',
					'chooseImage',
					'previewImage',
					'uploadImage',
					'downloadImage',
					'getNetworkType',
					'translateVoice',
        ] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
    });

    wx.ready(function() {
    	var Url=$('meta[name="base-url"]').attr('content');
        var title = '为孩子益起读 ，用阅读力量捐建乡村小学图书馆！';
        var desc = '我们爱阅读，还能让更多孩子有书读。益起读吧！';
        var link = Url+'/index';
        var imgUrl = "http://img.vitabee.cn/web/open/static/img/act/share-img.jpg";

        wx.onMenuShareTimeline({
            title: title, // 分享标题
            link: link, // 分享链接
            imgUrl: imgUrl, // 分享图标
            success: function() {

            },
            cancel: function() {

            }
        });

        //分享到朋友
        wx.onMenuShareAppMessage({
            title: title, // 分享标题
            link: link, // 分享链接
            imgUrl: imgUrl, // 分享图标
            desc: desc, // 分享描述
            type: '', // 分享类型,music、video或link，不填默认为link
            dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
            success: function() {

            },
            cancel: function() {
                // 用户取消分享后执行的回调函数

            }
        });

        //分享到QQ
        wx.onMenuShareQQ({
            title: title, // 分享标题
            link: link, // 分享链接
            imgUrl: imgUrl, // 分享图标
            desc: desc, // 分享描述
            success: function() {

            },
            cancel: function() {

            }
        });

        //分享到新浪微博
        wx.onMenuShareWeibo({
            title: title, // 分享标题
            link: link, // 分享链接
            imgUrl: imgUrl, // 分享图标
            desc: desc, // 分享描述
            success: function() {

            },
            cancel: function() {

            }
        });

        //分享到QQ空间
        wx.onMenuShareQZone({
            title: title, // 分享标题
            link: link, // 分享链接
            imgUrl: imgUrl, // 分享图标
            desc: desc, // 分享描述
            success: function() {

            	},
            	cancel: function() {

            	}
            });
            });
            wx.error(function(res) {
            	alert(res);

            });
            var voice = {
            	localId: '',
            	serverId: ''
            };
            var sd;
            var sd1;
            var _stasus = 1;
            var _add = 1;
            var _vae = 1;
            var  curren=1;
            var  add_curren=1;
            function start() {
            	var timer = 0;
            	sd = setInterval(function() {
            		timer++;
            		$(".d_miao span ").html(timer);
            		if (timer == 59) {
            			clearInterval(sd);
            		}
            	}, 1000);
            } //start函数
            function end() {
            	clearInterval(sd);
            }//end函数
            function reset(){        	
//          						$(".d_zhe").hide();
//          						$(".d_tan").hide();
            						$(".d_laji").attr("src", '{{ $assets_path }}images/laji1.png')
            						$(".d_submit").removeClass("d_active1");
            						$(".d_submit").attr("js_localid", "");
            						$(".d_top img").attr("src", '{{ $assets_path }}images/luyin.png');
            						$(".d_miao span ").html("0");
            						$(".d_miao").css("opacity", '0');
            							end();
            }     
            function  startRecord(){
   				wx.startRecord({
            				success: function(res) {
//          					_vae = 2;
            						voice.serverId = res.serverId;
            					$(".d_submit").removeClass("d_active1");
            					$(".d_top img").attr("src", '{{ $assets_path }}images/gif.gif');
            					$(".d_miao").css("opacity", '1');
            					start();
            					$(".d_changan").hide();
            					$(".d_laji").attr("src", '{{ $assets_path }}images/laji.png');
            			
            				},
            				fail: function() {
            					alert("fail");
            				},
            				complete: function() {

            				},
            				cancel: function() {
            					alert('用户拒绝授权录音');
            				}
            			});
            }//play           
            function stopRecord(){
            				wx.stopRecord({
            				success: function(res) {
            						voice.localId = res.localId;
            						$(".d_top img").attr("src", '{{ $assets_path }}images/3-media-03.png');
            						end();
            						$(".d_submit").attr("js_miao", $(".d_miao span ").html());
            						$(".d_submit").addClass("d_active1");
            						$(".d_submit").attr("js_localid", voice.localId);
            					} //success
            			})	
            }//stop                   
           function  upload(){
           	wx.uploadVoice({
            			localId: $(".d_submit").attr("js_localid"),
            			success: function(res) {
            					//							alert('确认语音成功');
            					end();
            					voice.serverId = res.serverId;
            					$(".d_submit").attr("js_localid", voice.localId);
            					$(".d_sub").attr("js_voice", voice.serverId);
            					$(".d_sub ").css("background-color", "#ffc832");
            					$(".d_audio").css("border-color", "#fdec27");
            					$(".d_audio img").attr("src", '{{ $assets_path }}images/3-media-03.png');
            					$(".d_audio p").html("开始播放");
            					//click
            				} //success
            		}); //upload
           }// up
       function  pageSwitchToAdd (){
       			$("#d_audio img").attr("src",'{{ $assets_path }}images/adds.png');
       			$(".d_zhe").show();
            	$(".d_tan").show();
          
       }
       function  pageSwitchToReadyPlay(){
       		wx.stopVoice({
            				success: function(res) {
            					$(".d_audio img").attr("src", '{{ $assets_path }}images/3-media-03.png');
            					$(".d_audio p").html("开始播放");
            				},
            				
            				localId: $(".d_submit").attr("js_localid"),
            			});
            			   add_curren=2;      
       }
       function pageSwitchToPlay(){
      		wx.playVoice  ({
            				success: function(res) {
            					$(".d_audio img").attr("src", '{{ $assets_path }}images/play_new.gif');

            					$(".d_audio p").html("暂停播放");
            							var timer = $(".d_submit").attr("js_miao");
            					sd1 = setInterval(function() {
            						timer--;
            				
            						if (timer <= 0) {
            						 pageSwitchToReadyPlay();
            							clearInterval(sd1);
            						}
            					}, 1000);
            				},
            				complete:function(res){
            					
            				},
            				localId: $(".d_submit").attr("js_localid"),
            			});
            				   add_curren=3;         	
       }
       $(".d_laji").click(function(){
       	 	 if (confirm("您当前正在录音，确定要关闭并删除录音结果吗？")) {
       	 	 	 	 switchToReadyRecord();
       				$(".d_submit").attr("js_localid","");       	 	 	
       	 	 }
       	 	 else{
       	 	 	return false
       	 	 }
      
       })     
       $(".d_guanbi").click(function(){
 
       	 	 if(curren==2||curren==3||curren==4){
       	 	 if (confirm("您当前正在录音，确定要关闭并清除录音结果吗？")) {
            			wx.stopRecord({
            				success: function(res) {
            					      	 	 switchToReadyRecord();
//          						voice.localId = res.localId;
            					
            						$(".d_zhe").hide();
           						 $(".d_tan").hide();
            				
            					} //success
            			})//stopRecord
            		}//if confirm
            				else{
            			return false          			
            			}//else
       	 	 }
       	 	 else{
       	 	$(".d_zhe").hide();
            $(".d_tan").hide();
       	 	 }
       })
       $(".d_submit").click(function(){       	       		
       	 	 if(curren == 2) {
       	 	return false;     
           }     	     	
           	if(curren == 4||curren==3) {
          						 $(".d_zhe").hide();
          						  $(".d_tan").hide();
          						  	 add_curren=2;
          						pageSwitchToReadyPlay();
           		     		wx.stopVoice({
            				success: function(res) {
            				
            					clearInterval(sd1);
            					$(".d_laji").attr("src", '{{ $assets_path }}images/laji.png');
            					$(".d_top img").attr("src", '{{ $assets_path }}images/3-media-03.png');
            				
            				},
            				localId: $(".d_submit").attr("js_localid"),
            			});
           	}
           		upload();
       });   
           function switchToReadyRecord() {          		//reset
    			$(".d_laji").attr("src", '{{ $assets_path }}images/laji1.png')
				$(".d_submit").removeClass("d_active1");
				$(".d_submit").attr("js_localid", "");
				$(".d_top img").attr("src", '{{ $assets_path }}images/luyin.png');
				$(".d_miao span ").html("0");
				$(".d_miao").css("opacity", '0');
				end();
           		curren = 1;
           } 
           function switchToRecording(){
           	//start record
           	startRecord();
           	curren = 2;
           }          
           function switchToStopRecording() {
           	//stop record  	
           	if(curren == 4) {
           		wx.stopVoice({
            				success: function(res) {
            				
            					clearInterval(sd1);
            					$(".d_laji").attr("src", '{{ $assets_path }}images/laji.png');
            					$(".d_top img").attr("src", '{{ $assets_path }}images/3-media-03.png');
            				},
            				localId: $(".d_submit").attr("js_localid"),
            			});
           	}
           	 if(curren == 2) {
           		stopRecord();
           	}
           	curren = 3;
           }          
           function switchToPlaying() {
          	wx.playVoice({
            				success: function(res) {
            					$(".d_laji").attr("src", '{{ $assets_path }}images/laji.png');
            				$(".d_submit").addClass("d_active1");
            			
            					var timer = $(".d_submit").attr("js_miao");
            						$(".d_miao span ").html($(".d_submit").attr("js_miao"));
            					sd1 = setInterval(function() {
            						timer--;
            						$(".d_miao span ").html(timer);
            						if (timer <=0) {
            							switchToStopRecording();
            							clearInterval(sd1);
            						}
            					}, 1000);
            					$(".d_top img").attr("src", '{{ $assets_path }}images/play_new.gif');
            						
            				},
            				localId: $(".d_submit").attr("js_localid"),
            				fail: function(errMsg) {
            					alert(errMsg);
            				},
            				complete: function() {

            				},
            
            			})
           	//play
           	curren = 4;
           }          
		$("#moni").click(function(){
           switch(curren){
           	case 1: switchToRecording(); break;
           	case 2: switchToStopRecording();  break;
           	case 3: switchToPlaying(); break;
           	case 4: switchToStopRecording(); break;
           }
		})         
          $("#d_audio img ").click(function(){
          	
          	 switch(add_curren){
           	case 1: pageSwitchToAdd();break;
           	case 2: pageSwitchToPlay(); break;
           	case 3: pageSwitchToReadyPlay(); break;
     
           }
          });                   
//          $(".d_guanbi").click(function() {
//          if ($(".d_submit").attr("js_localid")=="") {
//          			reset();
//          };
//          	if ($(".d_submit").attr("js_localid")!=="") {
//          		if (confirm("您当前正在录音，确定要关闭并清除录音结果吗？")) {
//          			wx.stopRecord({
//          				success: function(res) {
////          						voice.localId = res.localId;
//          					reset();
//          				
//          					} //success
//          			})//stopRecord
//          		}//if confirm
//          				else{
//          			return false          			
//          			}//else
//          	} //_vae==2
//          })// 关闭点击
//          $(".d_laji").click(function() {
//          	$(".d_submit").attr("js_localid", "");
//          	alert("录制音频已删除，请重新录制");
//
//          })
//          $(".d_submit").click(function() {
//          	var localId = $(".d_submit").attr("js_localid");
//          	if (localId == "") {
//          		//				alert("音频数据为空")
//          	} else {
//          		wx.uploadVoice({
//          			localId: $(".d_submit").attr("js_localid"),
//          			success: function(res) {
//          					//							alert('确认语音成功');
//          					end();
//          					voice.serverId = res.serverId;
//          					$(".d_submit").attr("js_localid", voice.localId);
//          					$(".d_sub").attr("js_voice", voice.serverId);
//          					$(".d_sub ").css("background-color", "#ffc832");
//          					$(".d_audio").css("border-color", "#fdec27");
//          					$(".d_audio img").attr("src", '{{ $assets_path }}images/3-media-03.png');
//          					$(".d_audio p").html("开始播放");
//          					//click
//          				} //success
//          		}); //upload
//          		$(".d_zhe").hide();
//          		$(".d_tan").hide();
//          	}
//          })
//          var a = 1;
//          //			var b=1;
//          $(".d_audio img").click(function() {
//          	var localId = $(".d_submit").attr("js_localid");
//          	if (localId == "") {
//          		$(".d_zhe").show();
//          		$(".d_tan").show();
//       
//          	}
//          	//if
//          	else {
//          		if (status == 1) {
//          			wx.playVoice({
//          				success: function(res) {
//          					$(".d_audio img").attr("src", '{{ $assets_path }}images/3-media-03.png');
//          					$(".d_audio p").html("开始播放");
//          				},
//          				localId: $(".d_submit").attr("js_localid"),
//          			});
//          		}
//          		if (status == 2) {
//          			wx.stopVoice({
//          				success: function(res) {
//          					$(".d_audio img").attr("src", '{{ $assets_path }}images/3-media-03.png');
//
//          					$(".d_audio p").html("暂停播放");
//          				},
//          				localId: $(".d_submit").attr("js_localid"),
//          			});
//          			status = 0;
//          		}
//          		status++;
//          	}
//          });
//          $('#moni').click(function() {
//          				 event.preventDefault();
//          	var localId = $(".d_submit").attr("js_localid");
//          	if (localId == "") {
//          		if (_add == 1) {
//          			wx.startRecord({
//          				success: function(res) {
//          					_vae = 2;
//          						voice.serverId = res.serverId;
//          					$(".d_submit").removeClass("d_active1");
//          					$(".d_top img").attr("src", '{{ $assets_path }}images/gif.gif');
//          					$(".d_miao").css("opacity", '1');
//          					start();
//          					$(".d_changan").hide();
//          					$(".d_laji").attr("src", '{{ $assets_path }}images/laji.png');
//          			
//          				},
//          				fail: function() {
//          					alert("fail");
//          				},
//          				complete: function() {
//
//          				},
//          				cancel: function() {
//          					alert('用户拒绝授权录音');
//          				}
//          			});
//          			_add++;
//          		} //add==1
//          		else {
//          			wx.stopRecord({
//          				success: function(res) {
//          						voice.localId = res.localId;
//          						$(".d_top img").attr("src", '{{ $assets_path }}images/3-media-03.png');
//          						end();
//          						$(".d_submit").attr("js_miao", $(".d_miao span ").html());
//          						$(".d_submit").addClass("d_active1");
//          						$(".d_submit").attr("js_localid", voice.localId);
//          					} //success
//          			})
//          			_add = 1;
//          		} //add==2
//          	}
//          	if (localId !== "") {
//          		if (_add == 1) {
//          			wx.playVoice({
//          				success: function(res) {
//          					$(".d_laji").attr("src", '{{ $assets_path }}images/laji.png')
//          					$(".d_top img").attr("src", '{{ $assets_path }}images/3-media-03.png');
//          					var timer = $(".d_submit").attr("js_miao");
//          					sd1 = setInterval(function() {
//          						timer--;
//          						$(".d_miao span ").html(timer);
//          						if (timer == 0) {
//          							alert("播放完毕");
//          							clearInterval(sd1);
//          						}
//          					}, 1000);
//          					$(".d_top img").attr("src", '{{ $assets_path }}images/3-media-03.png');
//          				},
//          				fail: function(errMsg) {
//          					alert(errMsg);
//          				},
//          				complete: function() {
//
//          				},
//          
//          			});
//          			_add++;
//          		} //add==1
//          		else {
//          			wx.stopVoice({
//
//          				success: function(res) {
//          					clearInterval(sd1);
//          					$(".d_laji").attr("src", '{{ $assets_path }}images/laji.png')
//          					$(".d_top img").attr("src", '{{ $assets_path }}images/3-media-03.png');
//          				},
//          				localId: $(".d_submit").attr("js_localid"),
//          			});
//          			//
//          			add = 1;
//          		} //add==2
//          	}
//          })
            var images = {
            	localId: "",
            	serverId: "",
            };
            document.querySelector('#d_img').onclick = function() {
            	wx.chooseImage({
            		count: 1, // 默认9
            		success: function(res) {

            			images.localId = res.localIds;
            			$(".d_sub ").css("background-color", "#ffc832");
            			$("#d_img img").css("margin-top", "20px");
            			$("#d_img img").css("width", "75px");
            			$("#d_img img").css("height", "75px");
            			$(".d_img img").attr("src", images.localId);
            			$(".d_submit").attr("js_imglocal", images.localId);
            			$(".d_img p").remove();
            			if (images.localId == "") {
            				alert('请先使用 chooseImage 接口选择图片');
            				return;
            			}
            			wx.uploadImage({
            				localId: $(".d_submit").attr("js_imglocal"), // 需要上传的图片的本地ID，由chooseImage接口获得
            				isShowProgressTips: 1, // 默认为1，显示进度提示
            				success: function(res) {
            					var serverId = res.serverId; // 返回图片的服务器端ID
            					$(".d_sub").attr("js_img", res.serverId);
            				},
            				fail: function(res) {
            					alert(JSON.stringify(res));
            				}
            			});
            		}
            	});
            };
            document.querySelector('#d_sub').onclick = function() {
            	if ($(".d_sub").attr("js_voice") != "" || $(".d_sub").attr("js_img") != "") {
            		var _url = $('meta[name="base-url"]').attr('content');
            		$.ajax({
            			type: "get",
            			url: _url + '/media/upload',
            			async: true,
            			data: {
            				sound: {
            					media_id: $(".d_sub").attr("js_voice"),
            				},
            				image: {
            					media_id: $(".d_sub").attr("js_img"),
            				}
            			},
            			success: function(data) {

            				if (data.status == 10000) {
            					location.href = _url + ' /vitabee/share?upr_id=' + data.data.upr_id + '&is_share=1';
            					//					$(".d_next").attr("js_text",data.data.timestamp);
            				} else {
            					alert(data.message);
            				}
            			}
            		});
            	}
            };
	   </script>
</html>
