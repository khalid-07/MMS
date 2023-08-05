<?php
include "database.php";
session_start();
$email = $_SESSION["username"];
$userId = $_SESSION["userId"];
$name = $_SESSION["name"];
//$profileId = $_SESSION["userProfile"];
if (isset($_POST["action"])) {
    //include("database.php");
    // To fetch all the meeting minutes for normal users
    if ($_POST["action"] == "fetchall") {
        $output = "";
        $selectQuery = "";
        if($_SESSION["role"]=="admin"){
            $selectQuery = "SELECT * FROM fyp_2022.tblMinutes min JOIN (SELECT * FROM fyp_2022.tblUserMinutes) 
            usermin ON min.id = usermin.minute_id AND usermin.user_access = 'Owner' ORDER BY min.minute_date DESC";
        }else{
            $selectQuery = "SELECT * FROM fyp_2022.tblMinutes AS min JOIN fyp_2022.tblUserMinutes AS usermin 
            ON min.id = usermin.minute_id AND usermin.user_id = '$userId' ORDER BY  min.minute_date DESC";
        }
        
        //$selectQuery = "SELECT * from tblUsers WHERE user_email != '$email'";
        $selectResult = (mysqli_query($conn, $selectQuery));
        //$output .= "<div class=\"col-11\">";
        if (mysqli_num_rows($selectResult) > 0) {
            while ($row = mysqli_fetch_assoc($selectResult)) {
                $access = $row["user_access"];
                $output .= "
                <div class=\"col-6 col-sm-3 card\" style=\"padding: 20px 15px 20px 15px\">
                    <div style=\"font-style:oblique;font-size:1.3rem;\">
                        <b><label style=\"width:180px; display: inline-block;white-space: nowrap;
                        overflow:hidden;text-overflow: ellipsis;\">
                        " . $row["minute_title"] . "
                        </label></b>
                    </div>
                    <div style=\"font-style:oblique;\">
                        <label style=\"font-style:oblique;width:150px; display: inline-block;white-space: nowrap;
                        overflow:hidden;text-overflow: ellipsis;\">" .
                    $row["minute_objective"] . "</label>
                    </div>
                    <div class=\"col-12\" style=\"font-style:oblique;font-size:1rem\">
                        <label>" .
                    date("d-m-Y", strtotime($row["minute_date"])) . "
                        </label>
                    </div>
                    <div  style=\"text-align: center\" class=\"mt-1\">        
                        <button type=\"button\" class=\"btn btn-lg buttonStyle\" onclick=\"detailsPage(" . $row['id'] . ")\" 
                        name=\"detailsButton\">
                        <i class=\"fa-sharp fa-solid fa-circle-info\"></i>
                        </button>
                        ";
                if ($access == "Owner" && $_SESSION["role"]!="admin") {
                    $output .= "<button type=\"button\" onclick=\"shareMinutes(" . $row['id'] . ")\" class=\"btn btn-lg buttonStyle\" 
                    data-bs-toggle=\"modal\" data-bs-target=\"#exampleModal\">
                            <i class=\"fa-sharp fa-solid fa-share-nodes\"></i>
                            </button>   
                            <button type=\"button\" onclick=\"editPage(" . $row['id'] . ")\" class=\"btn btn-lg buttonStyle\" 
                            data-bs-toggle=\"modal\" data-bs-target=\"#exampleModal\">
                            <i class=\"fa-sharp fa-solid fa-pen-to-square\"></i>
                            </button>";
                }
                $output .= "
                    </div>
                </div>
                ";

            }
            //echo $output;
            
        } else {
            if($_SESSION["role"]!="admin"){
                $output = "<h2 class=\"text-center\">No Records</h2> <p class=\"text-center\">Looks like you haven't created any minutes or no one shared minutes with you.<br /> Go Ahead and click Create.</p>";
            }
            else{
                $output = "<h2 class=\"text-center\">No Records</h2>";
            }
        }
        echo $output;
    }
// To fetch all the users for admin
if ($_POST["action"] == "fetchallUsers") {
    $output = "";
    $checkbox = "";
    $selectQuery = "SELECT * FROM tblUsers WHERE user_role != 'admin'";
    //$selectQuery = "SELECT * from tblUsers WHERE user_email != '$email'";
    $selectResult = (mysqli_query($conn, $selectQuery));
    //$output .= "<div class=\"col-11\">";
    if (mysqli_num_rows($selectResult) > 0) {
        while ($row = mysqli_fetch_assoc($selectResult)) {
            //$access = $row["user_access"];
            if($row["user_status"]==0){
                $checkbox = "<input type=\"checkbox\" id=\"" . $row["id"] . "\" onclick=\"changeStatus(" . $row["id"] . ")\" />";
            }else{
                $checkbox = "<input checked type=\"checkbox\" id=\"" . $row["id"] . "\" onclick=\"changeStatus(" . $row["id"] . ")\" />";
            }
            $output .= "
            <div class=\"col-6 col-sm-3 card\" style=\"padding: 20px 15px 20px 15px\">
                <div style=\"font-style:oblique;font-size:1.3rem;\">
                    <b><label style=\"width:180px; display: inline-block;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;\">
                    " . $row["user_firstname"] ." ". $row["user_lastname"]."
                    </label></b>

                </div>
                <div style=\"font-style:oblique;\">
                    <label style=\"font-style:oblique;width:150px; display: inline-block;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;\">" .
                $row["user_email"] . "</label>
                </div>
                <div class=\"col-12\" style=\"font-style:oblique;font-size:1rem\">
                    
                    <label>" .
                $row["user_phone"]. "
                    </label>
                   
                </div>
                <div  style=\"text-align: center\" class=\"mt-1\">        
                    <button type=\"button\" class=\"btn btn-lg buttonStyle\" onclick=\"detailsPage(" . $row['id'] . ")\" name=\"detailsButton\">
                    <i class=\"fa-sharp fa-solid fa-circle-info\"></i>
                    </button><br/>
                    <label style=\"font-size:1.2rem\">Active</label>&nbsp;&nbsp;";
                    $output .= $checkbox;
            
            $output .= "
                </div>
            </div>
            ";
        }
    } else {
        $output = "<h2 class=\"text-center\">No Records</h2>";
    }
    //$output .= "</div> &nbsp;";
    echo $output;

}
    if ($_POST["action"] == "filter2Minutes") {
        // echo $_POST["month"];
        // echo $_POST["year"];
        //echo "grgg";
        sleep(2);
        $output = "";
        //$title = $_POST["title"];
        $selectQuery = "";
        if(empty($_POST["month"]) && empty($_POST["year"])){
            if($_SESSION["role"]=="admin"){
                $selectQuery = "SELECT * FROM fyp_2022.tblMinutes min JOIN (SELECT * FROM fyp_2022.tblUserMinutes) usermin ON min.id = usermin.minute_id AND usermin.user_access = 'Owner' ORDER BY min.minute_date DESC";
            }
            else{
                $selectQuery = "SELECT * FROM fyp_2022.tblMinutes AS min JOIN fyp_2022.tblUserMinutes AS usermin ON min.id = usermin.minute_id AND usermin.user_id = '$userId' ORDER BY  min.minute_date DESC";
            }
            //echo "title and date empty";
        }
        else if(empty($_POST["month"]) && !empty($_POST["year"])){
            $year = $_POST["year"];
            //echo $date;
            if($_SESSION["role"]=="admin"){
                $selectQuery = "SELECT * FROM fyp_2022.tblMinutes min JOIN (SELECT * FROM fyp_2022.tblUserMinutes) usermin ON min.id = usermin.minute_id AND usermin.user_access = 'Owner' AND YEAR(minute_date) = '$year' ORDER BY min.minute_date DESC";
            }else{
                $selectQuery = "SELECT * FROM fyp_2022.tblMinutes AS min JOIN fyp_2022.tblUserMinutes AS usermin ON min.id = usermin.minute_id AND usermin.user_id = '$userId' AND YEAR(minute_date) = '$year' ORDER BY  min.minute_date DESC";
            }
            
            
        }
            //echo "title empty and date not empty".$date;
        else if(!empty($_POST["month"]) && empty($_POST["year"])){
            $month = $_POST["month"];
            if($_SESSION["role"]=="admin"){
                $selectQuery = "SELECT * FROM fyp_2022.tblMinutes min JOIN (SELECT * FROM fyp_2022.tblUserMinutes) usermin ON min.id = usermin.minute_id AND usermin.user_access = 'Owner' AND Month(minute_date) = '$month' ORDER BY min.minute_date DESC";
            }
            else{
                $selectQuery = "SELECT * FROM fyp_2022.tblMinutes AS min JOIN fyp_2022.tblUserMinutes AS usermin ON min.id = usermin.minute_id AND usermin.user_id = '$userId' AND Month(minute_date) = '$month' ORDER BY  min.minute_date DESC";
            }
            
        }
        else{
            $month = $_POST["month"];
            $year = $_POST["year"];
            if($_SESSION["role"]=="admin"){
                $selectQuery = "SELECT * FROM fyp_2022.tblMinutes min JOIN (SELECT * FROM fyp_2022.tblUserMinutes) usermin ON min.id = usermin.minute_id AND usermin.user_access = 'Owner' AND Month(minute_date) = '$month' AND YEAR(minute_date) = '$year' ORDER BY min.minute_date DESC";
            }
            else{
                $selectQuery = "SELECT * FROM fyp_2022.tblMinutes AS min JOIN fyp_2022.tblUserMinutes AS usermin ON min.id = usermin.minute_id AND usermin.user_id = '$userId' AND Month(minute_date) = '$month' AND YEAR(minute_date) = '$year' ORDER BY  min.minute_date DESC";
            }
            
        }
        $selectResult = (mysqli_query($conn, $selectQuery));
            if (mysqli_num_rows($selectResult) > 0) {
                while ($row = mysqli_fetch_assoc($selectResult)) {
                    $access = $row["user_access"];
                    $output .= "
                    <div class=\"col-6 col-sm-3 card\" style=\"padding: 20px 15px 20px 15px\">
                        <div style=\"font-style:oblique;font-size:1.3rem;\">
                            <b><label style=\"width:180px; display: inline-block;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;\">
                            " . $row["minute_title"] . "
                            </label></b>
    
                        </div>
                        <div style=\"font-style:oblique;\">
                            <label style=\"font-style:oblique;width:150px; display: inline-block;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;\">" .
                        $row["minute_objective"] . "</label>
                        </div>
                        <div class=\"col-12\" style=\"font-style:oblique;font-size:1rem\">
                            
                            <label>" .
                        date("d-m-Y", strtotime($row["minute_date"])) . "
                            </label>
                           
                        </div>
                        <div  style=\"text-align: center\" class=\"mt-1\">        
                            <button type=\"button\" class=\"btn btn-lg buttonStyle\" onclick=\"detailsPage(" . $row['id'] . ")\" name=\"detailsButton\">
                            <i class=\"fa-sharp fa-solid fa-circle-info\"></i>
                            </button>
                            ";
                    if ($access == "Owner" && $_SESSION["role"]!="admin") {
                        $output .= "<button type=\"button\" onclick=\"shareMinutes(" . $row['id'] . ")\" class=\"btn btn-lg buttonStyle\" data-bs-toggle=\"modal\" data-bs-target=\"#exampleModal\">
                                <i class=\"fa-sharp fa-solid fa-share-nodes\"></i>
                                </button>   
                                <button type=\"button\" onclick=\"editPage(" . $row['id'] . ")\" class=\"btn btn-lg buttonStyle\" data-bs-toggle=\"modal\" data-bs-target=\"#exampleModal\">
                                <i class=\"fa-sharp fa-solid fa-pen-to-square\"></i>
                                </button>";
                    }
                    $output .= "
                        </div>
                    </div>
                    ";
                }
            }else{
                echo "
                <div class=\"text-center\" style=\"color:#00386c\">
                <h2>No Record Found</h2>
                </div>";
            }
         echo $output;
    }



    if ($_POST["action"] == "filterMinutes") {
        $output = "";
        //$title = $_POST["title"];
        $selectQuery = "";
        if(empty($_POST["title"]) && empty($_POST["date"])){
            if($_SESSION["role"]=="admin"){
                $selectQuery = "SELECT * FROM fyp_2022.tblMinutes min JOIN (SELECT * FROM fyp_2022.tblUserMinutes) usermin ON min.id = usermin.minute_id AND usermin.user_access = 'Owner' ORDER BY min.minute_date DESC";
            }else{
                $selectQuery = "SELECT * FROM fyp_2022.tblMinutes AS min JOIN fyp_2022.tblUserMinutes AS usermin ON min.id = usermin.minute_id AND usermin.user_id = '$userId' ORDER BY  min.minute_date DESC";
            }
            
            //echo "title and date empty";
        }
        else if(empty($_POST["title"]) && !empty($_POST["date"])){
            $date = date("Y-m-d", strtotime($_POST["date"]));
            if($_SESSION["role"]=="admin"){
                $selectQuery = "SELECT * FROM fyp_2022.tblMinutes min JOIN (SELECT * FROM fyp_2022.tblUserMinutes) usermin ON min.id = usermin.minute_id AND usermin.user_access = 'Owner' AND CAST(min.minute_date as date)='$date' ORDER BY min.minute_date DESC";
            }else{
            
            //echo $date;
            $selectQuery = "SELECT * FROM fyp_2022.tblMinutes AS min JOIN fyp_2022.tblUserMinutes AS usermin ON min.id = usermin.minute_id AND usermin.user_id = '$userId' AND CAST(min.minute_date as date)='$date' ORDER BY min.minute_date DESC";
            }
            
        }
            //echo "title empty and date not empty".$date;
        else if(!empty($_POST["title"]) && empty($_POST["date"])){
            $title = $_POST["title"];
            if($_SESSION["role"]=="admin"){
                $selectQuery = "SELECT * FROM fyp_2022.tblMinutes min JOIN (SELECT * FROM fyp_2022.tblUserMinutes) usermin ON min.id = usermin.minute_id AND usermin.user_access = 'Owner' AND min.minute_title LIKE '%$title%' ORDER BY min.minute_date DESC";
            }else{
                $selectQuery = "SELECT * FROM fyp_2022.tblMinutes AS min JOIN fyp_2022.tblUserMinutes AS usermin ON min.id = usermin.minute_id AND usermin.user_id = '$userId' AND min.minute_title LIKE '%$title%' ORDER BY min.minute_date DESC";
            }
        }
        else{
            $date = date("Y-m-d", strtotime($_POST["date"]));
            $title = $_POST["title"];
            if($_SESSION["role"]=="admin"){
                $selectQuery = "SELECT * FROM fyp_2022.tblMinutes min JOIN (SELECT * FROM fyp_2022.tblUserMinutes) usermin ON min.id = usermin.minute_id AND usermin.user_access = 'Owner' AND min.minute_title LIKE '%$title%' AND CAST(min.minute_date as date)='$date' ORDER BY min.minute_date DESC";
            }else{
                $selectQuery = "SELECT * FROM fyp_2022.tblMinutes AS min JOIN fyp_2022.tblUserMinutes AS usermin ON min.id = usermin.minute_id AND usermin.user_id = '$userId' AND min.minute_title LIKE '%$title%' AND CAST(min.minute_date as date)='$date' ORDER BY min.minute_date DESC";
            }
            
        }
        $selectResult = (mysqli_query($conn, $selectQuery));
            if (mysqli_num_rows($selectResult) > 0) {
                while ($row = mysqli_fetch_assoc($selectResult)) {
                    $access = $row["user_access"];
                    $output .= "
                    <div class=\"col-6 col-sm-3 card\" style=\"padding: 20px 15px 20px 15px\">
                        <div style=\"font-style:oblique;font-size:1.3rem;\">
                            <b><label style=\"width:180px; display: inline-block;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;\">
                            " . $row["minute_title"] . "
                            </label></b>
    
                        </div>
                        <div style=\"font-style:oblique;\">
                            <label style=\"font-style:oblique;width:150px; display: inline-block;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;\">" .
                        $row["minute_objective"] . "</label>
                        </div>
                        <div class=\"col-12\" style=\"font-style:oblique;font-size:1rem\">
                            
                            <label>" .
                        date("d-m-Y", strtotime($row["minute_date"])) . "
                            </label>
                           
                        </div>
                        <div  style=\"text-align: center\" class=\"mt-1\">        
                            <button type=\"button\" class=\"btn btn-lg buttonStyle\" onclick=\"detailsPage(" . $row['id'] . ")\" name=\"detailsButton\">
                            <i class=\"fa-sharp fa-solid fa-circle-info\"></i>
                            </button>
                            ";
                    if ($access == "Owner" && $_SESSION["role"]!="admin") {
                        $output .= "<button type=\"button\" onclick=\"shareMinutes(" . $row['id'] . ")\" class=\"btn btn-lg buttonStyle\" data-bs-toggle=\"modal\" data-bs-target=\"#exampleModal\">
                                <i class=\"fa-sharp fa-solid fa-share-nodes\"></i>
                                </button>   
                                <button type=\"button\" onclick=\"editPage(" . $row['id'] . ")\" class=\"btn btn-lg buttonStyle\" data-bs-toggle=\"modal\" data-bs-target=\"#exampleModal\">
                                <i class=\"fa-sharp fa-solid fa-pen-to-square\"></i>
                                </button>";
                    }
                    $output .= "
                        </div>
                    </div>
                    ";
                }
            }else{
                echo "
                <div class=\"text-center\" style=\"color:#00386c\">
                <h2>No Record Found</h2>
                </div>";
            }
        //$selectQuery = "SELECT * FROM fyp_2022.tblMinutes AS min JOIN fyp_2022.tblUserMinutes AS usermin ON min.id = usermin.minute_id AND usermin.user_id = '$userId' AND min.minute_title LIKE '%$title%' ORDER BY  min.minute_date DESC";
        //$selectQuery = "SELECT * from tblUsers WHERE user_email != '$email'";
        // rem $selectResult = (mysqli_query($conn, $selectQuery));
        //$output .= "<div class=\"col-11\">";
        // if (mysqli_num_rows($selectResult) > 0) {
        //     while ($row = mysqli_fetch_assoc($selectResult)) {
        //         $access = $row["user_access"];
        //         $output .= "
        //         <div class=\"col-6 col-sm-3 card\" style=\"padding: 20px 15px 20px 15px\">
        //             <div style=\"font-style:oblique;font-family:Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif\">
        //                 <label>
        //                 " . $row["minute_title"] . "
        //                 </label>

        //             </div>
        //             <div style=\"font-style:oblique;font-family:Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif\">
        //                 <label style=\"font-style:oblique\">" .
        //             $row["minute_objective"] . "
        //                 </label>
        //             </div>
        //             <div class=\"col-12\" style=\"font-style:oblique;font-family:Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif\">
        //                 <h4 style=\"font-style:oblique\">
        //                 <label>" .
        //             date("d-m-Y", strtotime($row["minute_date"])) . "
        //                 </label>
        //                 </h4>
        //             </div>
        //             <div  style=\"text-align: center\">        
        //                 <button type=\"button\" class=\"btn btn-lg buttonStyle\" onclick=\"detailsPage(" . $row['id'] . ")\" name=\"detailsButton\">
        //                 <i class=\"fa-sharp fa-solid fa-circle-info\"></i>
        //                 </button>
        //                 ";
        //         if ($access == "Owner") {
        //             $output .= "<button type=\"button\" onclick=\"shareMinutes(" . $row['id'] . ")\" class=\"btn btn-lg buttonStyle\" data-bs-toggle=\"modal\" data-bs-target=\"#exampleModal\">
        //                     <i class=\"fa-sharp fa-solid fa-share-nodes\"></i>
        //                     </button>   
        //                     <button type=\"button\" onclick=\"editPage(" . $row['id'] . ")\" class=\"btn btn-lg buttonStyle\" data-bs-toggle=\"modal\" data-bs-target=\"#exampleModal\">
        //                     <i class=\"fa-sharp fa-solid fa-pen-to-square\"></i>
        //                     </button>";
        //         }
        //         $output .= "
        //             </div>
        //         </div>
        //         ";
        //     }
        // } else {
        //     $output .= "<h2 class=\"text-center\">No Records</h2>";
        // }
        // //$output .= "</div> &nbsp;";
         echo $output;
    }

    if ($_POST["action"] == "fetchUsers") {
        $output = "";
        $minute_Id = $_POST["id"];
        $selectQuery = "SELECT usr.id, user_email, user_firstname, user_lastname, usrgrps.status FROM tblUsers AS usr JOIN tblUserGroups AS usrgrps JOIN tblMinutes AS mins ON mins.minute_grpId = usrgrps.group_id AND usr.id = usrgrps.user_id AND mins.id = '$minute_Id' AND usr.id != '$userId';";
        $selectResult = (mysqli_query($conn, $selectQuery));
        $output .= "
        <table class=\"table table-bordered table-striped\">
        <thead style=\"background-color:#093c59; color:white\">
        <tr>
        <th>id</th>
        <th>Email</th>
        <th>Name</th>
        <th>Share</th>
        </tr>
        </thead>
        
        
        ";
        if (mysqli_num_rows($selectResult) > 0) {
            while ($row = mysqli_fetch_assoc($selectResult)) {
                $checkBox = "";
                $userId = $row["id"];
                //$min_Id = $row[""];
                $selectAccessQuery = "SELECT * FROM tblUserMinutes WHERE user_id = '$userId' AND minute_id = '$minute_Id'";
                $selectAccessResult = (mysqli_query($conn, $selectAccessQuery));
                if (mysqli_num_rows($selectAccessResult) > 0) {
                    $checkBox = "<input checked id=\"" . $row["id"] . "\" class=\"actioning\" type=\"checkbox\" onclick=\"changeStatus(" . $row["id"] . ",$minute_Id)\" />";
                } else {
                    $checkBox = "<input id=\"" . $row["id"] . "\" class=\"actioning\" type=\"checkbox\" onclick=\"changeStatus(" . $row["id"] . ",$minute_Id)\" />";
                }
                $output .= "
                <tr>
                <td>" . $row["id"] . "</td>
                <td>" . $row["user_email"] . "</td>
                <td>" . $row["user_firstname"] . "</td>
                <td>$checkBox</td>
                </tr>
                ";
            }
        }
        $output .= "</table>";

        echo $output;
    }
    if ($_POST["action"] == "grant") {
        //echo "Yalla habibi";
        $user_Id = $_POST["id"];
        $minute_Id = $_POST["minuteId"];
        $insertQuery = "INSERT into tblUserMinutes(user_id,minute_id,user_access) values('$user_Id','$minute_Id','shared')";
        $result = mysqli_query($conn, $insertQuery);
        if ($result) {
            echo "minute shared";
        } else {
            echo "problm happened";
        }
    }
    if ($_POST["action"] == "revoke") {
        echo "Yalla habibi";
        $user_Id = $_POST["id"];
        $minute_Id = $_POST["minuteId"];
        $deleteQuery = "DELETE FROM tblUserMinutes WHERE user_id = '$user_Id' AND minute_id = '$minute_Id'";
        $result = mysqli_query($conn, $deleteQuery);
        if ($result) {
            echo "minute revoked";
        } else {
            echo "problem happened";
        }
    }



    if ($_POST["action"] == "fetchOne") {
        $output = "";
        $takeAwayOutput = "";
        $id = $_POST["id"];
        $selectQuery = "SELECT * FROM tblMinutes WHERE id = '$id'";
        $selectTakeawayQuery = "SELECT * FROM tblTakeaways where minute_id = '$id'";
        //$selectQuery = "SELECT * from tblUsers WHERE user_email != '$email'";

        $selecttakeawayResult = (mysqli_query($conn, $selectTakeawayQuery));
        if (mysqli_num_rows($selecttakeawayResult) > 0) {
            $takeAwayOutput .= "
                <table class=\"table table-bordered table-striped\">
                <thead>
                <tr>
                <th>#</th>
                <th>Takeaway</th>
                <th>Owner</th>
                </tr>
                </thead>
                ";
            $index = 1;
            while ($takeawayRow = mysqli_fetch_assoc($selecttakeawayResult)) {
                $takeAwayOutput .= "
                <tr>
                <td>" . $index . "</td>
                <td>" . $takeawayRow["takeaway_item"] . "</td>
                <td>" . $takeawayRow["takeaway_owner"] . "</td>
                </tr>
                ";
                $index++;
            }
            $takeAwayOutput .= "</table>";
        }


        $selectResult = (mysqli_query($conn, $selectQuery));
        $row = $selectResult->fetch_assoc();
        $absentees = "";
        $additionalNotes = "";
        $nxtMeetingDate = "";
        $nxtMeetingPurpose = "";
        if ($row["minute_absentees"] == NULL) {
            $absentees = "None";
        }
        if ($row["minute_note"] == NULL) {
            $additionalNotes = "None";
        }
        if ($row["minute_nxt_date"] == NULL) {
            $nxtMeetingDate = "N/A";
        }
        if ($row["minute_nxt_purpose"] == NULL) {
            $nxtMeetingPurpose = "N/A";
        }

        $output.="
        <table class=\"table table-bordered\">
        <thead>
        </thead>
        <tbody>
        <tr>
            <td colspan=\"4\" style=\"font-size:1.5rem\"><strong>Meeting Title: </strong>" . $row["minute_title"] . " </td>
        </tr>
        <tr>
        <td colspan=\"4\" style=\"font-size:1.5rem\"><strong>Objective: </strong>" . $row["minute_objective"] . " </td>
        </tr>
        <tr>
        <td colspan=\"2\"><strong style=\"font-size:1.2rem\">Date: </strong><label style=\"font-size:1.2rem\">" . date("d-m-Y", strtotime($row["minute_date"])) . "</label> </td>
        <td colspan=\"2\"><strong style=\"font-size:1.2rem\">Time: </strong><label style=\"font-size:1.2rem\">" . date("h:m:s A", strtotime($row["minute_date"])) . "</label> </td>
        </tr>
        <tr>
        <td colspan=\"2\" style=\"font-size:1.5rem\"><strong>Location: </strong>" . $row["minute_location"] . " </td>
        <td colspan=\"2\" style=\"font-size:1.5rem\"><strong>By: </strong>" . $row["minute_recordedby"] . " </td>
        </tr>
        </tbody>
        </table>
        ";
        $output .= "
        <div class=\"row\">
        <div class=\"col-12 col-sm-12\">
        <label>Title</label><br/>
        <label>" . $row["minute_title"] . "</label>
        </div>
        <div class=\"col-4 col-sm-4\">
        <label>Objective</label>
        <label>" . $row["minute_objective"] . "</label>
        </div>
        <div class=\"col-4 col-sm-4\">
        <label>Dates</label>
        <h4>" . $row["minute_date"] . "</h4>
        </div>
        <label>Location</label>
        <h2>" . $row["minute_location"] . "</h2>
        <label>Recorded By</label>
        <h2>" . $row["minute_recordedby"] . "</h2>
        <label>Attendees</label>
        <h2>" . $row["minute_attendees"] . "</h2>
        <label>Absentees</label>
        <h2>" . $absentees . "</h2>
        <label>Discussion</label>
        <h2>" . $row["minute_discussion"] . "</h2>
        <label>Additional Note</label>
        <h2> " . $additionalNotes . "</h2>
        ";

        $output .= $takeAwayOutput;
        $output .= "
        <label>Next Meeting Date</label>
        <h2>" . $nxtMeetingDate . "</h2>
        <label>Next Meeting Purpose</label>
        <h2>" . $nxtMeetingPurpose . "</h2>
        </div>
        ";
        echo $output;
    }
    if ($_POST["action"] == "fetchUser") {
        $output = "";
        //$selectQuery = "SELECT * from tblUsers WHERE user_email = '$email'";
        //$selectUserResult = (mysqli_query($conn, $selectQuery));
        $row = getUser($email);
        $output .= "
        <div class=\"child\" >
                <h2 style=\"text-align: center;color:#093c59\" class=\"pt-2\">My Profile</h2>
                <label id=\"message\"></label>
                <div id=\"feedbackDiv\">
                    <div id=\"feedback\">

                    </div>
                   
                </div>
                <!-- STARTING OF THE FORM -->
                <input hidden id=\"signup\" />
                <form class=\"row\" id=\"myform\" name=\"myform\" enctype=\"multipart/form-data\">
                <div class=\"form-group col-12 col-sm-12 mb-3\">
                <img src=\"".$row["user_picture"]."\" height=\"100px\" width=\"100px\" /><br />
                    <strong>
                        <label>Upload Image</label>
                    </strong>
                    <br />
                    <strong><small><label class=\"text-warning\">(Only jpg, jpeg and png allowed)</label></small></strong>
                    <input disabled class=\"oneType\" type=\"file\" name=\"fileUpload\" id=\"fileUpload\" />
                    <label id=\"lblFileError\"></label>
                    <label id=\"lblFileTypeError\"></label>

                </div>
                    <div class=\"form-group col-12 col-sm-6\">
                        <strong>
                            <label id=\"lblFname\" for=\"txtFName\">First Name</label></strong>
                        <label id=\"lblFnameError\"></label>
                        <input disabled class=\"form-control oneType\" PlaceHolder=\"Enter First Name\" onkeyup=\"checkValue('txtFName')\"
                            name=\"fname\" value=\"".$row["user_firstname"]."\" id=\"txtFName\" />
                    </div>
                    <div class=\"form-group col-12 col-sm-6\">

                        <strong>
                            <label id=\"lblLname\" for=\"txtLName\">Last Name</label>
                            <label id=\"lblLnameError\"></label>
                        </strong>
                        <input disabled class=\"form-control oneType\" PlaceHolder=\"Enter Last Name\" onkeyup=\"checkValue('txtLName')\"
                            name=\"lname\" value=\"".$row["user_lastname"]."\" id=\"txtLName\" />
                    </div>
                    <div class=\"form-group col-12 col-sm-6\">

                        <strong>
                            <label id=\"lblEmail\" Text=\"Email\">Email</label></strong>
                        <label id=\"lblEmailError\" type=\"email\"></label>
                        <input disabled class=\"form-control\" type=\"email\" name=\"email\" 
                            PlaceHolder=\"Enter Email\" value=\"".$row["user_email"]."\" id=\"txtEmail\" />
                    </div>
                    <div class=\"form-group col-12 col-sm-6\">
                        <strong>
                            <label id=\"lblPhone\">Phone</label>
                        </strong>
                        <label id=\"lblPhoneError\"></label>
                        <input disabled class=\"form-control oneType\" value=\"".$row["user_phone"]."\" onkeyup=\"checkValue('txtPhone')\" name=\"phone\" PlaceHolder=\"Enter Phone\" id=\"txtPhone\" type=\"tel\" />
                    </div>
                    <div class=\"text-center mt-3\">
                    
                   
                <input id=\"submitField\" type=\"text\" hidden value=\"".$row["user_email"]."\" name=\"submitText\" />
                </form>
                <input value=\"Edit\" class=\"btn w-50 buttonStyle\" id=\"editButton\" onclick=\"enableField()\" />
                    
                    <input value=\"Cancel\" class=\"btn col-5 buttonStyle\" style=\"display:none\" id=\"cancelButton\" onclick=\"disableField()\"/>
                    
                    <input type=\"button\" value=\"Save\" class=\"btn col-5 buttonStyle\" style=\"display:none\" id=\"saveButton\" onclick=\"submitForm()\" />
                    </div>
                </div>";
        //echo $row["user_firstname"] . " " . $row["user_lastname"];
        echo $output;
    }
    if ($_POST["action"] == "fetchUserProfile") {
        $output = "";
        //$selectQuery = "SELECT * from tblUsers WHERE user_email = '$email'";
        //$selectUserResult = (mysqli_query($conn, $selectQuery));
        $row = getUserProfile($_SESSION["userProfile"]);
        $status = "";
        if($row["user_status"]== 0){
            $status = "In Active";
        }else{
            $status = "Active";
        }
        $output .= "
        <div class=\"child\" >
                <h2 style=\"text-align: center;color:#093c59\" class=\"pt-2\">User Profile</h2>
                <label id=\"message\"></label>
                <div id=\"feedbackDiv\">
                    <div id=\"feedback\">

                    </div>
                   
                </div>
                <!-- STARTING OF THE FORM -->
                <input hidden id=\"signup\" />
                <form class=\"row\" id=\"myform\" name=\"myform\" enctype=\"multipart/form-data\">
                <div class=\"form-group col-12 col-sm-12 mb-3\">
                <img src=\"".$row["user_picture"]."\" height=\"100px\" width=\"100px\" /><br />
                </div>
                    <div class=\"form-group col-12 col-sm-6\">
                        <strong>
                            <label id=\"lblFname\" for=\"txtFName\">First Name</label></strong>
                        <label id=\"lblFnameError\"></label>
                        <input disabled class=\"form-control oneType\" PlaceHolder=\"Enter First Name\" onkeyup=\"checkValue('txtFName')\"
                            name=\"fname\" value=\"".$row["user_firstname"]."\" id=\"txtFName\" />
                    </div>
                    <div class=\"form-group col-12 col-sm-6\">

                        <strong>
                            <label id=\"lblLname\" for=\"txtLName\">Last Name</label>
                            <label id=\"lblLnameError\"></label>
                        </strong>
                        <input disabled class=\"form-control oneType\" PlaceHolder=\"Enter Last Name\" onkeyup=\"checkValue('txtLName')\"
                            name=\"lname\" value=\"".$row["user_lastname"]."\" id=\"txtLName\" />
                    </div>
                    <div class=\"form-group col-12 col-sm-6\">

                        <strong>
                            <label id=\"lblEmail\" Text=\"Email\">Email</label></strong>
                        <label id=\"lblEmailError\" type=\"email\"></label>
                        <input disabled class=\"form-control\" type=\"email\" name=\"email\" 
                            PlaceHolder=\"Enter Email\" value=\"".$row["user_email"]."\" id=\"txtEmail\" />
                    </div>
                    <div class=\"form-group col-12 col-sm-6\">
                        <strong>
                            <label id=\"lblPhone\">Phone</label>
                        </strong>
                        <label id=\"lblPhoneError\"></label>
                        <input disabled class=\"form-control oneType\" value=\"".$row["user_phone"]."\" onkeyup=\"checkValue('txtPhone')\" name=\"phone\" PlaceHolder=\"Enter Phone\" id=\"txtPhone\" type=\"tel\" />
                    </div>
                    <div style=\"font-size:1.2rem\" mt-3\">
                    <label>Status: </label>
                    <b><label>".$status."</label></b>
                   </div>
                <input id=\"submitField\" type=\"text\" hidden value=\"".$row["user_email"]."\" name=\"submitText\" />
                </form>
                    </div>
                </div>";
        //echo $row["user_firstname"] . " " . $row["user_lastname"];
        echo $output;
    }
}
if ($_POST["action"] == "deleteMinute") {
    $minute_Id = $_POST["id"];
    //echo $minute_Id;
    $row = getMinuteTitle($minute_Id);
    $title = $row["minute_title"];
    date_default_timezone_set("Asia/Qatar");
    $date = date("Y/m/d H:i:s");
    $type = "DM";
    //echo $row["minute_title"];
    $deleteQuery = "DELETE FROM tblMinutes WHERE id = '$minute_Id'";
    $insertQuery = "INSERT into tblLog (user_id,user_name,minute_title,time,user_email,type) values ('$userId','$name','$title','$date','$email','$type')";
    $insertResult = mysqli_query($conn, $insertQuery);
    $result = mysqli_query($conn, $deleteQuery);
    if ($result) {
        $file_pointer = "../fyp/voicenotes/".$minute_Id.".txt";
        if (file_exists($file_pointer)) {
            $status=unlink($file_pointer);    
        }
        echo "minute deleted successfully";
    } else {
        echo "problem deleting minute";
    }
}

function getUser($email)
{
    //$email = $_SESSION["username"];
    include "database.php";
    $selectQuery = "SELECT * from tblUsers WHERE user_email = '$email'";
    $selectUserResult = (mysqli_query($conn, $selectQuery));
    $row = $selectUserResult->fetch_assoc();
    return $row;
}
function getUserProfile($id)
{
    //$email = $_SESSION["username"];
    include "database.php";
    $selectQuery = "SELECT * from tblUsers WHERE id = '$id'";
    $selectUserResult = (mysqli_query($conn, $selectQuery));
    $row = $selectUserResult->fetch_assoc();
    return $row;
}
function getAllUsers()
{
    include "database.php";
    $selectQuery = "SELECT * from tblUsers";
    $selectUserResult = (mysqli_query($conn, $selectQuery));
    $rows = $selectUserResult->fetch_assoc();
    return $rows;
}
function getMinuteTitle($id){
    include "database.php";
    $selectQuery = "SELECT minute_title from tblMinutes WHERE id = '$id'";
    $selectUserResult = (mysqli_query($conn, $selectQuery));
    $row = $selectUserResult->fetch_assoc();
    return $row;
}