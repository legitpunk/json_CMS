<?php


//json file displayer in list format

//require_once('Core/Define.php');

$_SESSION['c_www']										=	'C:/wamp650/www/UniversityApp/_Development/_Builds/00250/_Site/00715/commands/jsons/';

if(isset($_GET['get']))
{
	//echo $_SESSION['c_www'].$_SESSION['site_dir'].'commands/jsons/'.$_GET['get'];

	$json_decodeds	=	json_decode(file_get_contents($_SESSION['c_www'].$_GET['get']));
	/*
	ksort($json_decodeds);
	*/
	
	/*
	echo '<pre>';
	print_r(array($json_decodeds));
	echo '</pre>';
	*/
	
	$array	=	(array)$json_decodeds;
	
	/*
	echo '<pre>';
	print_r($array);
	echo '</pre>';
	*/
	
	ksort($array);
	
	$json_decodedss	=	(object)$array;
	
	/*
	echo '<pre>';
	print_r($array);
	echo '</pre>';
	*/
	
	/*
	stdClass Object
	(
		[0] => Notify
		[1] => database_table_id
		[10] => Notify
		[11] => database_table_id_view
		[110] => Notify
		[111] => parameters
		[1110] => Notify
		[1111] => target
		[11110] => Notify
		[11111] => logged_in
		[111110] => Notify
		[111111] => sql_topbar_permissions
		[1111110] => Notify
		[1111111] => sql_topbar
		[11111110] => Notify
		[11111111] => header_wall
		[111111110] => Notify
		[111111111] => sql_wall_permissions
		[1111111110] => Notify
		[1111111111] => sql_wall
		[11111111110] => Notify
		[11111111111] => build_html_scripts_wall
		[111111111110] => Notify
		[111111111111] => templates_div
		[1111111111110] => Notify
		[1111111111111] => echo_html_scripts
		[11111111111110] => Notify
		[11111111111111] => echo_post_scripts
	)
	*/
}
?>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="<?= $_SESSION['http_site_dir']; ?>"/>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<link rel="stylesheet" href="<?= $_SESSION['http_site_dir']; ?>/css/stylesheet.css"/>

		<script type="text/javascript" src="<?= $_SESSION['http_site_dir']; ?>/js/jquery-3.3.1.js"></script>
		<meta http-equiv="Cache-Control" content="public">
		<link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
	</head>
	<main>
			<header>
				
				<!-- LegitPunk.com logo -->
				<img class="logo" src="<?= $_SESSION['http_site_dir']; ?>/images/<?= $_SESSION['images_logo']; ?>" class=""></img>

		</header>
		<h2>Functions</h2>
		<content>
<?php



if(isset($json_decodedss))
{
	foreach($json_decodedss as $kas	=> $json_decoded)
	{
		/*
		if($json_decoded === 'Notify')
		{
			
		}*/
		/*else
		{*/
			echo '<div id="'.$kas.'" class="list">';
			$arr = str_split($kas);
			$a=0;
			foreach($arr as $item)
			{
				//echo '<p class="indexes">[  '.$item.'  ]</p>';
				//$jkdfasd[$a]		=	'&nbsp;&nbsp;[&nbsp;&nbsp;'.$item.'&nbsp;&nbsp;]&nbsp;&nbsp;';
				$jkdfasd[$a]		=	'['.$item.']';
				$a++;
			}
			$cvb	=	implode("", $jkdfasd);
			echo '<p id="'.$kas.'" class="indexes">'.$cvb.'</p><input value="'.$json_decoded.'"></input><button class="add" onclick="add(&quot;'.$kas.'&quot;);">add</button>';
			echo '</div>';
		/*}*/
	}
}
else
{
	
}	
?>

		</content>

		<article>
			<button class="save button" onclick="save_file();"value="save">save</button>
		</article>
		<article>
<?php
//$_SESSION['site_dir']						//Web2App/_Development/_Builds/00250/_Site/00710/
//$_SESSION['http_domain']			//http://localhost/
//$_SESSION['c_www']						//C:/wamp650/www/

$asdf 											=	scandir($_SESSION['c_www']);

$a=0;
foreach($asdf	as 	$asd)
{
	if($asd	===	'.' OR $asd === '..')
	{
		
	}
	else
	{
		$json_files[$a]	=	$asd;
	}
	$a++;
}

/*
print_r($json_files);

echo '<br>';
echo '<br>';
*/

sort($json_files, SORT_NUMERIC);

/*
print_r($json_files);
*/
echo '<br>';
echo '<br>';


foreach($json_files as $json_file)
{
	echo '<button><a href="index.php?get='.$json_file.'">'.$json_file.'</a></button><br>';
}



?>
			
	</article>
	</main>
	<script>
		function	save_file()
		{
			var ids = [];
			var vals = [];
			var obj = {};
			$("content").find(".indexes").each(function(){ ids.push(this.id); });
			$("content").find("input").each(function(){ vals.push(this.value); });
			
			var str	=	'{';
			for (let r = 0; r < vals.length; r++)
			{
				str +=	'"' + ids[r] + '":';
				str +=	'"' + vals[r] + '",';
			}
			str = str.substring(0, str.length - 1);
			str	+=	'}';
			
			/*console.log(str);*/
			
			var file	=	"<?= $_GET['get']; ?>";
			
			$.ajax
			(
				
				{	
				data: {json : str, json_file : file}, 
					type: 'POST',
					url: '<?= $_SESSION["http_site_dir"]; ?>jsadasd.php',
					success: function(data)
					{
						script = $(data).text();
						$.globalEval(script);
						//alert(data);
					}
				}
			);
		}
		
		function add(index)
		{
			index_original	=	index;
			asdf(index);
		}
		
		function asdf(index)
		{
			if (($("#" + index + "").length > 0))
			{
				//alert(index);
				index = incrementString(index);
				//alert(index);
				asdf(index);
			}
			else
			{
				//var qwerqr	=	index.split('').join('&nbsp;&nbsp;'); // "h e l l o"
				//$(sdasdasdasd).insertAfter("#" + index_original);
				/*if(i == 0)
					{
						test			=	'[&nbsp;&nbsp;' + index;
					}*/
				
				
				var test 			= '';

				for(var i=0; i<index.length; i++)
				{
					
				   test += index.charAt(i) + '&nbsp;&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;&nbsp;';     
				}
				
				test			=	'&nbsp;&nbsp;[&nbsp;&nbsp;' + test;
				
				var str = test.substring(0, test.length - 25);
				
				
				
				$("#" + index_original + "").after('<div id="' + index + '" class="list"><p id="' + index + '" class="indexes">' + str + '</p><input value="new function"></input><button class="add" onclick="add(&quot;' + index + '&quot;);">add</button></div>');		/**/
				//alert(index_original);
			}
		}
		function incrementString(value) 
		{

		  let carry = 1;
		  let res = '';

		  for (let i = value.length - 1; i >= 0; i--) {
			let char = value.toUpperCase().charCodeAt(i);

			char += carry;

			if (char > 90) {
			  char = 65;
			  carry = 1;
			} else {
			  carry = 0;
			}

			res = String.fromCharCode(char) + res;

			if (!carry) {
			  res = value.substring(0, i) + res;
			  break;
			}
		  }

		  if (carry) {
			res = 'A' + res;
		  }

		  return res;
		}
	</script>
</html>


