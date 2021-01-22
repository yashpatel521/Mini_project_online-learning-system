<?php
require_once("include/header.php");

?>

<?php 
require_once("include/header.php");
$user = new User($con, $adminLoggedIn);

?>




<nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <ul class="nav navbar-nav flex-nowrap ml-auto">
                            <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><i class="fas fa-search"></i></a>
                                <div class="dropdown-menu dropdown-menu-right p-3 animated--grow-in" role="menu" aria-labelledby="searchDropdown">
                                    <form class="form-inline mr-auto navbar-search w-100">
                                        <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ...">
                                            <div class="input-group-append"><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
                                            
                                        </div>
                                    </form>
                                </div>
                            </li>

                            <?php
                                    $query = $con->prepare("SELECT * FROM message WHERE isAdmin = 0 AND status = 0 group by sender ");
                                    $query->execute();
                                    $notification = $query->rowCount();
                                ?>


                            <li class="nav-item dropdown no-arrow mx-1" role="presentation">
                                <div class="nav-item dropdown no-arrow">
                                    <?php 
                                    if($notification>0){
                                        // echo "
                                        // <a class='dropdown-toggle nav-link' data-toggle='dropdown' aria-expanded='false' href='#'>
                                        //     <i class='fas fa-envelope fa-fw'></i>
                                        //     <span class='badge badge-danger badge-counter'>$notification</span>
                                        // </a>";
                                    }
                                    
                                    ?>
                                    <?php
                                        echo '<div class="dropdown-menu dropdown-menu-right dropdown-list dropdown-menu-right animated--grow-in"
                                        role="menu">
                                        <h6 class="dropdown-header">Message</h6>';
                                    ?>
                                    <?php
                                        $query = $con->prepare("SELECT * FROM message WHERE isAdmin = 0 AND status = 0 group by sender  ORDER BY date DESC ");
                                        $query->execute();
                                        while(($row = $query->fetch(PDO::FETCH_ASSOC))){
                                            $title = $row['title'];
                                            $sender_id = $row['sender'];
                                            $find_query = $con->prepare("SELECT users.firstName as fn , users.lastName as ln
                                            FROM users 
                                           JOIN message ON users.id = message.sender Where users.id = '$sender_id' ");
                                           $find_query->execute();
                                           $f_row = $find_query->fetch(PDO::FETCH_ASSOC);
                                           $name = $f_row['fn']." ".$f_row['ln'];
                                            $img_query = $con->prepare("SELECT img from instructor where user_id = '$sender_id' ");
                                                     $img_query->execute();
                                                     $img_row = $img_query->fetch(PDO::FETCH_ASSOC);
                                                    $imges = $img_row['img'];
                                                    $en = base64_encode($imges);
                                        //     echo '<a class="d-flex align-items-center dropdown-item" href="chat.php">
                                        //     <div class="dropdown-list-image mr-3"><img class="rounded-circle" src="../'.$imges.'">
                                        //     </div>
                                        //     <div class="font-weight-bold">
                                        //         <div class="text-truncate"><span>'.$name.'</span></div>
                                        //         <p class="small text-gray-500 mb-0">'.$title.'</p>
                                        //     </div>
                                        // </a>';
                                        }
                                    ?>
                                        

                                    <?php
                                        echo '<a class="text-center dropdown-item small text-gray-500" href="chat.php">Show All message</a></div>
                                        </div>';
                                    ?>
                                        
                                <div class="shadow dropdown-list dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown"></div>
                            </li>





                            <div class="d-none d-sm-block topbar-divider"></div>

                            <li class="nav-item dropdown no-arrow" role="presentation">
                                <div class="nav-item dropdown no-arrow">
                                    <a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#">
                                        <span class="d-none d-lg-inline mr-2 text-gray-600 text-capitalize">
                                            <?php echo $adminLoggedIn;?>
                                        </span>
                                            <img class="border rounded-circle img-profile" src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRIXIrqiW3R5OstWAjkuFvNwvjYHRaTmwEQWg&usqp=CAU">
                                    </a>
                                    <div class="dropdown-menu shadow dropdown-menu-right animated--grow-in" role="menu">
                                        <a class="dropdown-item" role="presentation" href="profile.php"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Profile</a>
                                      <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" role="presentation" href="logout.php"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Logout</a></div>
                                    </div>
                            </li>
                        </ul>
                    </div>
                </nav> 