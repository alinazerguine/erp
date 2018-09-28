<!DOCTYPE html>
<html>
<title>Exact loading</title>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>

</head>
<body>
<div style="width: 30%;margin: 0 auto;">
<h2>Cronjob script is running</h2>
<div class="loader" id="loader"></div>
</div>
</body>
</html>
<script>
/*
function CloseMe() 
{
	alert('s');
    window.close();
}*/
</script>
