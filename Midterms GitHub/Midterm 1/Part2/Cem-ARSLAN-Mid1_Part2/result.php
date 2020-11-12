<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <style>
        table{
            border:solid red 1px;
            width:60%;
            margin:0px auto;
        }
        #tableDiv{
            text-align:center;
        }
        .name{
            font-weight: bold;
        }
        #toast-container{
            position:fixed !important;
            bottom:0px !important;
            top:600px;
            left: 42% !important;
            width:206px;

            
        }
        .toast{
         background: #4da6ff !important;
         color:white !important;
         text-align:center;
         }     
    </style>

</head>
<body>
<div id="tableDiv">
    <table>
        <tr>
            <td class="name">
                Title
            </td>
            <td>
            <?php echo mb_convert_case($p_title,MB_CASE_TITLE)?>
            </td>
        </tr>
        <tr>
            <td class="name">
                URL
            </td>
            <td>
                <?php echo $p_url_address?>
            </td>
        </tr>
        <tr>
            <td class="name">
                Protokol
            </td>
            <td>
               <?php $pairs = explode(":", $p_url_address );
               echo $pairs[0] ?>
            </td>
        </tr>
        <tr>
            <td class="name">
                Domain
            </td>
            <td>
                <?php $pair = explode("//", $p_url_address );
               echo $pair[1] ?>
            </td>
        </tr>
        <tr>
            <td class="name">
                Share
            </td>
            <td>
            <?php isset($p_share) ? print "<i class='small material-icons'>check</i>" : print "<i class='small material-icons'>close</i>"; ?>
            </td>
        </tr>
    </table>
</div>

<script>
    M.toast({html : "New Bookmark Added", classes:'rounded'});    
</script>
  
</body>
</html>