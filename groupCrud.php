<?php
session_start();
include "database.php";
$userId = $_SESSION["userId"];
if (isset($_POST["action"])) {
    if ($_POST["action"] == "fetchAllGroups") {
        $selectQuery = "SELECT * FROM tblGroups AS grp JOIN tblUserGroups AS usrgrps ON grp.id = usrgrps.group_id AND usrgrps.user_id = '$userId' AND Status = 'owner'";
        //$selectQuery = "SELECT * from tblUsers WHERE user_email != '$email'";
        $selectResult = (mysqli_query($conn, $selectQuery));
        //$output .= "<div class=\"col-11\">";
        $output = "";
        $output .= "
        <br />
        <h3>Groups You Created</h3>
        <table class=\"table table-striped\">
        <thead class=\"table-dark\">
        <tr>
        <th>
        Name
        </th>
        <th>
        Number
        </th>
        <th>Test</th>
        </tr>
        </thead>";
        if (mysqli_num_rows($selectResult) > 0) {
            while ($row = mysqli_fetch_assoc($selectResult)) {
                $output .= "<tr>
                <td>" . $row["name"] . "</td>
                <td>" . $row["number"] . "</td>
                <td class=\"text-center\"><button>Action</button>&nbsp;<button id=\"btnDelete\" onclick=\"deleteGroup(" . $row["id"] . ")\" >Delete</button></td>
                </tr>";
            }
            $output .= " </table>";
        } else {
            $output .= "<tbody>
            <tr>
            <td colspan=\"3\"><h3 style=\"text-align:center\">No Record</h3></td>
            </tr>
            </tbody>
            </table>";
        }
        echo $output;
    }
    if ($_POST["action"] == "adminAllGroups") {
        $selectQuery = "SELECT grp.id,grp.name,grp.number,usrgrps.group_number, COUNT(*) as totalMembers FROM tblGroups AS grp JOIN tblUserGroups AS usrgrps ON grp.id = usrgrps.group_id GROUP BY usrgrps.group_number,grp.id,grp.name,grp.number;";
        //$selectQuery = "SELECT * from tblUsers WHERE user_email != '$email'";
        $selectResult = (mysqli_query($conn, $selectQuery));
        //$output .= "<div class=\"col-11\">";
        $output = "";
        $output .= "
        <h3>Groups</h3>
        <table class=\"table table-striped\">
        <thead style=\"background-color:#093c59; color:white\">
        <tr>
        <th>
        Name
        </th>
        <th>
        Number
        </th>
        <th>
        Members
        </th>
        <th class=\"text-center\"></th>
        </tr>
        </thead>";
        if (mysqli_num_rows($selectResult) > 0) {
            while ($row = mysqli_fetch_assoc($selectResult)) {
                $output .= "<tr>
                <td>" . $row["name"] . "</td>
                <td>" . $row["number"] . "</td>
                <td>" . $row["totalMembers"] . "</td>
                <td class=\"text-center\"><button class=\"btn btn-primary\" id=\"adminEditButton\" onclick=\"confirmEditGroup(" . $row["id"] . ")\" data-bs-toggle=\"modal\" data-bs-target=\"#adminEditModal\"><i class=\"fa-solid fa-pen-to-square\"></i></button>&nbsp;
                <button class=\"btn btn-danger\" id=\"adminBtnDelete\" onclick=\"confirmDeleteGroup(" . $row["id"] . ")\" data-bs-toggle=\"modal\" data-bs-target=\"#adminDeleteModal\" ><i class=\"fa-sharp fa-solid fa-trash\"></i></button>&nbsp;
                <button class=\"btn btn-warning\" onclick=\"showMembers(".$row["id"].")\" data-bs-toggle=\"modal\" data-bs-target=\"#adminMembersModal\"><i class=\"fa-solid fa-users\"></i></button></td>
                </tr>";
            }
            $output .= " </table>";
        } else {
            $output .= "<tbody>
            <tr>
            <td colspan=\"3\"><h3 style=\"text-align:center\">No Record</h3></td>
            </tr>
            </tbody>
            </table>";
        }
        echo $output;
    }
    if($_POST["action"]=="showMembers"){
        $id = $_POST["id"];
        $output = "";
        $selectQuery = "SELECT DISTINCT usr.user_firstname, usr.user_lastname, usr.user_email FROM tblUsers as usr JOIN tblUserGroups as usrgrp ON usrgrp.group_id = '$id' AND usr.id = usrgrp.user_id";
        $selectResult = (mysqli_query($conn, $selectQuery));
        $output .= "
        <table class=\"table table-striped\">
        <thead style=\"background-color:#093c59; color:white\">
        <tr>
        <th>
        Name
        </th>
        <th>
        Email
        </th>
        </tr>
        </thead>";
        if (mysqli_num_rows($selectResult) > 0) {
            while ($row = mysqli_fetch_assoc($selectResult)) {
                $output .= "<tr>
                <td>" . $row["user_firstname"] ." ".$row["user_lastname"]. "</td>
                <td>" . $row["user_email"] . "</td>
                </tr>";
            }
            $output .= " </table>";
        }
        echo $output;
        //echo "Yalla Habibi: ".$id;
    }
    if ($_POST["action"] == "fetchAllGroupList") {
        $selectQuery = "SELECT * FROM tblGroups AS grp JOIN tblUserGroups AS usrgrps ON grp.id = usrgrps.group_id AND usrgrps.user_id = '$userId'";
        //$selectQuery = "SELECT * from tblUsers WHERE user_email != '$email'";
        $selectResult = (mysqli_query($conn, $selectQuery));
        //$output .= "<div class=\"col-11\">";
        $output = "";
        $output .= "
        
        <select class=\"form-control form-control-static\" name=\"groups\" id=\"groups\">
        <option value=\"0\">Select</option>";
        if (mysqli_num_rows($selectResult) > 0) {
            while ($row = mysqli_fetch_assoc($selectResult)) {
                $output .= "
                <option value=\"" . $row["id"] . "\">" . $row["name"] . "</option>";
            }
            $output .= " </select>";
        } else {
            $output .= "
            </select>";
        }
        echo $output;
    }
    if ($_POST["action"] == "fetchOneGroupList") {
        $minute_grpid = $_POST["id"];
        $selectQuery = "SELECT * FROM tblGroups AS grp JOIN tblUserGroups AS usrgrps ON grp.id = usrgrps.group_id AND usrgrps.user_id = '$userId'";
        //$selectQuery = "SELECT * from tblUsers WHERE user_email != '$email'";
        $selectResult = (mysqli_query($conn, $selectQuery));
        //$output .= "<div class=\"col-11\">";
        $output = "";
        $output .= "
        
        <select class=\"form-control form-control-static\" name=\"groups\" id=\"groups\">
        <option value=\"0\">Select</option>";
        if (mysqli_num_rows($selectResult) > 0) {
            while ($row = mysqli_fetch_assoc($selectResult)) {
                if($row["id"]==$minute_grpid){
                    $output .= "
                <option selected value=\"" . $row["id"] . "\">" . $row["name"] . "</option>";
                }else{
                    $output .= "
                    <option value=\"" . $row["id"] . "\">" . $row["name"] . "</option>";
                }
                
            }
            $output .= " </select>";
        } else {
            $output .= "
            </select>";
        }
        echo $output;
    }
    if ($_POST["action"] == "checkGroups") {
        $selectGroupsQuery = "SELECT * FROM tblGroups AS grp JOIN tblUserGroups AS usrgrps ON grp.id = usrgrps.group_id AND usrgrps.user_id = '$userId'";
        //$selectQuery = "SELECT * from tblUsers WHERE user_email != '$email'";
        $selectResult = (mysqli_query($conn, $selectGroupsQuery));
        //$output .= "<div class=\"col-11\">";
        //$output = "";
            if (mysqli_num_rows($selectResult) > 0) {
                echo "Success";
            } else {
                echo "Fail";
            }
        
        
    }
    if ($_POST["action"] == "createGroup") {
        $groupName = $_POST["groupName"];
        $permitted_chars = '0123ghijklmn456ABCDEFGHIJK789abc156defPQRSTU794VowxyzLMNOpqrstuvWXYZ';
        $groupNumber = substr(str_shuffle($permitted_chars), 0, 7);
        //echo $groupNumber;
        $insertGroupQuery = "INSERT into tblGroups(name,number) values ('$groupName','$groupNumber')";
        $resultGroups = mysqli_query($conn, $insertGroupQuery);
        if ($resultGroups) {
            $groupId = mysqli_insert_id($conn);
            $insertUserGroupQuery = "INSERT into tblUserGroups(user_id,group_id,group_number,Status) values ('$userId','$groupId','$groupNumber','owner')";
            $resultUserGroups = mysqli_query($conn, $insertUserGroupQuery);
            if ($resultUserGroups) {
                echo "Group Created";
            }
        } else {
            echo "Problem creatin the group";
        }
    }
    if ($_POST["action"] == "MyGroups") {
        $selectQuery = "SELECT * FROM tblGroups AS grp JOIN tblUserGroups AS usrgrps ON grp.id = usrgrps.group_id AND usrgrps.user_id = '$userId' AND Status = 'owner'";
        //$selectQuery = "SELECT * from tblUsers WHERE user_email != '$email'";
        $selectResult = (mysqli_query($conn, $selectQuery));
        //$output .= "<div class=\"col-11\">";
        $output = "";
        $output .= "
        <br />
        <h3>Groups You Created</h3>
        <table class=\"table table-striped\">
        <thead style=\"background-color:#093c59; color:white\">
        <tr>
        <th>
        Name
        </th>
        <th>
        Number
        </th>
        <th class=\"text-center\"></th>
        </tr>
        </thead>";
        if (mysqli_num_rows($selectResult) > 0) {
            while ($row = mysqli_fetch_assoc($selectResult)) {
                $output .= "<tr>
                <td>" . $row["name"] . "</td>
                <td>" . $row["number"] . "</td>
                <td class=\"text-center\"><button class=\"btn btn-primary\" id=\"editButton\" onclick=\"confirmEditGroup(" . $row["id"] . ")\" data-bs-toggle=\"modal\" data-bs-target=\"#editModal\"><i class=\"fa-solid fa-pen-to-square\"></i></button>&nbsp;
                <button class=\"btn btn-danger\" id=\"btnDelete\" onclick=\"confirmDeleteGroup(" . $row["id"] . ")\" data-bs-toggle=\"modal\" data-bs-target=\"#deleteModal\" ><i class=\"fa-sharp fa-solid fa-trash\"></i></button></td>
                </tr>";
            }
            $output .= " </table>";
        } else {
            $output .= "<tbody>
            <tr>
            <td colspan=\"3\"><h3 style=\"text-align:center\">No Record</h3></td>
            </tr>
            </tbody>
            </table>";
        }
        echo $output;
    }
    if ($_POST["action"] == "JoinedGroups") {
        $selectQuery = "SELECT * FROM tblGroups AS grp JOIN tblUserGroups AS usrgrps ON grp.id = usrgrps.group_id AND usrgrps.user_id = '$userId' AND Status = 'joined'";
        //$selectQuery = "SELECT * from tblUsers WHERE user_email != '$email'";
        $selectResult = (mysqli_query($conn, $selectQuery));
        //$output .= "<div class=\"col-11\">";
        $output = "";
        $output .= "
        <br />
        <h3>Groups You Joined</h3>
        <table class=\"table table-striped\">
        <thead style=\"background-color:#093c59; color:white\">
        <tr>
        <th>
        Name
        </th>
        <th>
        Number
        </th>
        <th class=\"text-center\"></th>
        </tr>
        </thead>";
        if (mysqli_num_rows($selectResult) > 0) {
            while ($row = mysqli_fetch_assoc($selectResult)) {
                $output .= "<tr>
                <td>" . $row["name"] . "</td>
                <td>" . $row["number"] . "</td>
                <td class=\"text-center\"><button class=\"btn btn-danger\" id=\"leaveButton\" onclick=\"confirmLeaveGroup(" . $row["ug_id"] . ")\" data-bs-toggle=\"modal\" data-bs-target=\"#leaveModal\">Leave</button></td>
                </tr>";
            }
            $output .= "</table>";
        } else {
            $output .= "<tbody>
            <tr>
            <td colspan=\"3\"><h3 style=\"text-align:center\">No Record</h3></td>
            </tr>
            </tbody>
            </table>";
        }
        echo $output;
    }
    if ($_POST["action"] == "joinGroup") {
        $groupNumber = $_POST["groupNumber"];
        $selectQuery1 = "SELECT * FROM tblUserGroups WHERE group_number = '$groupNumber'";
        //$selectQuery = "SELECT * from tblUsers WHERE user_email != '$email'";
        $selectResult1 = (mysqli_query($conn, $selectQuery1));

        if (mysqli_num_rows($selectResult1) > 0) {
            //echo "Group Found";
            $selectQuery2 = "SELECT * FROM tblUserGroups WHERE group_number = '$groupNumber' AND user_id = '$userId'";
            $selectResult2 = (mysqli_query($conn, $selectQuery2));
            if (mysqli_num_rows($selectResult2) > 0) {
                echo "You are already in the group";
            } else {
                $selectQuery3 = "SELECT * FROM tblUserGroups WHERE group_number = '$groupNumber' AND user_id != '$userId'";
                $selectResult3 = (mysqli_query($conn, $selectQuery3));
                if (mysqli_num_rows($selectResult3) > 0) {
                    $row = mysqli_fetch_assoc($selectResult3);
                    $groupId = $row["group_id"];
                    $insertjoinGroupQuery = "INSERT into tblUserGroups(user_id,group_id,group_number,Status) 
                    values ('$userId','$groupId','$groupNumber','joined')";
                    $resultGroups = mysqli_query($conn, $insertjoinGroupQuery);
                    if ($resultGroups) {
                        echo "Group joined";
                    } else {
                        mysqli_error($conn);
                    }
                } else {
                    echo "Problem occured";
                }
            }
        } else {
            echo "Group Not Found";
        }
    }
    if ($_POST["action"] == "confirmDeleteGroup") {
        $groupId = $_POST["id"];
        $output = "";
        $selectGroupQuery = "SELECT * FROM tblGroups WHERE id = '$groupId'";
        //$selectQuery = "SELECT * from tblUsers WHERE user_email != '$email'";
        $selectGroupResult = (mysqli_query($conn, $selectGroupQuery));
        if (mysqli_num_rows($selectGroupResult) > 0) {
            $row = mysqli_fetch_assoc($selectGroupResult);
            echo "
            <div class=\"text-center\">
            <label>Are you sure you want to delete <strong class=\"display-8\">" . $row["name"] . "</strong></label>
            </div>
            <div class=\"modal-footer\">
            <button type=\"button\" onclick=\"deleteGroup($groupId)\" class=\"btn btn-danger btn-block w-25\" data-bs-dismiss=\"modal\" >
            <i class=\"fa-solid fa-check\"></i>
                    </button>
                    <button type=\"button\" class=\"btn btn-success btn-block w-25\" data-bs-dismiss=\"modal\">
                    <i class=\"fa-solid fa-xmark\"></i>
                    </button>

                </div>
            ";
            //echo "<p>Group Found: $groupId</p>";
        } else {
            echo "Group Not Found";
        }
    }
    if ($_POST["action"] == "confirmLeaveGroup") {
        $groupId = $_POST["id"];
        $output = "";
        $selectGroupQuery = "SELECT * FROM tblGroups AS grp JOIN tblUserGroups AS usrgrps ON usrgrps.ug_id = '$groupId' AND grp.id = usrgrps.group_id;";
        //$selectQuery = "SELECT * from tblUsers WHERE user_email != '$email'";
        $selectGroupResult = (mysqli_query($conn, $selectGroupQuery));
        if (mysqli_num_rows($selectGroupResult) > 0) {
            $row = mysqli_fetch_assoc($selectGroupResult);
            echo "
            <div class=\"text-center\">
            <label>Are you sure you want to leave <strong class=\"display-8\">" . $row["name"] . "?</strong></label>
            </div>
            <div class=\"modal-footer\">
            <button type=\"button\" onclick=\"leaveGroup($groupId)\" class=\"btn btn-danger btn-block w-25\" data-bs-dismiss=\"modal\" >
            <i class=\"fa-solid fa-check\"></i>
                    </button>
                    <button type=\"button\" class=\"btn btn-success btn-block w-25\" data-bs-dismiss=\"modal\">
                    <i class=\"fa-solid fa-xmark\"></i>
                    </button>

                </div>
            ";
            //echo "<p>Group Found: $groupId</p>";
        } else {
            echo "Group Not Found";
        }
    }
    if ($_POST["action"] == "deleteGroup") {
        $groupId = $_POST["id"];
        $output = "";
        $deleteGroupQuery = "DELETE FROM tblGroups WHERE id = '$groupId'";
        $deleteGroupResult = (mysqli_query($conn, $deleteGroupQuery));
        if($deleteGroupResult){
            echo "Group Deleted Successfully";
        }
        else{
            echo "Problem in deleting group";
        }
        //$selectQuery = "SELECT * from tblUsers WHERE user_email != '$email'";

        //echo "<p>Group Found: $groupId</p>";
        //echo "$groupId";
    }
    if ($_POST["action"] == "leaveGroup") {
        $groupId = $_POST["id"];
        $output = "";
        $leaveGroupQuery = "DELETE FROM tblUserGroups WHERE ug_id = '$groupId'";
        $leaveGroupResult = (mysqli_query($conn, $leaveGroupQuery));
        //$selectQuery = "SELECT * from tblUsers WHERE user_email != '$email'";

        if ($leaveGroupResult) {
            echo "Group Left";
        } else {
            echo "problem in leaving group";
        }
        //echo "<p>Group Found: $groupId</p>";
        //echo "$groupId";
    }
    if ($_POST["action"] == "confirmEditGroup") {
        $groupId = $_POST["id"];
        $output = "";
        $selectGroupQuery = "SELECT * FROM tblGroups WHERE id = '$groupId'";
        //$selectQuery = "SELECT * from tblUsers WHERE user_email != '$email'";
        $selectGroupResult = (mysqli_query($conn, $selectGroupQuery));
        if (mysqli_num_rows($selectGroupResult) > 0) {
            $row = mysqli_fetch_assoc($selectGroupResult);
            echo "
            <div>
            <strong><label>Group Name</label></strong>
            <input id=\"txtGrpName\" class=\"form-control\" value=\"" . $row["name"] . "\" />
            </div>
            <div class=\"modal-footer\">
            <button type=\"button\" onclick=\"editGroup($groupId)\" class=\"btn btn-success w-25\" data-bs-dismiss=\"modal\" >
            <i class=\"fa-solid fa-check\"></i>
                    </button>
                    <button type=\"button\" class=\"btn btn-danger w-25\" data-bs-dismiss=\"modal\">
                    <i class=\"fa-solid fa-xmark\"></i>
                    </button>

                </div>
            ";
            //echo "<p>Group Found: $groupId</p>";
        } else {
            echo "Group Not Found";
        }
    }
    
    if ($_POST["action"] == "confirmAdminEditGroup") {
        $groupId = $_POST["id"];
        $output = "";
        $selectGroupQuery = "SELECT * FROM tblGroups WHERE id = '$groupId'";
        //$selectQuery = "SELECT * from tblUsers WHERE user_email != '$email'";
        $selectGroupResult = (mysqli_query($conn, $selectGroupQuery));
        if (mysqli_num_rows($selectGroupResult) > 0) {
            $row = mysqli_fetch_assoc($selectGroupResult);
            echo "
            <div>
            <strong><label>Group Name</label></strong>
            <input id=\"txtGrpName\" class=\"form-control\" value=\"" . $row["name"] . "\" />
            </div>
            <div class=\"modal-footer\">
            <button type=\"button\" onclick=\"editAdminGroup($groupId)\" class=\"btn btn-success w-25\" data-bs-dismiss=\"modal\" >
            <i class=\"fa-solid fa-check\"></i>
                    </button>
                    <button type=\"button\" class=\"btn btn-danger w-25\" data-bs-dismiss=\"modal\">
                    <i class=\"fa-solid fa-xmark\"></i>
                    </button>

                </div>
            ";
            //echo "<p>Group Found: $groupId</p>";
        } else {
            echo "Group Not Found";
        }
    }
    if ($_POST["action"] == "editGroup") {
        $groupId = $_POST["id"];
        $groupName = $_POST["groupName"];
        $output = "";
        $updateGroupQuery = "UPDATE tblGroups SET name ='$groupName' WHERE id='$groupId'";
        //$selectQuery = "SELECT * from tblUsers WHERE user_email != '$email'";
        $updateGroupResult = (mysqli_query($conn, $updateGroupQuery));
        if ($updateGroupResult) {
            echo "Group Updated";
        }
    }
}