// JavaScript Document
var rowNumber = 0;

function addTableRow(jQtable){
	jQtable.each(function(){
		var tds = '<tr>';
		tds += '<td><select name="cat['+(rowNumber+1)+']">' +
					'<option value="A">Категория A</option>' +
                	'<option value="B">Категория В</option>' +
                    '<option value="C">Категория С</option>' +
                    '<option value="D">Категория D</option>' +
                    '<option value="E">Категория E</option>' +
                   	'</select></td>';
		tds += '<td><input type="text" placeholder="Цена" name="price['+(rowNumber+1)+']" /></td>';
		tds += '</tr>';
		
		if ($('tbody', this).length > 0) {
			$('tbody tr:eq('+(rowNumber+1)+')', this).after(tds);
		}
		else {
			$(this).append(tds);
		}
		
		rowNumber++;
	});
}

d = function (ID) {
	return document.getElementById(ID);
}

generatePassword = function () {
	dict = '0123456789qwertyuiopasdfghjklzxcvbnm';
	len = 10;
	out = '';
	while (len--) {
		r = Math.floor(Math.random()*dict.length);
		out += dict[r];
	}
	if (d('pass').disabled == true) { d('pass').disabled = false }
	d('pass').value = out;
}