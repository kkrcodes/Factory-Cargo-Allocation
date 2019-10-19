<?php
error_reporting(E_ERROR | E_PARSE);
?>

<html>
    
<head>
    
    <!-- Include external stylesheets -->
    <link rel = "stylesheet" href = "bootstrap.min.css">
    <link rel = "stylesheet" href = "jquery-ui.css">
    <link rel = "stylesheet" href = "keyboard.css">
        
    <style>

        body {
            font-family: "Lato", sans-serif;
        }
        
        #partNo {
                width: 45%;   
        }

        #qty {
            width: 10%;   
        }            

        #partScanBox {
            width: 100%;
        }

        /* Style the tab */
        div.tab {
            overflow: hidden;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
        }

        /* Style the buttons inside the tab */
        div.tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
            font-size: 17px;
        }

        /* Change background color of buttons on hover */
        div.tab button:hover {
            background-color: #ddd;
        }

        /* Create an active/current tablink class */
        div.tab button.active {
            background-color: #ccc;
        }

        /* Style the tab content */
        .tabcontent {
            display: none;
            padding: 6px 12px;
            border: 1px solid #ccc;
            border-top: none;
        }

        .topright {
            float: right;
            cursor: pointer;
            font-size: 20px;
        }

        .topright:hover {
            color: red;
        }

        th {
            text-align: left;
            background: #4ad2d4;
            color: #fff;
        }

        table#grn_details {
            width: 100%;
            padding: 0;
            border: 1px solid black;   
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid black;
        }

        unit {
            font-size: 1.2 em;
            font-weight: bold;
            color: #1e2a5a;
        }

        input:invalid {
            border:1px solid red;
        }

        input:valid {
            border:1px solid green;
        }

        h1#tabTitle {
            color: #01579B;
            text-align: center;
        }

        h3#invalidEntry {
            color: red;
            text-align: center;
        }

        #virtualKeyboard {
        display: none;
        top: 0px;
        left: 0px;
        background: #eee;
        padding: 4px;
        width: 50%;
        position: fixed;
        }

        #virtualKeyboard span {
        display: block;
        float: left;
        margin: 0px 2px;
        padding: 0px 6px;
        cursor: pointer;
        background: #fff;
        }

        #virtualKeyboard span:hover {
            background: #ccc;
        }

        textarea {
          width: 50%;
        }

        label#partLabel, label#qtyLabel {
            font-size: 22px !important;
        }

        body { 
            font-size: 14px; 
        }

        h2 { 
            font-size: 20px; 
        }

        form input {
            font-size: 1.2em;
            height: auto;
            padding: 0.5em;
        }

        form label {
            display: block;
            font-size: 14px;
            padding: 10px 0 0 0;
        }

        .fieldset-grouping {
            clear: both;
        }

        .ui-keyboard-nav button {

        }

        /* position keyboard at bottom of the screen - jQuery UI isn't even loaded! */
        .ui-keyboard {
            -moz-box-shadow: 0 -15px 15px #FFFFFF;
            -webkit-box-shadow: 0 -15px 15px #FFFFFF;
            -ms-box-shadow: 0 -15px 15px #FFFFFF;
            -o-box-shadow: 0 -15px 15px #FFFFFF;
            box-shadow: 0 -15px 15px #FFFFFF;
            -moz-border-radius: 0 0 0 0 !important;
            -webkit-border-radius: 0 0 0 0 !important;
            -ms-border-radius: 0 0 0 0 !important;
            -o-border-radius: 0 0 0 0 !important;
            border-radius: 0 0 0 0 !important;
            font-family: 'Helvetica Neue', Helvetica, sans-serif !important;
            left: 0px !important;
            top: auto !important;
            bottom: 0px;
            position: fixed !important;
            width: 100%;
        }

        .ui-keyboard button {
            padding: 0.257em 0.65em 0.397em !important;
            width: auto !important;
        }

        .ui-keyboard button.ui-keyboard-space {
            width: 15em !important;
        }
        
        .ui-widget select, .ui-widget textarea, .ui-widget button {
            font-family: 'Helvetica Neue', Helvetica, sans-serif !important;
            font-size: 0.9em !important;
        }

        .ui-widget input {
            font-family: 'Helvetica Neue', Helvetica, sans-serif !important;
            font-size: 1.75em !important;
            padding: 0.5em !important;
        }

        input.ui-keyboard-input {
            background: #ffffff !important;
        }

        input.current {
            border: 1px solid #1581EF !important;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.3), 0 0 4px rgba(21, 129, 239, 0.5) inset !important;
        }

        .submit-grouping {
            margin-top: 30px;
        }
    </style>
</head>

<body>

    <div class = "tab">
      
        <button id = "defaultOpen" class = "tablinks active" onclick = "displayContent(event, 'searchPartNo')"  >Search</button>
        <button class = "tablinks active" onclick = "displayContent(event, 'scanItem')">WIP Scan</button>
    </div>

    <div id = "searchPartNo" class = "tabcontent">
        
        <h1 id = "tabTitle">FIFO-based Search for Part #</h1><br>    
        <div>
            
            <!-- Form for getting Part NO, required Qty -->
            <form  id = "partSearch" class = "form-inline" method = "POST" action = "#" >
                
                <label for = "partNo:" id = "partLabel" class = ".col-form-label">PART NO:</label>
                <input type = "text" name = "partNo" id = "partNo"  class = "form-control mb-2 mr-sm-2 mb-sm-0 keyboard-alpha" placeholder = "Enter Part Number" onBlur = "setId(this.id)" value = "<?php if(isset($_POST['partNo'])) { echo htmlentities ($_POST['partNo']); }?>" required />
                &nbsp;&nbsp;
                <label for = "qty" id = "qtyLabel" class = ".col-form-label" >QTY: </label>
                <input type = "text" name = "qty" id = "qty" class = "form-control mb-2 mr-sm-2 mb-sm-0 keyboard-num"  pattern = "[0-9]+" placeholder = "Enter Quantity" onBlur = "setId(this.id)" value = "<?php if(isset($_POST['qty'])) { echo htmlentities ($_POST['qty']); }?>" required />
                <input type = "submit" id = "searchBtn" class = "btn btn-primary" value = "Search" />
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
                <input type = "button" id = "deleteButton" class = "btn btn-secondary" value = "Delete" onclick = "onDelete()" />
                &nbsp; &nbsp; &nbsp;&nbsp;
                <input type = "button" id = "resetField" class = "btn btn-secondary" value = "Clear" onclick = "onClear()" />
                &nbsp; &nbsp; &nbsp;&nbsp;
                <a href = "index.php"> <input type = "button" id = "resetForm" class = "btn btn-danger reset" value = "Clear All" /> </a>
            </form> <br>
        </div>

        <?php
            
            // Declare variables
            $partNo = 0;
            $qty = 0;
            $html = '';
            $sum = 0;
            $lastSum = 0;
            $leastAvailableQty = 0;
            $rowId = 0;
            $currentDate = 0;
            $currentRowQty = 0;
            $qtySum = 0;
            $tempSum = 0;
            $tempHtml = '';
            $currentDateCanFulfill = false;
            $tempCount = 0;
            $availableQty = 0;

            if(isset($_POST['partNo']) && isset($_POST['qty'])) { 

                // Declare variables for partNo, qty & MySQL connection
                $partNo=strtoupper($_POST['partNo']);
                $qty = $_POST['qty'];
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "mts1";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Die if connection failed
                if (mysqli_connect_errno()) {
                    echo "<h3 id = 'invalidEntry'>Failed to connect to Database</h3><b>Error details: </b>" . mysqli_connect_error();
                    $flag = false;
                }

                // SQL query to retrieve rows sorted by received date for the given PART NO   
                $sql = "SELECT grn_details.`VENDOR CODE`, grn_details.`VENDOR NAME`, grn_details.`INVOICE NO`, DATE_FORMAT(grn_details.`INVOICE DATE`,'%Y-%m-%d') AS DATE, DATE_FORMAT(grn_details.`RECEIVED DATE`,'%Y-%m-%d') AS `RECEIVED DATE`, SUM(grn_details.`TOTAL QTY`) AS BOX_SUM, grn_subdetails.grn_subdetails_id, grn_subdetails.`BOX NO`, grn_subdetails.`QTY PER BOX` FROM grn_details INNER JOIN grn_subdetails ON grn_details.grn_details_id = grn_subdetails.grn_details_id  WHERE grn_details.`PART NUMBER` = ".$partNo. " GROUP BY grn_subdetails_id ORDER BY grn_details.`RECEIVED DATE` ASC, grn_subdetails.`QTY PER BOX` DESC";
                
                // Execute query in MySQL
                $result = $conn->query($sql);      

                // Continue if rows found
                if ($result->num_rows > 0) {
                    
                    // Count number of rows to display S.NO
                    $count = 0;
                    
                    // Calculate available quantity for part
                    while($row = $result->fetch_assoc()) {
                        
                        $availableQty += $row['QTY PER BOX'];     
                    }
                    
                    // Seek back sql row pointer to 0
                    mysqli_data_seek($result, 0);

                    // Check if requested quantity available for part, continue if available, else display 'Requested quantity not available'
                    if($availableQty >= $qty) {
                        
                        // Execute while there are rows present
                        while($row = $result->fetch_assoc()) {

                            $count++;
                            $lastSum = $sum;
                            
                            // Add quantity of boxes so far 
                            $sum += $row['QTY PER BOX'];
                            
                            $rowId = $row['grn_subdetails_id'];
                            $currentRowQty = $row['QTY PER BOX'];
                            
                            // Store date displayed in current row
                            $currentDate = $row['RECEIVED DATE'];

                            if($sum <= $qty) {
                                
                                $html .=  '<tr>'. '<td>'. $count. '</td>'. '<td>'. $row['VENDOR CODE']. '</td>'. '<td>'. $row['VENDOR NAME']. '</td>'. '<td>'. $row['INVOICE NO']. '</td>'. '<td>'. date('d-m-Y', strtotime($row['DATE'])). '</td>'. '<td>'. date('d-m-Y', strtotime($row['RECEIVED DATE'])). '</td>'. '<td>'. $row['BOX NO']. '</td>'. '<td>'. $row['QTY PER BOX']. '</td>'. '</tr>';
                                
                                if($sum == $qty) {

                                    break;
                                }            
                            }
                  
                            else if($sum > $qty) {
                                
                                /* SQL query to retrieve rows >= current row's date having quantity < current row qty sorted by received date for the given PART NO
                                */
                                $leastQtyQuery = "SELECT grn_details.`VENDOR CODE`, grn_details.`VENDOR NAME`, grn_details.`INVOICE NO`, DATE_FORMAT(grn_details.`INVOICE DATE`,'%Y-%m-%d') AS DATE, DATE_FORMAT(grn_details.`RECEIVED DATE`,'%Y-%m-%d') AS `RECEIVED DATE`, SUM(grn_details.`TOTAL QTY`) AS BOX_SUM, grn_subdetails.`BOX NO`, grn_subdetails.`QTY PER BOX` FROM grn_details INNER JOIN grn_subdetails ON grn_details.grn_details_id = grn_subdetails.grn_details_id  WHERE grn_details.`PART NUMBER` = ". $partNo. "  AND grn_details.`RECEIVED DATE` >= '" .$currentDate. "'". "  AND grn_subdetails.`QTY PER BOX` < ". $currentRowQty. "  GROUP BY grn_subdetails_id ORDER BY grn_details.`RECEIVED DATE` ASC, grn_subdetails.`QTY PER BOX` ASC";
                                
                                // Execute query in MySQL
                                $fetchedData = $conn->query($leastQtyQuery);
                                $tempSum = $lastSum;
                                while($row1 = $fetchedData->fetch_assoc()) {  

                                    $currentDateCanFulfill = false; 
                                    if(($row1['BOX_SUM'] - $lastSum) >= ($qty - $lastSum)) {
                                        
                                        $currentDateCanFulfill = true; 
                                    }

                                    if(($row1['RECEIVED DATE'] != $currentDate) && $currentDateCanFulfill) {
                                        break;
                                    }

                                    $tempSum += $row1['QTY PER BOX'];

                                    // Keep saving what is supposed to be printed
                                    $tempHtml .=  '<tr>'. '<td>'. $count. '</td>'.'<td>'. $row1['VENDOR CODE']. '</td>'. '<td>'. $row1['VENDOR NAME']. '</td>'. '<td>'. $row1['INVOICE NO']. '</td>'.  '<td>'. date('d-m-Y', strtotime($row1['DATE'])). '</td>'. '<td>'. date('d-m-Y', strtotime($row1['RECEIVED DATE'])). ' </td>'. '<td>'. $row1['BOX NO']. '</td>'. '<td>'. $row1['QTY PER BOX']. '</td>' . '</tr>';

                                     if($tempSum >= $qty) {
                                         
                                        break;
                                    }
                                } 

                                // Print saved data ONLY if this condition satisfies
                                if($tempSum >= $qty) {
                                    
                                        if($tempSum < $sum) {
                                            
                                            $html .= $tempHtml;
                                            $sum = $tempSum;
                                        } else {
                                            
                                            $html .=  '<tr>'. '<td>'. $count. '</td>'. '<td>'. $row['VENDOR CODE']. '</td>'. '<td>'. $row['VENDOR NAME']. '</td>'. '<td>'. $row['INVOICE NO']. '</td>'. '<td>'. date('d-m-Y', strtotime($row['DATE'])). '</td>'. '<td>'. date('d-m-Y', strtotime($row['RECEIVED DATE'])). '</td>'. '<td>'. $row['BOX NO']. '</td>'. '<td>'. $row['QTY PER BOX']. '</td>'. '</tr>';
                                        }
                                } else {
                                     $html .=  '<tr>'. '<td>'. $count. '</td>'. '<td>'. $row['VENDOR CODE']. '</td>'. '<td>'. $row['VENDOR NAME']. '</td>'. '<td>'. $row['INVOICE NO']. '</td>'. '<td>'. date('d-m-Y', strtotime($row['DATE'])). '</td>'.  '<td>'. date('d-m-Y', strtotime($row['RECEIVED DATE'])). '</td>'. '<td>'. $row['BOX NO']. '</td>'. '<td>'. $row['QTY PER BOX']. '</td>'. '</tr>';
                                }

                            break;
                            }              
                        }

                        // Display Available stock, Requested quantity, Granted quantity for PART NO
                        echo "<h5 id = 'displayStockdetails'>Available stock for Part No: <unit>". $partNo. "</unit> &nbsp;&nbsp;&nbsp; Requested quantity: <unit>". $qty. "</unit> &nbsp;&nbsp;&nbsp; Granted quantity: <unit>". $sum. "</unit></h5><br>";    
                    } else {
                    echo "<h3 id = 'invalidEntry'>Required Quantity Not Available</h3><br>";
                    }
                    
                    $conn->close();
                } else {
                    echo "<h3 id = 'invalidEntry'>Please enter a valid Part NO</h3><br>";
                }
            }
        ?> 

        <div id = "grn_details-wrapper">
            
            <!-- Display fetched details in table -->
            <table id = "grn_details">
                <thead>
                    <tr>
                        <th>S.NO</th>
                        <th>VENDOR CODE</th>
                        <th>VENDOR NAME</th>
                        <th>INVOICE NO</th>
                        <th>INVOICE DATE</th>
                        <th>RECEIVED DATE</th>
                        <th>BOX NO</th>
                        <th>QTY PER BOX</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        echo $html;
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <div id = "scanItem" class = "tabcontent">
        <h1 id = "tabTitle">FIFO-based Scan for Part #</h2>
        
        <!-- Form for getting box details from scanned QR code -->
        <form  id = "partSearch" class = "form-inline" method = "POST" action = "#" >
        
            <input type = "text" id = "partScanBox" class = "form-control mb-2 mr-sm-2 mb-sm-0 keyboard-num" placeholder = "Scan Item QR Code" />
        </form>
    </div>
    
    <!-- Include external scripts -->
    <script src = "jquery.min.js"></script>
    <script src = "bootstrap.min.js"></script>
    <script src = "jquery.keyboard.extension-typing.js"></script>
    <script src = "jquery.keyboard.js"></script>
    <script src = "jquery.mousewheel.js"></script>
    <script src = "jquery.keyboard.extension-autocomplete.js"></script>
    
    <script>
        
        var curr_id;
        document.createElement("unit");
        
        // Functionality for Tabs
        function displayContent(evt, tabName) {
            
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                
                tabcontent[i].style.display = "none";
            }
            
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                
                tablinks[i].className = tablinks[i].className.replace("active", "");
            }
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += "active";
        }

        // Get the element with id = "defaultOpen" and click on it
        document.getElementById("defaultOpen").click();

        // Set Id of field to enter input in that field
        function setId(id) {
            
            curr_id = id;
        }

        // Functionality for delete button
        function onDelete() {
            
            var $fieldToDelete = $('#' + curr_id);
            $fieldToDelete.val($.trim($fieldToDelete.val()).slice(0, -1));
        }

        // Functionality for clear button
        function onClear() {
            
           var $fieldToClear = $('#' + curr_id);
           $fieldToClear.val("");
        }

        // Functionality for clear all button
        $(".reset").bind("click", function() {
            
                $("input[type=text], input[type=number], textarea").val("");
        });
  
        // Functionality for on-screen alphanumeric keyboard 
        $('.keyboard-alpha').keyboard({
            layout: 'custom',
            autoAccept: 'true',
            customLayout: {
                'default': [
                    'Q W E R T Y U I O P {sp:2.5}       7 8 9 ',
                    '{sp:1} A S D F G H J K L {sp:3.85} 4 5 6 ',
                    '{sp:3.45} Z X C V B N M {sp:6.1}   1 2 3',
                    ' {sp:26} 0 '
                    ]
            },
            usePreview: false, 
            visible: function(e, keyboard, el) {
                addNav(keyboard);
            },
            beforeClose: function(e, keyboard, el, accepted) {
                $('input.current').removeClass('current');
                $("body").css('padding-bottom', '0px');
            }
        });

        // Functionality for on-screen numeric-only keyboard 
        $('.keyboard-num').keyboard({
            layout: 'custom',
            autoAccept: 'true',
            customLayout: {
                'default': [
                    '7 8 9',
                    '4 5 6',
                    '1 2 3',
                    '0',
                    ]
            },
            usePreview: false,
            visible: function(e, keyboard, el) {
                addNav(keyboard);
            },
            beforeClose: function(e, keyboard, el, accepted) {
                $('input.current').removeClass('current');
                $("body").css('padding-bottom', '0px');
            }
        });
    </script>
</body>
</html>