<?php
require_once "includes/user_validate.php";		//various functions
require_once "includes/functions.php";			//various functions
require_once "includes/db/db_class.php";		//connect to database
require_once "includes/page_class.php";			//used to make pages


//header html
include_once ("includes/template/header.php");

//define vars
$doc_dir 	= "";
$intProgressID	="";
//get current folder
if(isset($_GET["doc_dir"])){
	$doc_dir = $_GET["doc_dir"];
}

	?>
<SCRIPT Language="JavaScript">

function Right(str, n){
    if (n <= 0)
       return "";
    else if (n > String(str).length)
       return str;
    else {
       var iLen = String(str).length;
       return String(str).substring(iLen, iLen - n);
    }
}
</script>

	<h1>Add Document</h1>
	
	<BR>
	<a href="document_view.php?doc_dir=<?php echo $doc_dir; ?>">Back to <?php echo strtoupper($doc_dir); ?> Documents</a>
	<BR>
	<BR>

<FORM  name="theForm" ENCTYPE="MULTIPART/FORM-DATA" METHOD="POST" action="document_add_verify.php?progressid=<?php echo $intProgressID; ?>&doc_dir=<?php echo $doc_dir; ?>">
Enter Filename:
<INPUT TYPE="FILE" NAME="myFile">
<br>
<INPUT TYPE="submit" NAME="SUB1" VALUE="Upload File">
</FORM>
	
<?php
include_once ("includes/template/footer.php");
?>