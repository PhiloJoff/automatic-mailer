var table={container:""};
function tableCsv(csvName){

	table.container = "#table";

	$(table.container).CSVToTable('../data/'+csvName+'.csv',{ 
			loadingImage: '../img/loading.gif',
			tableClass:'table table-striped table-bordered table-condensed', 
			startLine: 1, 
			separator:",",
			headers: ['id', 'Name', 'Firstname', 'mail', 'Date', 'ip origin', 'Picture'] 
			}).bind("loadComplete",function() { 
		$(table.container).find('TABLE').tablesorter();
		$('table').find('tr > td:last-child').each(function(){
			$(this).html('<img class="little_pic" src="photos/'+$(this).html()+'">');
		});
		$('table thead').find('tr').each(function(){
			$(this).find('th:last-child').after('<th class="header" id="action">Action</td>');
		});
		$('table').find('tr').each(function(){
			$(this).find('td:last-child').after('<td id="'+$(this).find('td').eq(0).text()+'"><button class="btn"> <i class="icon-envelope"></i>Envoyer mail à '+$(this).find('td').eq(2).text()+'</button></td>');
		});
		$('table button').each(function(){
			$(this).click(function(){
				var curBtn = $(this);
				$(this).addClass('disabled');
				$(this).attr('disabled','disabled');
				var mail = $(this).parents('tr').children();
				var data = {
				name: $(mail).eq(1).text(),
				fname: $(mail).eq(2).text(),
				email: $(mail).eq(3).text(),
				image: $(mail).eq(6).children('img').attr('src')
				};
				$.ajax({
					type: 'POST',
					url: 'register/unique_mail.php',
					data: data,
					success: function(msg){
						console.log(msg);
						curBtn.removeClass('disabled');
						curBtn.removeAttr('disabled');
					},
					error:function(msg){
						console.log(msg);
						curBtn.addClass('disabled');
						curBtn.removeAttr('disabled');
					}
				});	
			});
		});
	});;
}

function check(status){
	boxes = document.getElementsByName('check');
	for(var i in boxes)
		boxes[i].checked = status;
}
