<?php

	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	
	// połączenie z bazą danych
	include('/home/inf-14/lukamaj/public_html/PAI/database_connect.php');

	/*$path = "/home/inf-14/lukamaj/tmp/";
	session_save_path($path);
	session_start();*/

	if (isset($_GET[logout]))
	{
		/*session_destroy();
		unset($_COOKIE[visited]);
		setcookie('visited', 'visited', time() - 3600, '/');*/

		$now = date("Y-m-d H:i:s");
		mysqli_query($mysqli_connection, "UPDATE USERS_ARCH_LOGS SET SESSION_EXIT_TIME = '$now' WHERE SESSION_IDD = '$_COOKIE[id]';") or die("update log error");
 
		mysqli_query($mysqli_connection, "DELETE FROM SESSION WHERE SESSION_IDD = '$_COOKIE[id]' AND SESSION_WEB = '$_SERVER[HTTP_USER_AGENT]';");	
		
		try
		{
			setcookie('id', '0', time() - 3600, '/');
			unset($_COOKIE[id]);
		}
		catch(Exception $e)
		{
			echo "Exception: " + $e->getMessage();
		}
	}

	/*if ($_SESSION[login] || ($_COOKIE[visited] && $_COOKIE[visited] != ""))
		header('location: http://torus.uck.pk.edu.pl/~lukamaj/PAI/user/panel/'); */

	if ($_COOKIE[id])
		header('location: http://torus.uck.pk.edu.pl/~lukamaj/PAI/user/panel/');
?>

<!DOCTYPE html>
<html>
	<head>
			<title>Tribalwars Stats</title>
			<link rel="Shortcut icon" href="http://torus.uck.pk.edu.pl/~lukamaj/PAI/img/logo.png"/>
			<link rel="stylesheet" href="mobile-style.css"/>
			<link rel="stylesheet" href="style.css"/>
			<link rel="stylesheet" type="text/css" href="buttons.css"/>
			<meta http-equiv="Content-Language" content="pl"/>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
			<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
			<script src="js/jquery-1.7.2.min.js"></script>
			<script type="text/javascript" src="js/jquery.noty.packaged.js"></script>
			<script type="text/javascript">

			    function generate(layout) {
			        var n = noty({
			            text        : '<h4>This site uses cookies</h4>',
			            type        : 'information',
			            layout      : layout,
			            theme       : 'defaultTheme',
			            buttons     : [
			                {addClass: 'btn btn-primary', text: 'I understand', onClick: function ($noty) {
			                    $noty.close();
			                    noty({timeout: 2000, force: true, layout: layout, theme: 'defaultTheme', text: 'Enjoy using our stats!', type: 'success'});

			                    try
			                    {
			                    	document.cookie = "cookie_bar=cookie_bar; expires=18 Dec 2020 12:00:00 UTC ";
			                	}
			                	catch(err)
			                	{
			                		alert(err.message);
			                	}
			                }
			                },
			                {addClass: 'btn btn-danger', text: 'Take me out of here', onClick: function ($noty) {
			                    $noty.close();
			                    noty({timeout: 2000, force: true, layout: layout, theme: 'defaultTheme', text: 'Redirecting...', type: 'error'});
			                	
			                	setTimeout(function()
			                	{ 
							        window.location.replace("http://torus.uck.pk.edu.pl/~lukamaj"); 
							    }, 3000); 
			                }
			                }
			            ]
			        });
			    }

			    function generateAll() 
			    {
			        generate('bottom');
			    }

			    $(document).ready(function () 
			    {
			    	if (document.cookie.indexOf("cookie_bar") < 0)
			        	generateAll();
			    });
			</script>

			<noscript>
				<meta http-equiv="refresh" content="0;url=noscript.html">
			</noscript>
	</head>

	<body>
			<div id="buttons-div">
				<a id="header" href="http://torus.uck.pk.edu.pl/~lukamaj/PAI">TRIBALWARS STATS</a>
				<div id="div_btn_log"><a id="btn_log" href="user/sign_in">Sign in</a>
				<a id="btn_sub" href="user/sign_up">Sign up</a></div>
			</div>

			<h2>Who is gonna win the battle?</h2>
			<h3>Measure players and tribes power and find out!</h3>
	</body>
</html>