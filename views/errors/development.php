<html>
<head>
<title> Fatal error </title>
<style type="text/css">

body 
{
    background-color: #fff;
    margin: 40px;
    font-family: Lucida Grande, Verdana, Sans-serif;
    font-size: 12px;
}

#content  
{
    border: 1px solid #e9e9e9;
    background-color: #f9f9f9;
    padding: 17px 20px 20px 20px;
}

h1 
{
    color: #990000;
    font-weight: normal;
    font-size: 18px;
    padding: 0;
    margin: 0 0 4px 0;
}

</style>
</head>
<body>
	<div id="content">
	    <h1> <?= $exception->getMessage(); ?> </h1>
	    [<?= $exception->getLine(); ?>] <?= $exception->getFile(); ?> <br />
	    <? foreach ($exception->getTrace() as $error): ?>
		[<?= $error['line'] ?>] <?= $error['file'] ?> <br />
	    <? endforeach; ?>
	</div>
</body>
</html>
