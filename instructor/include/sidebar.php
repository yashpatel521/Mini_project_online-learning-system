<aside class="left-sidebar" data-sidebarbg="skin6">
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="index.php" aria-expanded="false" style="text-decoration: none;"><i
                            data-feather="home" class="feather-icon"></i><span
                            class="hide-menu">Dashboard</span></a>
                </li>
                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">Courses</span></li>
                <li class="sidebar-item"> <a class="sidebar-link" href="create-course.php" aria-expanded="false" style="text-decoration: none;"><i
                            data-feather="file" class="feather-icon"></i><span
                            class="hide-menu">Create Course
                        </span></a>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link" href="show-course.php" aria-expanded="false" style="text-decoration: none;"><i
                            data-feather="book" class="feather-icon"></i><span
                            class="hide-menu">Show Course
                        </span></a>
                </li>
                <?php $query = $con->prepare("SELECT * FROM entities WHERE teacherid = '$ins_id' and status = 0  ");
                                $query->execute();
                                $c=0;
                                if ($query->rowCount() > 0){
                                    echo "<li class='sidebar-item'> <a class='sidebar-link' href='review-course.php' aria-expanded='false' style='text-decoration: none;'><i
                                    data-feather='file-text' class='feather-icon'></i><span
                                    class='hide-menu'>Pending Course
                                </span></a>
                                    </li>";
                                }
                                ?>
                


                <li class="list-divider"></li>
                <?php
                    $query = $con->prepare("SELECT * FROM message WHERE receiver = '$instructorLoggedInId' ");
                    $query->execute();
                    $msg_count = $query->rowCount();
                    if($msg_count != 0){
                        echo '<li class="nav-small-cap"><span class="hide-menu">Contact</span></li>
                        <li class="sidebar-item"> <a class="sidebar-link" href="notification.php" aria-expanded="false" style="text-decoration: none;">
                        <i data-feather="message-square" class="feather-icon"></i>
                        <span class="hide-menu">Message</span></a>
                        </li>';

                    }
                ?>
                

            </ul>
        </nav>
    </div>
</aside>