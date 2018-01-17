$(document).ready(function(){
	$.ajax({
		url: "https://aggiedirectory.000webhostapp.com/data.php",
		type: "GET",
		success: function(data) {
			console.log(data);
			var item = [];
			var vote = [];

			var len = data.length;
			
			for (var i = 0; i < len; i++) {
				item.push(data[i].ITEM_NAME);
				vote.push(data[i].VOTES);
			}

			var ctx = $("#mycanvas");
			
			var chartdata = {
				labels : item,
				datasets : [
					{
					data : vote,
					backgroundColor : [
                    "#8E00C6",
                    "#E8E002",
                    "#DC143C",
                    "#2E8B57"
                    ],
                    borderColor : [
                    "#E8E8E8",
                    "#E8E8E8",
                    "#E8E8E8",
                    "#E8E8E8"
                    ],
		            borderWidth : [1, 1, 1, 1]
			}
		]
	};


			var new_chart = new Chart(ctx, {
				type : "doughnut",
				data : chartdata,
								
			});
			
						
		},
		error: function(data) {
			console.log(data);
		}
	});
});