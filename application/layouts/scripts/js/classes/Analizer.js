/**
* Analizer class
* 
* Version 1.0
* 
* @author sourcio.com 
* 
*/
var Analizer = {
    polygon: function (polygons,green,orange,blue){
		$('.analizeLabel').remove();
        $('.analizePoint').remove();
        for(key in polygons){
            var location = JSON.parse(polygons[key].position);
            if(location.length>1){
                var size=0;
                for(key1 in location){size++;
                    if(key1 == 1){
                        point1 = location[key1];
                    }
                }
                point2 = location[size-1];
                middleLat = (parseFloat(point2.lat)+parseFloat(point1.lat))/2;
                middleLng = (parseFloat(point2.lng)+parseFloat(point1.lng))/2;
                location = {"lat":""+middleLat+"","lng":""+middleLng+""};
            }
            elemPos = Coordinates.latLngToXY(location);
            if(polygons[key].average<green){
                color = "rgb(170, 255, 42)";
            }else if(polygons[key].average<orange){
                color = "orange";
            }else{
                color = "red";
            }
            MapTool.getMapImg().before("<div class='analizeLabel' style='position:absolute;left:"+parseInt((parseInt(elemPos.x-15))/**(MapTool.options.zoomLevel)*/)+"px;top:"+parseInt((parseInt(elemPos.y-13))/**(MapTool.options.zoomLevel)*/)+"px;background:"+color+";color:black;padding:5px;'>"+Game.timeFormatFromSecond(polygons[key].average,'minutes')+"</div>");
        }
    },
	
	waitingTimes: function(polygons,green,orange,blue){
		$('.analizeLabel').remove();
        $('.analizePoint').remove();
        for(key in polygons){
            var location = JSON.parse(polygons[key].position);
            if(location.length>1){
                var size=0;
                for(key1 in location){size++;
                    if(key1 == 1){
                        point1 = location[key1];
                    }
                }
                point2 = location[size-1];
                middleLat = (parseFloat(point2.lat)+parseFloat(point1.lat))/2;
                middleLng = (parseFloat(point2.lng)+parseFloat(point1.lng))/2;
                location = {"lat":""+middleLat+"","lng":""+middleLng+""};
            }
            elemPos = Coordinates.latLngToXY(location);
            if(polygons[key].average<green){
                color = "rgb(170, 255, 42)";
            }else if(polygons[key].average<orange){
                color = "orange";
            }else{
                color = "red";
            }
			
            MapTool.getMapImg().before("<div class='analizeLabel' style='position:absolute;left:"+parseInt(parseInt(elemPos.x-15)/**(MapTool.options.zoomLevel)*/)+"px;top:"+parseInt(parseInt(elemPos.y-13)/**(MapTool.options.zoomLevel)*/)+"px;background:"+color+";color:black;padding:5px;'>"+Game.timeFormatFromSecond(polygons[key].average,'minutes')+"</div>");
        }
	},
    
    waitingPositions: function(positions){
		$('.analizePoint').remove();
        $('.analizeLabel').remove();
        for(key in positions){
            
            elemPos = Coordinates.latLngToXY(positions[key]);
            MapTool.getMapImg().before("<div class='analizePoint' style='position:absolute;left:"+parseInt(parseInt(elemPos.x-15)/**(MapTool.options.zoomLevel)*/)+"px;top:"+parseInt(parseInt(elemPos.y-13)/**(MapTool.options.zoomLevel)*/)+"px;background:black;color:black;height:10px;width:10px;border-radius:10px;cursor:pointer;'></div>");
        }
	}
};
