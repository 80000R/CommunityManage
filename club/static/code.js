	var map = new BMap.Map("map");          
	map.centerAndZoom(new BMap.Point(117.210, 39.143), 11);
	map.enableScrollWheelZoom(true);
	var top_left_control = new BMap.ScaleControl({anchor: BMAP_ANCHOR_TOP_LEFT});
	var top_left_navigation = new BMap.NavigationControl();
	map.addControl(top_left_control);        
	map.addControl(top_left_navigation);     


	var ac = new BMap.Autocomplete(   
		{"input" : "start"
		,"location" : map
	});
	
	ac.addEventListener("onhighlight", function(e) {  
	var str = "";
		var _value = e.fromitem.value;
		var value = "";
		if (e.fromitem.index > -1) {
			value = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
		}    
		str = "FromItem<br />index = " + e.fromitem.index + "<br />value = " + value;
		
		value = "";
		if (e.toitem.index > -1) {
			_value = e.toitem.value;
			value = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
		}    
		str += "<br />ToItem<br />index = " + e.toitem.index + "<br />value = " + value;
	});
	
	
	var myValue;
	ac.addEventListener("onconfirm", function(e) {    
	var _value = e.item.value;
		myValue = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
		
		setPlace();
	});
	
	function setPlace(){
		//map.clearOverlays();    
		function myFun(){
			var pp = local.getResults().getPoi(0).point;   
			$("#start").attr("x",pp.lng);
			$("#start").attr("y",pp.lat);
			console.log($("#start").attr("x"),$("#start").attr("y"));
		}
		var local = new BMap.LocalSearch(map, { 
		  onSearchComplete: myFun
		});
		local.search(myValue);
	}
	
	
	
	var ac2 = new BMap.Autocomplete(   
		{"input" : "end"
		,"location" : map
	});
	
	ac2.addEventListener("onhighlight", function(e) {  
	var str = "";
		var _value = e.fromitem.value;
		var value = "";
		if (e.fromitem.index > -1) {
			value = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
		}    
		str = "FromItem<br />index = " + e.fromitem.index + "<br />value = " + value;
		
		value = "";
		if (e.toitem.index > -1) {
			_value = e.toitem.value;
			value = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
		}    
		str += "<br />ToItem<br />index = " + e.toitem.index + "<br />value = " + value;
	});
	
	
	var myValue2;
	ac2.addEventListener("onconfirm", function(e) {    
	var _value = e.item.value;
		myValue2 = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
		
		setPlace2();
	});
	
	function setPlace2(){
		//map.clearOverlays();    
		function myFun(){
			var pp = local.getResults().getPoi(0).point; 
			$("#end").attr("x",pp.lng);
			$("#end").attr("y",pp.lat);
			console.log($("#end").attr("x"),$("#end").attr("y"));
		}
		var local = new BMap.LocalSearch(map, { 
		  onSearchComplete: myFun
		});
		local.search(myValue2);
	}
	

	$("#do").click(function(){
		var key = $("#key").val();
		if(key == '') {
			layer.msg("请填写资源关键词");
			return;
		}
		var r = $("#r").val();
		if(r == null) r = 2000;
		var color = $("#color").val();
		if(color == null) color = "blue";
		$("#load").css("z-index","100");
		
		var options = {
			onSearchComplete : function(results) {
			console.log(results);
				if (results[0].getNumPois() > 0 || results[1].getNumPois() > 0){
					var circle = new BMap.Circle(results[0].center, r, {
						strokeColor: "gray",
						strokeWeight: 1,
						fillColor: "gray",
						fillOpacity: 0.8
					});
					map.addOverlay(circle);
				}
			},
			pageCapacity : 1
		};
		var local =  new BMap.LocalSearch(map, options);  
		var myKeys = ["学校", "小区"];
							
		
		var ResultArray = [];
		var local1 = new BMap.LocalSearch(
			map,
			{
				renderOptions : {
					map : map,
				},onMarkersSet:function (array) {
				},
				onInfoHtmlSet:function (LocalResultPoi) {
				},
				onResultsHtmlSet:function (element) {
				},
				onSearchComplete : function(results) {
					var totalPages = results.getNumPages();
					var currPage = results.getPageIndex();
					if (currPage < totalPages - 1 && ResultArray.length < 10) {
						console.log(results.getCurrentNumPois());
						ResultArray.push(local1.getResults());
						local1.gotoPage(currPage + 1);
					} else {
						ResultArray.push(local1.getResults());
						console.log(ResultArray);
						map.clearOverlays();
						if(ResultArray.length == 0){
							layer.msg("未找到相关结果！");
						}
						for (var temp of ResultArray){
							//console.log(temp);
							
							for(var store of temp.Ar){
								var marker = new BMap.Marker(store.point,{"title":store.title});
								marker.setTop(true);
								map.addOverlay(marker);
								var content = "<a href='"+store.detailUrl+"'>详情</a><br>地址："+store.address;
								var opts = {
									width : 250,     
									height: 80,     
									title : store.title, 
									enableMessage:true
								   };
								addClickHandler(content,marker,opts);
								
								var circle = new BMap.Circle(store.point, r, {
									strokeColor: color,
									strokeWeight: 1,
									fillColor: color,
									fillOpacity: 0.6
								});
								map.addOverlay(circle);
								
								if(key == '工厂') local.searchNearby(myKeys,store.point,r);
							}
							
						}
						$("#load").css("z-index","-2");
						map.centerAndZoom(new BMap.Point(117.210, 39.143), 11);
					}
				},
				pageCapacity : 20
			});
		local1.search(key);
	});


	$("#go").click(function(){
		var start = $("#start").val();
		var end = $("#end").val();
		if(start == "") {
			layer.msg("请输入起点！");
			return;
		}
		if(end == "") {
			layer.msg("请输入终点！");
			return;
		}
		
		$("#load").css("z-index","100");
		
		var x1 = $("#start").attr("x");
		var y1 = $("#start").attr("y");
		var x2 = $("#end").attr("x");
		var y2 = $("#end").attr("y");
		var p1 = new BMap.Point(x1,y1);
		var p2 = new BMap.Point(x2,y2);
		
		//var driving = new BMap.DrivingRoute(map, {renderOptions:{map: map, autoViewport: true}});
		//console.log(p1,p2);
		//driving.search(p1,p2);
		
		var routePolicy = [BMAP_DRIVING_POLICY_LEAST_TIME,BMAP_DRIVING_POLICY_LEAST_DISTANCE,BMAP_DRIVING_POLICY_AVOID_HIGHWAYS];
		
		map.clearOverlays(); 
		var i=$("#select").val();
		search(p1,p2,routePolicy[i]); 
		function search(start,end,route){ 
			var driving = new BMap.DrivingRoute(map, {renderOptions:{map: map, autoViewport: true},policy: route});
			driving.search(start,end);
		}
		
		$("#load").css("z-index","-2");
	});

	$("#moreBtn").click(function(){
		$("#more").slideToggle();
	});

	function addClickHandler(content,marker,opts){
		marker.addEventListener("click",function(e){
			openInfo(content,e,opts)}
		);
	}
	function openInfo(content,e,opts){
		var p = e.target;
		var point = new BMap.Point(p.getPosition().lng, p.getPosition().lat);
		var infoWindow = new BMap.InfoWindow(content,opts); 
		map.openInfoWindow(infoWindow,point);
	}

/*
//禁用F12
	window.onkeydown = window.onkeyup = window.onkeypress = function (event) {
	    // 判断是否按下F12，F12键码为123
	    if (event.keyCode == 123) {
	        event.preventDefault(); // 阻止默认事件行为
	        window.event.returnValue = false;
	    }
	}
var threshold = 160; // 打开控制台的宽或高阈值
	 // 每秒检查一次
	 setInternet(function() {
	     if (window.outerWidth - window.innerWidth > threshold || 
	     window.outerHeight - window.innerHeight > threshold) {
	         // 如果打开控制台，则刷新页面
	         window.location.reload();
	     }
	 }, 1e3);
*/