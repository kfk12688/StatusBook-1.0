<?php
include "conn.php";
session_start();
$regno=$_SESSION['regno'];
$result=mysql_query("select * from student where regno='$regno'")or die(mysql_error);
$row=mysql_fetch_array($result);
$fname=$row['fname'];
$lname=$row['lname'];
$email=$row['email'];
$pic=$regno.".jpg";
$result1=mysql_query("select * from subject_schedule")or die(mysql_error);
$row1=mysql_fetch_array($result1);
$description=$row1['description'];
if (isset($_POST['submit333'])) 
{
$title=$_POST['title'];
$titlecontent=$_POST['titlecontent'];   
mysql_query("update subject_schedule set title='$title' where regno='$regno'");
mysql_query("update subject_schedule set titlecontent='$titlecontent' where regno='$regno'");
header("location:subject schedules.php");
}
?>
<html class="st-layout ls-top-navbar ls-bottom-footer show-sidebar sidebar-l2" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Status Book</title>
    <link rel="stylesheet" type="text/css" href="dialog/css/normalize.css" />
        <link rel="stylesheet" type="text/css" href="dialog/css/demo.css" />
        <link rel="stylesheet" type="text/css" href="dialog/css/dialog.css" />
        <link rel="stylesheet" type="text/css" href="dialog/css/dialog-val.css" />
        <script src="dialog/js/modernizr.custom.js"></script>
    <link href="sathish/css/vendor.css" rel="stylesheet">
    <link href="sathish/css/theme-core.css" rel="stylesheet">
    <link href="sathish/css/module-essentials.css" rel="stylesheet" />
    <link href="sathish/css/module-layout.css" rel="stylesheet" />
    <link href="sathish/css/module-sidebar.css" rel="stylesheet" />
    <link href="sathish/css/module-sidebar-skins.css" rel="stylesheet" />
    <link href="sathish/css/module-navbar.css" rel="stylesheet" />
     <link href="sathish/css/module-charts.css" rel="stylesheet" />
    <link href="sathish/css/module-cover.css" rel="stylesheet" />
    <link href="sathish/css/module-timeline.css" rel="stylesheet" />
   <link href="sathish/css/module-media.css" rel="stylesheet" /> 
    <script src="jquery-2.1.3.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $("#FormSubmit").click(function (e) {
            e.preventDefault();
            if($("#contentText").val()==='')
            {
                alert("Please enter some text!");
                return false;
            }
            $("#FormSubmit").hide(); 
            $("#LoadingImage").show(); 
            var myData = 'content_txt='+ $("#contentText").val(); 
            jQuery.ajax({
            type: "POST", 
            url: "appoinments/response.php", 
            dataType:"text", 
            data:myData, 
            success:function(response){
                $("#responds").append(response);
                $("#contentText").val(''); 
                $("#FormSubmit").show(); 
                $("#LoadingImage").hide();
            },
            error:function (xhr, ajaxOptions, thrownError){
                $("#FormSubmit").show(); 
                $("#LoadingImage").hide();
                alert(thrownError);
            }
            });
    })
    $("body").on("click", "#responds .del_button", function(e) {
         e.preventDefault();
         var clickedID = this.id.split('-'); 
         var DbNumberID = clickedID[1]; 
         var myData = 'recordToDelete='+ DbNumberID; 
        $('#item_'+DbNumberID).addClass( "sel" ); 
        $(this).hide(); 
            jQuery.ajax({
            type: "POST", 
            url: "appoinments/response.php", 
            dataType:"text", 
            data:myData, 
            success:function(response){
                                $('#item_'+DbNumberID).fadeOut();
            },
            error:function (xhr, ajaxOptions, thrownError){
                                alert(thrownError);
            }
            });
    });

});
</script>
<link href="appoinments/css/style.css" rel="stylesheet" type="text/css" />
    </head>
<?php
    if (isset($_SESSION['regno']))
    {
    echo"<body>";
     }
else{
    header('location:../index.html');
}
?>
       <div class="st-container">
         <div class="navbar navbar-main navbar-default navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="#sidebar-menu" data-effect="st-effect-1" data-toggle="sidebar-menu" class="toggle pull-left visible-xs"><i class="fa fa-bars"></i></a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-nav">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="#sidebar-chat" data-toggle="sidebar-menu" data-effect="st-effect-1" class="toggle pull-right visible-xs"><i class="fa fa-comments"></i></a>
                    <a class="navbar-brand navbar-brand-primary hidden-xs" href="index.html">Status Book</a>
                </div>
                <div class="collapse navbar-collapse" id="main-nav">
                    <ul class="nav navbar-nav navbar-user">
                         <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="cropimages/uploads/<?php echo $pic?>" width="35" alt="Bill" class="img-circle" /> <?php echo $fname; ?> <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="messages.php">Messages</a>
                                </li>
                                <li><a href="logout.php">Logout</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <form class="navbar-form margin-none navbar-left hidden-xs">
                          <div class="search-1">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icon-search"></i></span>
                                <input type="text" class="form-control" placeholder="Search">
                            </div>
                        </div>
                        </form>
                </div>
            </div>
        </div>
         <div class="sidebar left sidebar-size-2 sidebar-offset-0 sidebar-visible-desktop sidebar-visible-mobile sidebar-skin-dark" id="sidebar-menu" data-type="collapse">
            <div data-scrollable>
                <ul class="sidebar-menu">
                    <li><a href="timeline.php"><i class="md md-assignment"></i> <span>Home</span></a>
                    </li>
                    <li class="category">Categories</li>
                    <li class="hasSubmenu">
                        <a href="#timeline"><i class="icon-ship-wheel"></i> <span>Members</span></a>
                        <ul id="timeline">
                            <li><a href="#" data-dialog="somedialog" ><i class="fa fa-circle-o"></i> <span>Add a Member</span></a>
                            </li>
                            <li><a href="datatable/index.php" ><i class="fa fa-circle-o"></i> <span>Existing Members</span></a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="#"><i class="md md-event-available"></i> <span>Sponsorship Details</span></a>
                    </li>
                    <li class=""><a href="subject schedules.php"><i class="md md-my-library-books"></i> <span>Activity Schedules</span></a>
                    </li>
                      <li class=""><a href="completed task.php"><i class="md md-verified-user"></i> <span>Completed Activites</span></a>
                    </li>             
                </ul>
                <h4 class="category">Status From</h4>
                <div class="sidebar-block">
                    <ul>
                        <li><a href="www.angelindia.com" class="sidebar-link"><span class="fa fa-fw fa-circle-o text-success"></span> Angel Wall</a>
                        </li>
                        <li><a href="angel club.php" class="sidebar-link"><span class="fa fa-fw fa-circle-o text-danger"></span>Angel Clubs</a>
                        </li>
                        <li><a href="sports club.php" class="sidebar-link"><span class="fa fa-fw fa-circle-o text-info"></span>Sports Clubs</a>
                        </li>
                        <li><a href="plcement.php" class="sidebar-link"><span class="fa fa-fw fa-circle-o text-primary"></span>Placement Cell</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
            <div class="st-pusher" id="content">
             <div class="st-content">
                  <div class="st-content-inner">
            <div class="container-fluid">
                  <h1>Activity Schedules</h1>
                      <h4 class="page-section-heading"></h4>
                      <div class="col-md-8 col-lg-9">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <form class="form-horizontal" method="POST" action="">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Topic</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="inputEmail3" placeholder="Title" name="title" >
                                                    </div>
                                                </div>
                                                 <div class="form-group">
                                                    <label class="col-sm-3 control-label">Content</label>
                                                    <div class="col-sm-9">
                                                        <textarea class="form-control" rows="15" name="titlecontent" ></textarea>
                                                    </div>
                                                </div>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <input type="submit" class="btn btn-primary" value="Submit" name="submit333">
                                            </form></div>
                                </div>
                            </div>
                           
                                

    
                                <!-- /panel-->
                            </div>
                            <!-- // END col -->
                        </div>
                <div id="somedialog" class="dialog">
                    <div class="dialog__overlay"></div>
                    <div class="dialog__content">
                        <h3 style="color:#25ad9f" >Select Your Needs</h3>
                        <form class="form-horizontal" action="table.php" method="post">
                                                <div class="form-group">
                                                    <label class="col-sm-12 control-label">Select The Department</label>
                                                    
                        <select name="dept"  class="selectpicker" data-style="btn-white" data-live-search="true" data-size="5">                                                  
                                                            <option>CSE</option>
                                                            <option>ECE</option>
                                                            <option>EEE</option>
                                                            <option>MECH</option>
                                                            <option>IT</option>
                                                            <option>FT</option>
                                                        </select>
                                                    </div>
                                                
                                                    <div class="form-group">
                                                    <label class="col-sm-12 control-label">Select The Batch</label>
                                                    
                        <select name="batch"  class="selectpicker" data-style="btn-white" data-live-search="true" data-size="5">                                                  
                                                            <option>2011-2015</option>
                                                            <option>2012-2016</option>
                                                            <option>2013-2017</option>
                                                            <option>2014-2018</option>                                                          
                                                        </select>
                                                    </div>  
                                                    <div class="form-group">

                                                    <label class="col-sm-12 control-label">Reg No</label>
                                                     <div class="col-sm-12">
                                                        <input type="text" class="form-control" name="regno1" placeholder="Type Here">
                                                    </div>
                                                </div>                                           
                                                                                              
                                                <button type="submit" class="btn btn-primary" name="submit1">Create New</button>                                                                          
                                            <div class="btn btn-primary" class="action" data-dialog-close>Close</div>
     
     </form>
     </div>
                    </div>
                </div>
                <div id="somedialog77" class="dialog">
                    <div class="dialog__overlay"></div>
                    <div class="dialog__content">
                        <h3 style="color:#25ad9f" >Enter The Required Field</h3>
                        <form class="form-horizontal" action="">
                                                
                                                <div class="form-group">
                                                    <label class="col-sm-12 control-label">Select The Department</label>
                                                    
                        <select name="select" class="selectpicker" data-style="btn-white" data-live-search="true" data-size="5">                                                  
                                                            <option>CSE</option>
                                                            <option>ECE</option>
                                                            <option>EEE</option>
                                                            <option>MECH</option>
                                                            <option>IT</option>
                                                            <option>FT</option>
                                                        </select>
                                                    </div> 
                                                <div class="form-group">

                                                    <label class="col-sm-12 control-label">Select The Batch</label>
                                                    
                        <select name="select" class="selectpicker" data-style="btn-white" data-live-search="true" data-size="5">                                                  
                                                            <option>2011-2015</option>
                                                            <option>2012-2016</option>
                                                            <option>2013-2017</option>
                                                            <option>2014-2018</option>                                                          
                                                        </select>
                                                    </div>       
                                                <a href="datatable/index2.php" class="btn btn-primary">Submit</a>                   <div class="btn btn-primary" class="action" data-dialog-close>Close</div>
     
     </form>
                    </div>
                </div>
                 <div id="somedialog1" class="dialog">
                    <div class="dialog__overlay"></div>
                    <div class="dialog__content">
                                    <h3 style="color:#25ad9f" >Enter The Required Field</h3>
                        <form class="form-horizontal" action="table2.php" method="POST">
                            <div class="form-group">
                                                    <label class="col-sm-12 control-label">Select The Department</label>
                                                    
                        <select name="dept"  class="selectpicker" data-style="btn-white" data-live-search="true" data-size="5">                                                  
                                                            <option>CSE</option>
                                                            <option>ECE</option>
                                                            <option>EEE</option>
                                                            <option>MECH</option>
                                                            <option>IT</option>
                                                            <option>FT</option>
                                                        </select>
                                                    </div>
                                                
                                                    <div class="form-group">
                                                    <label class="col-sm-12 control-label">Select The Batch</label>
                                                    
                        <select name="batch"  class="selectpicker" data-style="btn-white" data-live-search="true" data-size="5">                                                  
                                                            <option>2011-2015</option>
                                                            <option>2012-2016</option>
                                                            <option>2013-2017</option>
                                                            <option>2014-2018</option>                                                          
                                                        </select>
                                                    </div>  
                                                <div class="form-group">
                                                    <label class="col-sm-12 control-label">Subject Code</label>
                                                     <div class="col-sm-12">
                                                        <input type="text" class="form-control" placeholder="Type Here" name="subject">
                                                    </div>
                                                </div>

                                                <button type="submit" class="btn btn-primary">Search</button>                   <div class="btn btn-primary" class="action" data-dialog-close>Close</div>
     
     </form>
                    </div>
                </div>
                <div id="somedialog2" class="dialog">
                    <div class="dialog__overlay"></div>
                    <div class="dialog__content">
                         <h3 style="color:#25ad9f" >Enter The Required Field</h3>
                        <form class="form-horizontal" action="">
                                                <div class="form-group">

                                                    <label class="col-sm-12 control-label">Subject Code</label>
                                                     <div class="col-sm-12">
                                                        <input type="text" class="form-control" placeholder="Type Here">
                                                    </div>
                                                </div> 
                                                <div class="form-group">
                                                    <label class="col-sm-12 control-label">Select The Department</label>
                                                    
                        <select name="select" class="selectpicker" data-style="btn-white" data-live-search="true" data-size="5">                                                  
                                                            <option>CSE</option>
                                                            <option>ECE</option>
                                                            <option>EEE</option>
                                                            <option>MECH</option>
                                                            <option>IT</option>
                                                            <option>FT</option>
                                                        </select>
                                                    </div> 
                                                <div class="form-group">
                                                    <label class="col-sm-12 control-label">Select The Batch</label>
                                                    
                        <select name="select" class="selectpicker" data-style="btn-white" data-live-search="true" data-size="5">                                                  
                                                            <option>2011-2015</option>
                                                            <option>2012-2016</option>
                                                            <option>2013-2017</option>
                                                            <option>2014-2018</option>                                                          
                                                        </select>
                                                    </div>       
                                                <button type="submit" class="btn btn-primary">View</button>                    <div class="btn btn-primary" class="action" data-dialog-close>Close</div>
     
     </form>
                    </div>
                </div>
                <div id="somedialog3" class="dialog">
                    <div class="dialog__overlay"></div>
                    <div class="dialog__content">
                         <h3 style="color:#25ad9f" >Enter The Required Field</h3>
                        <form class="form-horizontal" action="">
                                                <div class="form-group">
                                                    <label class="col-sm-12 control-label">Subject Code</label>
                                                     <div class="col-sm-12">
                                                        <input type="text" class="form-control" placeholder="Type Here">
                                                    </div>
                                                </div> 
                                                <div class="form-group">
                                                    <label class="col-sm-12 control-label">Select The Department</label>
                                                    
                        <select name="select" class="selectpicker" data-style="btn-white" data-live-search="true" data-size="5">                                                  
                                                            <option>CSE</option>
                                                            <option>ECE</option>
                                                            <option>EEE</option>
                                                            <option>MECH</option>
                                                            <option>IT</option>
                                                            <option>FT</option>
                                                        </select>
                                                    </div> 
                                                    <div class="form-group">
                                                    <label class="col-sm-12 control-label">Select The Batch</label>
                                                    
                        <select name="select" class="selectpicker" data-style="btn-white" data-live-search="true" data-size="5">                                                  
                                                            <option>2011-2015</option>
                                                            <option>2012-2016</option>
                                                            <option>2013-2017</option>
                                                            <option>2014-2018</option>                                                          
                                                        </select>
                                                    </div> 
                                                <a href="subject schedules.php" class="btn btn-primary">Add/View</a>                     <div class="btn btn-primary" class="action" data-dialog-close>Close</div>
     
     </form>
                    </div>
                </div>
                <div id="somedialog4" class="dialog">
                    <div class="dialog__overlay"></div>
                    <div class="dialog__content">
                        <h3 style="color:#25ad9f" >Enter The Required Field</h3>
                        <form class="form-horizontal" action="">
                                                
                                                <div class="form-group">
                                                    <label class="col-sm-12 control-label">Select The Department</label>
                                                    
                        <select name="select" class="selectpicker" data-style="btn-white" data-live-search="true" data-size="5">                                                  
                                                            <option>CSE</option>
                                                            <option>ECE</option>
                                                            <option>EEE</option>
                                                            <option>MECH</option>
                                                            <option>IT</option>
                                                            <option>FT</option>
                                                        </select>
                                                    </div> 
                                                <div class="form-group">

                                                    <label class="col-sm-12 control-label">Select The Batch</label>
                                                    
                        <select name="select" class="selectpicker" data-style="btn-white" data-live-search="true" data-size="5">                                                  
                                                            <option>2011-2015</option>
                                                            <option>2012-2016</option>
                                                            <option>2013-2017</option>
                                                            <option>2014-2018</option>                                                          
                                                        </select>
                                                    </div>       
                                                <a href="completed task.php" class="btn btn-primary">Add</a>                    <div class="btn btn-primary" class="action" data-dialog-close>Close</div>
     
     </form>
                    </div>
                </div>
                <div id="somedialog5" class="dialog">
                    <div class="dialog__overlay"></div>
                    <div class="dialog__content">
                        <h3 style="color:#25ad9f" >Enter The Required Field</h3>
                        <form class="form-horizontal" action="table8.php" method="post">
                                                <div class="form-group">
                                                    <label class="col-sm-12 control-label">Select The Department</label>
                                                    
                        <select name="dept" class="selectpicker" data-style="btn-white" data-live-search="true" data-size="5">                                                  
                                                            <option>CSE</option>
                                                            <option>ECE</option>
                                                            <option>EEE</option>
                                                            <option>MECH</option>
                                                            <option>IT</option>
                                                            <option>FT</option>
                                                        </select>
                                                    </div>
                                                <div class="form-group">
                                                    <label class="col-sm-12 control-label">Select The Batch</label>
                                                    
                        <select name="batch" class="selectpicker" data-style="btn-white" data-live-search="true" data-size="5">                                                  
                                                            <option>2011-2015</option>
                                                            <option>2012-2016</option>
                                                            <option>2013-2017</option>
                                                            <option>2014-2018</option>                                                          
                                                        </select>
                                                    </div>       
                                                <button type="submit" class="btn btn-primary">Search</button>                    <div class="btn btn-primary" class="action" data-dialog-close>Close</div>
     
     </form>
                    </div>
                </div>
                
                <div id="somedialog7" class="dialog">
                    <div class="dialog__overlay"></div>
                    <div class="dialog__content">
                        <h3 style="color:#25ad9f" >Enter The Required Field</h3>
                        <form class="form-horizontal" action="table5.php" method="POST">
                            <div class="form-group">

                                                    <label class="col-sm-12 control-label">Subject Code</label>
                                                     <div class="col-sm-12">
                                                        <input type="text" class="form-control" placeholder="Type Here" name="subject">
                                                    </div>
                                                </div> 
                                                <div class="form-group">
                                                    <label class="col-sm-12 control-label">Select The Department</label>
                                                    <div class="col-sm-12">
                        <select name="dept" class="selectpicker" data-style="btn-white" data-live-search="true" data-size="5">                                                  
                                                            <option>CSE</option>
                                                            <option>ECE</option>
                                                            <option>EEE</option>
                                                            <option>MECH</option>
                                                            <option>IT</option>
                                                            <option>FT</option>
                                                        </select>
                                                    </div>
                                                </div>
<div class="form-group">
                                                    <label class="col-sm-12 control-label">Select The Batch</label>
                                                    <div class="col-sm-12">
                        <select name="batch" class="selectpicker" data-style="btn-white" data-live-search="true" data-size="5">                                                  
                                                            <option>2011-2015</option>
                                                            <option>2012-2016</option>
                                                            <option>2013-2017</option>
                                                            <option>2014-2018</option>                                                          
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                
                                                <button type="submit" class="btn btn-primary">Edit/View</button>
                                                <div class="btn btn-primary" class="action" data-dialog-close>Close</div>
     
                                            </form>
                    </div>
                </div>
                <div id="somedialog8" class="dialog">
                    <div class="dialog__overlay"></div>
                    <div class="dialog__content">
                        <h3 style="color:#25ad9f" >Enter The Required Field</h3>
                        <form class="form-horizontal" action="table6.php" method="post">
                            <div class="form-group">

                                                    <label class="col-sm-12 control-label">Subject Code</label>
                                                     <div class="col-sm-12">
                                                        <input type="text" class="form-control" placeholder="Type Here" name="subject">
                                                    </div>
                                                </div> 
                                                <div class="form-group">
                                                    <label class="col-sm-12 control-label">Select The Department</label>
                                                    <div class="col-sm-12">
                        <select name="dept" class="selectpicker" data-style="btn-white" data-live-search="true" data-size="5">                                                  
                                                            <option>CSE</option>
                                                            <option>ECE</option>
                                                            <option>EEE</option>
                                                            <option>MECH</option>
                                                            <option>IT</option>
                                                            <option>FT</option>
                                                        </select>
                                                    </div>
                                                </div>
<div class="form-group">
                                                    <label class="col-sm-12 control-label">Select The Batch</label>
                                                    <div class="col-sm-12">
                        <select name="batch" class="selectpicker" data-style="btn-white" data-live-search="true" data-size="5">                                                  
                                                            <option>2011-2015</option>
                                                            <option>2012-2016</option>
                                                            <option>2013-2017</option>
                                                            <option>2014-2018</option>                                                          
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                
                                                <button type="submit" class="btn btn-primary">Edit/View</button>
                                                <div class="btn btn-primary" class="action" data-dialog-close>Close</div>
     
                                            </form>
                    </div>
                </div>
                <div id="somedialog9" class="dialog">
                    <div class="dialog__overlay"></div>
                    <div class="dialog__content">
                       <h3 style="color:#25ad9f" >Enter The Required Field</h3>
                        <form class="form-horizontal" action="table7.php" method="post">
                            <div class="form-group">

                                                    <label class="col-sm-12 control-label">Subject Code</label>
                                                     <div class="col-sm-12">
                                                        <input type="text" class="form-control" placeholder="Type Here" name="subject">
                                                    </div>
                                                </div> 
                                                <div class="form-group">
                                                    <label class="col-sm-12 control-label">Select The Department</label>
                                                    <div class="col-sm-12">
                        <select name="dept" class="selectpicker" data-style="btn-white" data-live-search="true" data-size="5">                                                  
                                                            <option>CSE</option>
                                                            <option>ECE</option>
                                                            <option>EEE</option>
                                                            <option>MECH</option>
                                                            <option>IT</option>
                                                            <option>FT</option>
                                                        </select>
                                                    </div>
                                                </div>
<div class="form-group">
                                                    <label class="col-sm-12 control-label">Select The Batch</label>
                                                    <div class="col-sm-12">
                        <select name="batch" class="selectpicker" data-style="btn-white" data-live-search="true" data-size="5">                                                  
                                                            <option>2011-2015</option>
                                                            <option>2012-2016</option>
                                                            <option>2013-2017</option>
                                                            <option>2014-2018</option>                                                          
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                
                                                <button type="submit" class="btn btn-primary">Edit/View</button>
                                                <div class="btn btn-primary" class="action" data-dialog-close>Close</div>
     
                                            </form>
                    </div>
                </div><!-- Related demos -->
                
            </div><!-- /content -->
        </div><!-- /container -->
        <script src="dialog/js/classie.js"></script>
        <script src="dialog/js/dialogFx.js"></script>
        <script>
            (function() {

                var dlgtrigger = document.querySelector( '[data-dialog]' ),
                    somedialog = document.getElementById( dlgtrigger.getAttribute( 'data-dialog' ) ),
                    dlg = new DialogFx( somedialog );

                dlgtrigger.addEventListener( 'click', dlg.toggle.bind(dlg) );

            })();
        </script>
        <script>
            (function() {

                var dlgtrigger = document.querySelector( '[data-dialog1]' ),
                    somedialog1 = document.getElementById( dlgtrigger.getAttribute( 'data-dialog1' ) ),
                    dlg = new DialogFx( somedialog1 );

                dlgtrigger.addEventListener( 'click', dlg.toggle.bind(dlg) );

            })();
        </script>
        <script>
            (function() {

                var dlgtrigger = document.querySelector( '[data-dialog2]' ),
                    somedialog2 = document.getElementById( dlgtrigger.getAttribute( 'data-dialog2' ) ),
                    dlg = new DialogFx( somedialog2 );

                dlgtrigger.addEventListener( 'click', dlg.toggle.bind(dlg) );

            })();
        </script>
        <script>
            (function() {

                var dlgtrigger = document.querySelector( '[data-dialog3]' ),
                    somedialog3 = document.getElementById( dlgtrigger.getAttribute( 'data-dialog3' ) ),
                    dlg = new DialogFx( somedialog3 );

                dlgtrigger.addEventListener( 'click', dlg.toggle.bind(dlg) );

            })();
        </script>
        <script>
            (function() {

                var dlgtrigger = document.querySelector( '[data-dialog4]' ),
                    somedialog4 = document.getElementById( dlgtrigger.getAttribute( 'data-dialog4' ) ),
                    dlg = new DialogFx( somedialog4 );

                dlgtrigger.addEventListener( 'click', dlg.toggle.bind(dlg) );

            })();
        </script>
        <script>
            (function() {

                var dlgtrigger = document.querySelector( '[data-dialog5]' ),
                    somedialog5 = document.getElementById( dlgtrigger.getAttribute( 'data-dialog5' ) ),
                    dlg = new DialogFx( somedialog5 );

                dlgtrigger.addEventListener( 'click', dlg.toggle.bind(dlg) );

            })();
        </script>
        <script>
            (function() {

                var dlgtrigger6 = document.querySelector( '[data-dialog6]' ),
                    somedialog = document.getElementById( dlgtrigger.getAttribute( 'data-dialog6' ) ),
                    dlg = new DialogFx( somedialog6 );

                dlgtrigger.addEventListener( 'click', dlg.toggle.bind(dlg) );

            })();
        </script>
        <script>
            (function() {

                var dlgtrigger = document.querySelector( '[data-dialog7]' ),
                    somedialog7 = document.getElementById( dlgtrigger.getAttribute( 'data-dialog7' ) ),
                    dlg = new DialogFx( somedialog7 );

                dlgtrigger.addEventListener( 'click', dlg.toggle.bind(dlg) );

            })();
        </script>
        <script>
            (function() {

                var dlgtrigger = document.querySelector( '[data-dialog8]' ),
                    somedialog8 = document.getElementById( dlgtrigger.getAttribute( 'data-dialog8' ) ),
                    dlg = new DialogFx( somedialog8 );

                dlgtrigger.addEventListener( 'click', dlg.toggle.bind(dlg) );

            })();
        </script>
        <script>
            (function() {

                var dlgtrigger = document.querySelector( '[data-dialog77]' ),
                    somedialog77 = document.getElementById( dlgtrigger.getAttribute( 'data-dialog77' ) ),
                    dlg = new DialogFx( somedialog77 );

                dlgtrigger.addEventListener( 'click', dlg.toggle.bind(dlg) );

            })();
        </script>
        <script>
            (function() {

                var dlgtrigger = document.querySelector( '[data-dialog9]' ),
                    somedialog9 = document.getElementById( dlgtrigger.getAttribute( 'data-dialog9' ) ),
                    dlg = new DialogFx( somedialog9 );

                dlgtrigger.addEventListener( 'click', dlg.toggle.bind(dlg) );

            })();
        </script>




                    </div>
                </div>
                </div>
              </div>
          <div class="footer">
            <strong>ACET</strong> Campus
        </div>
       
    </div>
    
    <script>
    var colors = {
        "danger-color": "#e74c3c",
        "success-color": "#81b53e",
        "warning-color": "#f0ad4e",
        "inverse-color": "#2c3e50",
        "info-color": "#2d7cb5",
        "default-color": "#6e7882",
        "default-light-color": "#cfd9db",
        "purple-color": "#9D8AC7",
        "mustard-color": "#d4d171",
        "lightred-color": "#e15258",
        "body-bg": "#f6f6f6"
    };
    var config = {
        debug: true,
        theme: "social-1",
        skins: {
            "default": {
                "primary-color": "#16ae9f"
            },
            "orange": {
                "primary-color": "#e74c3c"
            },
            "blue": {
                "primary-color": "#4687ce"
            },
            "purple": {
                "primary-color": "#af86b9"
            },
            "brown": {
                "primary-color": "#c3a961"
            }
        }
    };
    </script>
    <script src="sathish/js/module-media.min.js"></script>
    <script src="sathish/js/vendor-tables.min.js"></script>
    <script src="sathish/js/vendor-core.min.js"></script>
    <script src="sathish/js/vendor-forms.min.js"></script>
     <script src="sathish/js/module-essentials.min.js"></script>
    <script src="sathish/js/module-layout.min.js"></script>
    <script src="sathish/js/module-sidebar.min.js"></script>
    <script src="sathish/js/module-timeline.min.js"></script>
    <script src="sathish/js/theme-core.min.js"></script>
    <script src="sathish/js/vendor-tree.min.js"></script>
     <script src="sathish/js/vendor-nestable.min.js"></script>
     <script src="sathish/js/module-charts-all.min.js"></script>
</body>
</html>