<?php
require_once("header.php");
?>
<header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-md">
                <div class="navbar-header" data-logobg="skin6">
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>
                    <div class="navbar-brand">
                        <a href="index.php">
                            <b class="logo-icon">
                                <img src="assets/images/logob1.png" alt="homepage" class="dark-logo" height="50px" />
                                <img src="assets/images/logo_title.png" alt="homepage" class="light-logo" />
                            </b>
                            <span class="logo-text text-truncate text-primary page-title font-weight-medium">Brighter Bee</span>
                        </a>
                    </div>
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
                        data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
                            class="ti-more"></i></a>
                </div>
               <div class="navbar-collapse collapse" id="navbarSupportedContent">
               <?php
                                    $query = $con->prepare("SELECT * FROM message WHERE receiver = '$instructorLoggedInId' AND status = 0  ");
                                    $query->execute();
                                    $notification = $query->rowCount();
                                ?>
                                
                    <ul class="navbar-nav float-left mr-auto ml-3 pl-1">
                    
                    <li class="nav-item d-none d-md-block">
                            <a class="nav-link" href="javascript:void(0)">
                                <form>
                                    <!-- <div class="customize-input">
                                        <input class="form-control custom-shadow custom-radius border-0 bg-white"
                                            type="search" placeholder="Search" aria-label="Search">
                                        <i class="form-control-icon" data-feather="search"></i>
                                    </div> -->
                                </form>
                            </a>
                        </li>

                    </ul>
                    <ul class="navbar-nav float-right">
                    <li class="nav-item dropdown">
                
                    <?php 
                        if($notification>0){
                            echo "<a class='nav-link dropdown-toggle mx-4 position-relative' href='javascript:void(0)' id='bell' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <span><i data-feather='bell' class='svg-icon'></i></span>
                            <span class='badge badge-primary notify-no rounded-circle'>$notification</span>";

                        }
                        else{
                            echo "<span class='badge badge-primary notify-no rounded-circle'></span>";
                        }
                    ?>
                        
                            </a>
                            <div class="dropdown-menu dropdown-menu-left mailbox animated bounceInDown" style="width:300px;">
                                <ul class="list-style-none">
                                    <li>
                                        <div class="message-center notifications position-relative">
                                        <?php 
                                        $query = $con->prepare("SELECT * FROM message WHERE receiver = '$instructorLoggedInId'   ORDER BY date DESC");
                                        $query->execute();
                                        
                                        
                                            while(($row = $query->fetch(PDO::FETCH_ASSOC)) ){
                                               
                                                $title = $row['title'];
                                                $id = $row['id'];
                                                $description = $row['Description'];
                                                $isAdmin = $row['isAdmin'];
                                               
                                                $date = $row['date'];
                                                $status = $row['status'];
                                                if ($isAdmin == 1){
                                                    $sender = "Brighter Bee Admin";
                                                }
                                                if($status == 0){
                                                    echo "<a href='notification.php' class='message-item d-flex align-items-center border-bottom '>
                                                <div class='mr-2 ml-2'>
                                                <span class='font-12 text-nowrap d-block text-muted'>From $sender</span>
                                                    <h6 class='message-title text-primary mb-0 mt-1'>$title</h6>
                                                    <span class='font-12 text-nowrap d-block text-muted'>$date</span>
                                                </div>
                                                <img src='https://icon-library.com/images/new-icon/new-icon-27.jpg' style='height:50px;width:60px' '/>

                                                </a>";
                                                }
                                                // else{
                                                //     echo "<a href='notification.php' class='message-item d-flex align-items-center border-bottom '>
                                                // <div class='mr-5 ml-2'>
                                                // <span class='font-12 text-nowrap d-block text-muted'>From $sender</span>
                                                //     <h6 class='message-title mb-0  mt-1'>$title</h6>
                                                //     <span class='font-12 text-nowrap d-block text-muted'>$date</span>
                                                // </div>
                                                // </a>";
                                                // }
                                             }
                                            
                                        ?>
                                            
                                        </div>
                                    </li>
                                    <li><?php 
                                        if($notification > 0 ){
                                            echo "<a class='nav-link pt-3 text-center text-dark' href='notification.php'>";
                                            echo "<strong>Check all notifications</strong>";
                                            echo "<i class='fa fa-angle-right'></i>
                                            </a>";
                                        }
                                        else{
                                            echo "<a class='nav-link pt-3 text-center text-dark' href='javascript:void(0);'>";
                                            echo "<strong>No notifications</strong></a>";
                                        }
                                    ?>
                                        
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <img src="../<?php echo $img; ?>" alt="user" class="rounded-circle"
                                    width="40">
                                <span class="ml-2 d-none d-lg-inline-block"><span></span> <span
                                        class="text-dark"><?php echo $instructorLoggedIn; ?></span> <i data-feather="chevron-down"
                                        class="svg-icon"></i></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                                <a class="dropdown-item" href="profile.php"><i data-feather="user"
                                        class="svg-icon mr-2 ml-1"></i>
                                    My Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php"><i data-feather="power"
                                        class="svg-icon mr-2 ml-1"></i>
                                    Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle pl-md-3 position-relative" href="javascript:void(0)" id="bell" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span><i data-feather="bell" class="svg-icon"></i></span>
                                <?php
                                    $query = $con->prepare("SELECT * FROM message WHERE receiver = '$instructorLoggedIn' ");
                                    $query->execute();
                                    $notification = $query->rowCount();
                                    if ($notification > 0 ){
                                        echo "<span class='badge badge-primary notify-no rounded-circle'>$notification</span>";
                                    }

                                ?>
                                
                            </a>
                            <div class="dropdown-menu dropdown-menu-left mailbox animated bounceInDown">
                                <ul class="list-style-none">
                                    <li>
                                        <div class="message-center notifications position-relative">
                                            <a href="javascript:void(0)" class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                                <div class="w-100 d-inline-block v-middle px-5">
                                                    <h6 class="message-title mb-0 mt-1">Luanch Admin</h6>
                                                    <span class="font-12 text-nowrap d-block text-muted">Just see
                                                        the my new
                                                        admin!</span>
                                                    <span class="font-12 text-nowrap d-block text-muted">9:30 AM</span>
                                                </div>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="nav-link pt-3 text-center text-dark" href="javascript:void(0);">
                                            <strong>Check all notifications</strong>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li> -->