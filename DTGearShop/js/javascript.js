// JavaScript Document
//zoom hình
$('#zoom').elevateZoom({
    zoomType: "inner",
cursor: "crosshair",
zoomWindowFadeIn: 500,
zoomWindowFadeOut: 750
   }); 


//popup
$(function(){
		$("#btnshowpopup").click(function(){
			$("#divpopup").dialog({
				title:"My query Popup",
				width:1000,
				height:1000,
				modal:true,
				buttons:{
					Close:
					function(){
						$(this).dialog('close');
					}
				}
			});
		});	
	})




