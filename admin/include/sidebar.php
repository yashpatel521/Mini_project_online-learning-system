
<nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion  p-0"
style="background-color: #2a2a72;background-image: linear-gradient(315deg, #2a2a72 0%, #009ffd 74%);font-family: Nunito;">
            <div class="container-fluid d-flex flex-column p-0">
                <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="index.php">
                    <div class="sidebar-brand-icon pt-3"><img src="assets\img\logob1.png" style="height:50px;"></div>
                    <div class="sidebar-brand-text mx-2" style="color:"><span>Brighter Bee</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="nav navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="index.php"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="update-admin.php"><i class="fas fa-user-edit"></i><span>Admin</span></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="show-instructor.php"><i class="fas fa-chalkboard-teacher"></i><span>Instructor</span></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="update-user.php"><i class="fas fa-users"></i><span>Learner</span></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="payment_details.php"><i class="fas fa-money-bill"></i><span>Payment</span></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="add-categories.php"><i class="fas fa-align-justify"></i><span>Category</span></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="show-entities.php"><i class="fas fa-tags"></i><span>Courses</span></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="contact.php"><i class="fas fa-check-circle"></i><span>Contact Us</span></a></li>
                    <?php
                        $query = $con->prepare("SELECT  *  FROM message WHERE isAdmin != 1   ");
                        $query->execute();
                        $total_msg = $query->rowCount();
                        $unread = 0;
                        while($row = $query->fetch(PDO::FETCH_ASSOC)){
                            if($row['status']==0){
                                $unread += 1;
                            }
                        }
                        // ('.$total_msg.')</span></a></li>
                        if($total_msg != 0){
                            echo '<li class="nav-item" role="presentation"><a class="nav-link active" href="chat.php">
                            <i class="fas fa-sms"></i><span>Message ';
                            if($unread != 0){
                                echo '('.$unread.')</span></a></li>';
                            }
                            else{
                                echo "</span></a></li>";
                            }
                        }
                        
                    ?>

                    </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
