<?php include('includes/header.php');
	
	if (isset($_POST['contact_us']))
	{
		$name = $_POST['name'];
		$msg = $_POST['message'];
		$email = FormSanitizer::sanitizeFormEmail($_POST['email']);
		$sub = $_POST['subject'];
		
		$query = $con->prepare("INSERT INTO contact_us(name,message,email,subject) VALUES (:name, :msg, :email, :sub)");
		$query->bindValue("name", $name);
		$query->bindValue("msg", $msg);
		$query->bindValue("email", $email);
		$query->bindValue("sub", $sub);

		$query->execute();
		
		/*
		// mail sending
		$_SESSION['success'] = "";
		$_SESSION['error'] = "";
		
		$to_email = 'parthb401@gmail.com';
		$subject = "Thank You For Contact Us!";
		$from = $email;
		$fromName = 'Brighter Bee';
		
		$body = '
        <html>
            <head>
                <title>Welcome to Brighter Bee</title>
            </head>
            <body style="font-family: Yu Gothic UI Semibold;padding: 30px;">
                <h1>Thank you Contact us!</h1>
                <h3>Hi, ' . $name . '</h3><hr>
                <h4 style="color: green">Your Message Has been Deliverd to the Brighter Bee With information below.</h4>
                <p> Name : ' . $name . '</p>
                <p> Subject : ' . $sub . '</p>
                <p><pre style="font-family: Yu Gothic UI Semibold;">Message : ' . $msg . '</pre></p>
                <p> Date : ' . date("Y/m/d") . '</p>
    
            </body>
        </html>';
		
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= 'From: ' . $fromName . '<' . $from . '>' . "\r\n";
		$headers .= "CC: bambharoliyachintan123@gmail.com".PHP_EOL;
		$headers .= "BCC: yash1451999@gmail.com".PHP_EOL;
		if (mail($to_email, $subject, $body, $headers)) {
			$_SESSION['success'] = "Your Message Successfully Delivered to the Brighter Bee";
		} else {
			$_SESSION['error'] = "Something went Wrong!  Check our Internet Connection ";
		}*/
	}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('includes/uplinks.php') ?>
    </head>
    <body>
    <?php 
            if(!isset($_SESSION["userLoggedIn"])){
              include('includes/before_login.php');

            }
            else{
              include('includes/topbar.php');
                
            }
         ?>
    <section class="breadcrumb" style="margin-top:6%;
            background-image: url('assests/images/category/web2.jpg');
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;">
        <div class="container">
    <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner text-center">
                        <div class="breadcrumb_iner_item">
                            <h2>Contact us</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="contact-section section_padding">
      <div class="container">
      <div class="d-none d-sm-block mb-5 pb-4">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d193760.88558077076!2d72.76006437033102!3d21.183854739676214!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be04e59411d1563%3A0xfe4558290938b042!2sSurat%2C%20Gujarat!5e1!3m2!1sen!2sin!4v1608297803272!5m2!1sen!2sin" width="100%" height="600" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>      </div>
          <div class="row">
              <div class="col-12">
                  <h2 class="contact-title">Get in Touch</h2>
              </div>
              <div class="col-lg-8">
                  <form class="form-contact contact_form" method="post">
                        <span style="text-align:center;color:green;">
                            <?php
	                            if(isset($_SESSION['success']))
	                            {
		                            echo $_SESSION['success'];
	                            }
	                            else
	                            {
		                            $_SESSION['success'] = "";
	                            }
                            ?>
                        </span>
                      <h5 style="text-align:center;color:red;">
					      <?php
						      if(isset($_SESSION['error']))
						      {
							      echo $_SESSION['error'];
						      }
						      else
						      {
							      $_SESSION['error'] = "";
						      }
					      ?>
                      </h5>
                      <div class="row">
                          
                          <div class="col-sm-6">
                              <div class="form-group">
                                  <input class="form-control" name="name" id="name" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'" placeholder="Enter your name">
                              </div>
                          </div>
                          <div class="col-sm-6">
                              <div class="form-group">
                                  <input class="form-control" name="email" id="email" type="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'" placeholder="Enter email address">
                              </div>
                          </div>
                          <div class="col-12">
                              <div class="form-group">
                                  <input class="form-control" name="subject" id="subject" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Subject'" placeholder="Enter Subject">
                              </div>
                          </div>
                          <div class="col-12">
                              <div class="form-group">
                                  <textarea class="form-control w-100" name="message" id="message" cols="30" rows="9" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Message'" placeholder="Enter Message"></textarea>
                              </div>
                          </div>
                      </div>
                      <div class="form-group mt-3">
                          <button type="submit" name="contact_us" class="button button-contactForm btn_1">Send Message</button>
                      </div>
                  </form>
              </div>
              <div class="col-lg-4">
                  <div class="media contact-info">
                      <span class="contact-info__icon"><i class="ti-home"></i></span>
                      <div class="media-body">
                          <h3>Surat , Gujarat.</h3>
                      </div>
                  </div>
                  <div class="media contact-info">
                      <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                      <div class="media-body">
                          <h3>+91 1234567899</h3>
                      </div>
                  </div>
                  <div class="media contact-info">
                      <span class="contact-info__icon"><i class="ti-email"></i></span>
                      <div class="media-body">
                          <h3><a href="mailto:parthb401@gmail.com">brighter@bee.com</a></h3>
                      </div>
                  </div>
              </div>
          </div>
    </div>
  </section>
    <?php  include('includes/footer.php')?>
   <?php  include('includes/downlinks.php')?>
    </body>
</html>