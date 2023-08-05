<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("location:signin.php");
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="bootstrap5/css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/styleFile.css" type="text/css">
        <link rel="stylesheet" href="bootstrap5/bootstrap-icons-1.10.2/bootstrap-icons.css" type="text/css">
        <script src="jquery/jquery-3.6.1.min.js" type="text/javascript"></script>
        <script src="bootstrap5/js/bootstrap.min.js" type="text/javascript"></script>
        <link href="fontawesome-free-6.2.1-web/css/fontawesome.css" rel="stylesheet">
        <link href="fontawesome-free-6.2.1-web/css/brands.css" rel="stylesheet">
        <link href="fontawesome-free-6.2.1-web/css/solid.css" rel="stylesheet">
        <title>Document</title>

        <script>
            function loadGroups() {
                var action = "MyGroups";
                $.ajax({
                    url: "groupCrud.php",
                    method: "POST",
                    data: {
                        action: action
                    },
                    success: function (data) {
                        $("#groupDiv").html(data);
                    }
                })
            }
            function loadAdminGroups() {
                    var action = "adminAllGroups";
                    $.ajax({
                        url: "groupCrud.php",
                        method: "POST",
                        data: {
                            action: action
                        },
                        success: function (data) {
                            $("#adminGroupDiv").html(data);
                        }
                    })
                }
            function submitValue() {
                //alert($('#groups').val());
                var action = $('#groups').val();
                //var action = "filterGroups";
                $.ajax({
                    url: "groupCrud.php",
                    method: "POST",
                    data: {
                        action: action
                    },
                    success: function (data) {
                        $("#groupDiv").html(data);
                    }
                })
            }
            function showMembers(id){
                var action = "showMembers";
                $.ajax({
                    url: "groupCrud.php",
                    method: "POST",
                    data: {
                        id:id,
                        action: action
                    },
                    success: function (data) {
                        $("#adminMembersGroupDiv").html(data);
                    }
                })
                //alert("members");
            }
            function confirmDeleteGroup(id) {
                var action = "confirmDeleteGroup";
                $.ajax({
                    url: "groupCrud.php",
                    method: "POST",
                    data: {
                        action: action,
                        id: id
                    },
                    success: function (data) {
                        $("#deleteGroupDiv").html(data);
                        $("#adminDeleteGroupDiv").html(data);
                        
                    }
                })
                //alert("Delete Button pressed for id: " + id);

            }

            function confirmLeaveGroup(id) {
                var action = "confirmLeaveGroup";
                $.ajax({
                    url: "groupCrud.php",
                    method: "POST",
                    data: {
                        action: action,
                        id: id
                    },
                    success: function (data) {
                        $("#leaveGroupDiv").html(data);
                    }
                })
                //alert("Leave Button pressed for id: " + id);

            }

            function deleteGroup(id) {
                var action = "deleteGroup";
                $.ajax({
                    url: "groupCrud.php",
                    method: "POST",
                    data: {
                        action: action,
                        id: id
                    },
                    success: function (data) {
                        //alert(data);
                        loadGroups();
                        loadAdminGroups();
                        if (data.indexOf('Successfully') > -1) {
                            loadGroups();
                            loadAdminGroups();
                            $("#feedback").removeClass().addClass('noticeui noticeui-success').html('Group Deleted').show().css({
                                'padding': '4px',
                                'width': 'auto',
                                'text-align': 'center',
                                'display': 'inline-block'
                            });
                            setTimeout(function () {
                                $('#feedback').fadeOut('fast');
                            }, 2000);

                        } else {
                            $("#feedback").removeClass().addClass('noticeui noticeui-error').html('Problem Deleting Group').show().css({
                                'padding': '4px',
                                'width': 'auto',
                                'text-align': 'center',
                                'display': 'inline-block'
                            });
                            setTimeout(function () {
                                $('#feedback').fadeOut('fast');
                            }, 2000);
                        }
                    }
                })
                //alert("OK pressed: " + id);
            }

            function leaveGroup(id) {
                var action = "leaveGroup";
                //alert("leave id" + id);
                $.ajax({
                    url: "groupCrud.php",
                    method: "POST",
                    data: {
                        action: action,
                        id: id
                    },
                    success: function (data) {
                        //alert(data);

                        if (data.indexOf('Left') > -1) {
                            loadGroups();
                            submitValue();
                            $("#feedback").removeClass().addClass('noticeui noticeui-success').html('Group Left Successfully').show().css({
                                'padding': '4px',
                                'width': 'auto',
                                'text-align': 'center',
                                'display': 'inline-block'
                            });
                            setTimeout(function () {
                                $('#feedback').fadeOut('fast');
                            }, 2000);
                        } else {
                            $("#feedback").removeClass().addClass('noticeui noticeui-success').html('Problem in leaving the group').show().css({
                                'padding': '4px',
                                'width': 'auto',
                                'text-align': 'center',
                                'display': 'inline-block'
                            });
                            setTimeout(function () {
                                $('#feedback').fadeOut('fast');
                            }, 2000);
                        }
                    }
                })
                //alert("OK pressed: " + id);
            }


            function confirmEditGroup(id) {
                var action = "confirmEditGroup";
                //alert("id: " + id);
                $.ajax({
                    url: "groupCrud.php",
                    method: "POST",
                    data: {
                        action: action,
                        id: id
                    },
                    success: function (data) {
                        $("#editGroupDiv").html(data);
                        $("#adminEditGroupDiv").html(data);
                    }
                })
                //alert("Edit the group");
            }
            function confirmAdminEditGroup(id) {
                var action = "confirmAdminEditGroup";
                //alert("id: " + id);
                $.ajax({
                    url: "groupCrud.php",
                    method: "POST",
                    data: {
                        action: action,
                        id: id
                    },
                    success: function (data) {
                        //alert(data);
                        $("#adminEditGroupDiv").html(data);
                    }
                })
                //alert("Edit the group");
            }

            function editGroup(id) {
                var action = "editGroup";
                let groupName = $('#txtGrpName').val();
                //alert("name: " + $('#txtGrpName').val());
                $.ajax({
                    url: "groupCrud.php",
                    method: "POST",
                    data: {
                        action: action,
                        id: id,
                        groupName: groupName
                    },
                    success: function (data) {

                        if (data.indexOf('Updated') > -1) {
                            loadGroups();
                            loadAdminGroups();
                            $("#feedback").removeClass().addClass('noticeui noticeui-success').html('Group Updated').show().css({
                                'padding': '4px',
                                'width': 'auto',
                                'text-align': 'center',
                                'display': 'inline-block'
                            });
                            setTimeout(function () {
                                $('#feedback').fadeOut('fast');
                            }, 2000);

                        } else {
                            $("#feedback").removeClass().addClass('noticeui noticeui-error').html('Problem Updating Group').show().css({
                                'padding': '4px',
                                'width': 'auto',
                                'text-align': 'center',
                                'display': 'inline-block'
                            });
                            setTimeout(function () {
                                $('#feedback').fadeOut('fast');
                            }, 2000);
                        }
                        //$("#editGroupDiv").html(data);
                    }
                })
                //alert("Edit the group");
            }
            function editAdminGroup(id) {
                var action = "editGroup";
                let groupName = $('#txtGrpName').val();
                //alert("name: " + $('#txtGrpName').val());
                $.ajax({
                    url: "groupCrud.php",
                    method: "POST",
                    data: {
                        action: action,
                        id: id,
                        groupName: groupName
                    },
                    success: function (data) {

                        if (data.indexOf('Updated') > -1) {
                            loadAdminGroups();
                            $("#feedback").removeClass().addClass('noticeui noticeui-success').html('Group Updated').show().css({
                                'padding': '4px',
                                'width': 'auto',
                                'text-align': 'center',
                                'display': 'inline-block'
                            });
                            setTimeout(function () {
                                $('#feedback').fadeOut('fast');
                            }, 2000);

                        } else {
                            $("#feedback").removeClass().addClass('noticeui noticeui-error').html('Problem Updating Group').show().css({
                                'padding': '4px',
                                'width': 'auto',
                                'text-align': 'center',
                                'display': 'inline-block'
                            });
                            setTimeout(function () {
                                $('#feedback').fadeOut('fast');
                            }, 2000);
                        }
                        //$("#editGroupDiv").html(data);
                    }
                })
                //alert("Edit the group");
            }
            $(document).ready(function () {
                loadGroups();
                loadAdminGroups();
                function loadAdminGroups() {
                    var action = "adminAllGroups";
                    $.ajax({
                        url: "groupCrud.php",
                        method: "POST",
                        data: {
                            action: action
                        },
                        success: function (data) {
                            $("#adminGroupDiv").html(data);
                        }
                    })
                }
                function loadGroups() {
                    var action = "MyGroups";
                    $.ajax({
                        url: "groupCrud.php",
                        method: "POST",
                        data: {
                            action: action
                        },
                        success: function (data) {
                            $("#groupDiv").html(data);
                        }
                    })
                }


                $('#createGroupButton').click(function () {
                    if ($('#groupName').val() == "") {
                        $("#feedback").removeClass().addClass('noticeui noticeui-error').html('Please Enter Group Name').show().css({
                                        'padding': '4px',
                                        'width': 'auto',
                                        'text-align': 'center',
                                        'display': 'inline-block'
                                    });
                                    setTimeout(function () {
                                        $('#feedback').fadeOut('slow');
                                    }, 2000);
                                    $('#groupName').focus();
                        //alert("No group name");
                    } else {
                        let groupName = $('#groupName').val();
                        var action = "createGroup";
                        $.ajax({
                            url: "groupCrud.php",
                            method: "POST",
                            data: {
                                action: action,
                                groupName: groupName
                            },
                            success: function (data) {
                                // $("#feedbackDiv").html(data);


                                if (data.indexOf("Created") > -1) {
                                    loadGroups();
                                    $('#groupName').val('');
                                    $("#feedback").removeClass().addClass('noticeui noticeui-success').html('Group Created').show().css({
                                        'padding': '4px',
                                        'width': 'auto',
                                        'text-align': 'center',
                                        'display': 'inline-block'
                                    });
                                    setTimeout(function () {
                                        $('#feedback').fadeOut('slow');
                                    }, 3000);
                                } else {
                                    $("#feedback").removeClass().addClass('noticeui noticeui-error').html('Problem Creating the Group').show().css({
                                        'padding': '4px',
                                        'width': 'auto',
                                        'text-align': 'center',
                                        'display': 'inline-block'
                                    });
                                    setTimeout(function () {
                                        $('#feedback').fadeOut('slow');
                                    }, 3000);
                                }
                                $('#groupName').focus();
                            }
                        })
                    }


                })
                $('#joinGroupButton').click(function () {
                    if ($('#joinGroupNumber').val() == "") {
                        //alert("Please Enter Group Number");
                        $("#feedback").removeClass().addClass('noticeui noticeui-error')
                        .html('Please Enter Group Number').show().css({
                                        'padding': '4px',
                                        'width': 'auto',
                                        'text-align': 'center',
                                        'display': 'inline-block'
                                    });
                                    setTimeout(function () {
                                        $('#feedback').fadeOut('slow');
                                    }, 2000);
                                    $('#joinGroupNumber').focus();
                    } else {
                        let groupNumber = $('#joinGroupNumber').val();
                        var action = "joinGroup";
                        $.ajax({
                            url: "groupCrud.php",
                            method: "POST",
                            data: {
                                action: action,
                                groupNumber: groupNumber
                            },
                            success: function (data) {
                                submitValue();
                                //alert(data);
                                if (data.indexOf("already") > -1) {
                                    $("#feedback").removeClass().addClass('noticeui noticeui-warn')
                                    .html('You are already in the group').show().css({
                                        'padding': '4px',
                                        'width': 'auto',
                                        'text-align': 'center',
                                        'display': 'inline-block'
                                    });
                                    setTimeout(function () {
                                        $('#feedback').fadeOut('fast');
                                    }, 3000);
                                } else if (data.indexOf('joined') > -1) {
                                    $("#feedback").removeClass().addClass('noticeui noticeui-success')
                                    .html('Group Joined Successfully').show().css({
                                        'padding': '4px',
                                        'width': 'auto',
                                        'text-align': 'center',
                                        'display': 'inline-block'
                                    });
                                    setTimeout(function () {
                                        $('#feedback').fadeOut('fast');
                                    }, 3000);
                                } else if (data.indexOf('Found') > -1) {
                                    $("#feedback").removeClass().addClass('noticeui noticeui-error')
                                    .html('Group Not Found').show().css({
                                        'padding': '4px',
                                        'width': 'auto',
                                        'text-align': 'center',
                                        'display': 'inline-block'
                                    });
                                    setTimeout(function () {
                                        $('#feedback').fadeOut('fast');
                                    }, 3000);
                                } else {
                                    $("#feedback").removeClass().addClass('noticeui noticeui-error')
                                    .html('Problem finding the Group').show().css({
                                        'padding': '4px',
                                        'width': 'auto',
                                        'text-align': 'center',
                                        'display': 'inline-block'
                                    });
                                    setTimeout(function () {
                                        $('#feedback').fadeOut('fast');
                                    }, 3000);
                                }
                                //loadGroups();
                                $('#joinGroupNumber').focus();
                            }
                        })
                    }


                })
                $('#btnDelete').click(function () {
                    //alert("Delet button");
                });
            })
        </script>
    </head>

    <body>
        <div id="nav-placeholder3">
            <?php
            include "navbar.php";
            ?>

        </div>
        <?php
if($_SESSION["role"]=="admin"){
?>
<div class="container">
    <div class="row">
        <div id="feedbackDiv">
            <div id="feedback">

            </div>
        </div>
        <div id="adminGroupDiv">

        </div>
    </div>
</div>
<div class="modal fade" id="adminEditModal" tabindex="-1" aria-labelledby="adminEditModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-primary" id="adminEditModalLabel">Edit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div id="adminEditGroupDiv" class="modal-body">
                        <!-- The loop of meeting minutes -->

                    </div>

                </div>
            </div>
        </div>
        <div class="modal fade" id="adminDeleteModal" tabindex="-1" aria-labelledby="adminDeleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger" id="adminDeleteModalLabel">Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div id="adminDeleteGroupDiv" class="modal-body">
                        <!-- The loop of meeting minutes -->
                    </div>

                </div>
            </div>
        </div>
        <div class="modal fade" id="adminMembersModal" tabindex="-1" aria-labelledby="adminMembersModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="adminMembersModalLabel">Members</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div id="adminMembersGroupDiv" class="modal-body">
                        <!-- The loop of meeting minutes -->
                    </div>

                </div>
            </div>
        </div>

<?php
}else{
    ?>
<div class="container">
            <div class="row">
                <div id="feedbackDiv">
                    <div id="feedback"></div>
                </div>

                <div class="col-12 col-sm-6 mb-3">
                    <h4>Create Group</h4>
                    <input class="form-control " id="groupName" placeholder="Enter Group name" />
                    <button class="btn mt-1 w-25 buttonStyle" id="createGroupButton"><strong>Create</strong></button>
                </div>
                <div class="col-12 col-sm-6">
                    <h4>Join Group</h4>
                    <input class="form-control" id="joinGroupNumber" placeholder="Enter Group Number" />

                    <button class="btn mt-1 w-25 border-1 buttonStyle"
                        id="joinGroupButton"><strong>Join</strong></button>
                </div>
                <div>
                    <hr />
                    <h2>Select Group</h2>
                    <select onchange="submitValue()" class="form-control form-control-static" name="groups" id="groups">
                        <option value="MyGroups">My Groups</option>
                        <option value="JoinedGroups">Joined Groups</option>
                    </select>
                </div>

                <div id="groupDiv">

                </div>
            </div>
        </div>
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger" id="deleteModalLabel">Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div id="deleteGroupDiv" class="modal-body">
                        <!-- The loop of meeting minutes -->
                    </div>

                </div>
            </div>
        </div>
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-primary" id="editModalLabel">Edit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div id="editGroupDiv" class="modal-body">
                        <!-- The loop of meeting minutes -->

                    </div>

                </div>
            </div>
        </div>
        
        
        <div class="modal fade" id="leaveModal" tabindex="-1" aria-labelledby="leaveModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-primary" id="leaveModalLabel">Leave</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div id="leaveGroupDiv" class="modal-body">
                        <!-- The loop of meeting minutes -->

                    </div>

                </div>
            </div>
        </div>

    <?php
}
        ?>
        


    </body>

</html>