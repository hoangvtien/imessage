/* *
 * @Project NUKEVIET-MUSIC
 * @Author PHAN TAN DUNG (phantandung92@gmail.com)
 * @Createdate 26 - 12 - 2010 5 : 12
 */

dataemotion = {
	'6' : '>:D<',		'18' : '#:-S',				'36' : '<:-P',		'42' : ':-SS',
	'48' : '<):)',		'50' : '3:-O',				'51' : ':(|)',		'53' : '@};-',
	'55' : '**==',		'56' : '(~~)',				'58' : '*-:)',		'63' : '[-O<',
	'67' : ':)>-',		'77' : '^:)^',				'106' : ':-??',		'25' : 'O:)',
	'26' : ':-B',		'28' : 'I-)',				'29' : '8-|',		'30' : 'L-)',
	'31' : ':-&',		'32' : ':-$',				'33' : '[-(',		'34' : ':O)',
	'35' : '8-}',		'7' : ':-/',				'37' : '(:|',		'38' : '=P~',
	'39' : ':-?',		'40' : '#-O',				'41' : '=D>',		'9' : ':">',
	'43' : '@-)',		'44' : ':^O',				'45' : ':-W',		'46' : ':-<',
	'47' : '>:P',		'11' : ':*',				'49' : ':@)',		'12' : '=((',
	'13' : ':-O',		'52' : '~:>',				'16' : 'B-)',		'54' : '%%-',
	'17' : ':-S',		'5' : ';;)',				'57' : '~O)',		'19' : '>:)',
	'59' : '8-X',		'60' : '=:)',				'61' : '>-)',		'62' : ':-L',
	'20' : ':((',		'64' : '$-)',				'65' : ':-"',		'66' : 'B-(',
	'21' : ':))',		'68' : '[-X',				'69' : '\:D/',		'70' : '>:/',
	'71' : ';))',		'72' : 'O->',				'73' : 'O:',		'74' : 'O-+',
	'75' : '(%)',		'76' : ':-@',				'23' : '/:)',		'78' : ':-J',
	'79' : '(*)',		'100' : ':)]',				'101' : ':-C',		'102' : '~X(',
	'103' : ':-H',		'104' : ':-T',				'105' : '8->',		'24' : '=))',
	'107' : '%-(',		'108' : ':O3',				'1' : ':)',			'2' : ':(',
	'3' : ';)',			'22' : ':|',				'14' : 'X(',		'15' : ':>',
	'8' : ':X',			'4' : ':D',					'27' : '=;',		'10' : ':P',
};

function replacechars(a){
	a = a.replace(/&/i,"&amp;");
	a = a.replace(/</i,"&lt;");
	a = a.replace(/>/i,"&gt;");
	a = a.replace(/"/i,"&quot;");
	a = a.replace(/\\/i,"&#92;");
	a = a.replace(/'/i,"&#39");
	return a;
}

function loademotion(){
	var data = '<ul class="emotions"><li class="emotion" style="float:right"><a onclick="$(this).parent().parent().parent().css(\'display\',\'none\');" class="musicicon mexit" href="javascript:void(0);">&nbsp;</a></li>';
	
	$.each(dataemotion, function(name, title){
		data += '<li><img onclick="$(this).parent().parent().parent().css(\'display\',\'none\');nvm_insert_text($(this).attr(\'title\'),true);" src="' + emotionurl +'emoticons/yahoo/' + name + '.gif" alt="' + replacechars(title) + '" title="' + replacechars(title) + '" width="18" /></li>';
	});
	
	data += '</ul>';	
	return data;
}