<?php
error_reporting(E_ALL);
    session_start();
    if (isset($_SESSION['permissionLevel'])) {
        if ($_SESSION['permissionLevel'] !== 'adm') {
            header("location:index.php");
        }
    } else {
        header("location:index.php");
    }
    require_once 'connectdb.php';
    require_once 'scripts/dashboardadminsc.php';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>M&S Engineering Admin</title>
    <link rel="stylesheet" href="css/main.css" />

    <!--Text Editor Script-->
<!--    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>-->
<!--    COMMENTED OUT BY ROBERT - REPLACED WITH THE FOLLOWING 04JAN2018 -->
<!--    <script>tinymce.init({ selector:'textarea' });</script>-->

    <!--                04JAN2018 added by robert for text editing-->
    <!--                https://ckeditor.com/ckeditor-5-builds/download/-->
    <script src="https://cdn.ckeditor.com/ckeditor5/1.0.0-alpha.2/classic/ckeditor.js"></script>

    <!--Script for jquery ui for the dialog box-->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <!--    Modal Scripts-->
    <script type="text/javascript">
        $(function() {
            $( "#dialog-form" ).dialog({
                autoOpen: false,
                height: 300,
                width: 400,
                modal: true
            });

            $("#create").click(function() {
                $("#dialog-form").dialog("open");
            });
        });
    </script>
</head>
<body>
<?php include_once "includes/inc.topbanner.php"; ?>
<div id="wrapper">
    <?php include_once "includes/inc.adminnav.php"; ?>
    <div id="mbodyright1">
        <div id="mbr1content">
            <h2 align="center">M&S Divisions</h2><br/><br/>
            <h3>
                <table align="center"  style="border: none; width: 60%;">
                    <tr>
                        <th>Division</th>
                        <th>Description</th>
                        <th>Division Head</th>
                    </tr>
                    <?php
                        foreach ($divisions AS $row) { ?>
                            <tr>
                                <td align="center"><a href="admindivision.php?divisionId=<?php echo $row['divisionId'] ?>" class="shl"><?php echo $row['divisionName']; ?></a></td>
                                <td align="center"><?php echo $row['description']; ?></td>
                                <?php if (empty($row['firstName'])) { ?>
                                    <td align="center">Brian Meuth</td>
                                <?php } else { ?>
                                <td align="center"><?php echo $row['firstName'] . " " .$row['lastName']; ?></td>
                                <?php } ?>
                            </tr>
                    <?php    }
                    ?>
                </table>
            </h3><br/>
            <button id="create" class="btn3">Add New Division</button>
            <div style="height: 30px;"></div><!--spacer-->
            <form action="" id="anote" name="anote" method="post">
                <h2>Add New Safety Note</h2>
                <input type="text" id="tipTitle" name="tipTitle" class="inputwidth" placeholder="Tip Title" required="required"/><br/><br/>

<!--                04JAN2018 added by robert for text editing-->
<!--                https://ckeditor.com/ckeditor-5-builds/download/-->

                <textarea name="tipContent" id="tipContent">
                        <p>Type your Safety tip here.</p>
                        <p></p>
                </textarea>
                <script>
                    ClassicEditor
                        .create( document.querySelector( '#tipContent' ) )
                        .catch( error => {
                        console.error( error );
                    } );
                </script>

<!--                04JAN2018 added by robert above for text editing-->
<!--                https://ckeditor.com/ckeditor-5-builds/download/-->

<!--                <textarea id="tipContent" name="tipContent" ></textarea><br/><br/>-->

                <input type="submit" id="addnote" name="addnote" class="btn3" value="Add Tip"/><br/><br/>
                <button type="button" onclick="window.location='safetyUploads.php'" class="btn3">Upload Safety Files</button>
            </form>
        </div><!--end mbr1content-->
    </div><!--end mbodyright-->
    <?php include_once "includes/inc.shlinks.php"; ?>
    <div id="dialog-form" title="ADD DIVISION">
        <br/>
        <form action="newdivision.php" id="newdiv" name="newdiv" method="post">
            <input type="text" id="divName" name="divName" class="modInput" required="required" placeholder="Name"/><br/>
            <input type="text" id="description" name="description" class="modInput" required="required"  placeholder="Description"/><br/><br/>
            <input type="submit" id="adddiv" name="adddiv" class="btn" value="Add Division" />
        </form>
    </div><!--end dialog-form-->
</div><!--end wrapper-->
<?php include_once "includes/inc.botbanner.php"; ?>
</body>
</html>
