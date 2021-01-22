
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>
<footer class="footer-area">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-sm-6 col-md-4 col-xl-3">
                <div class="single-footer-widget footer_1">
                    <img src="assests/logo/logob1.png" style="width:40px;margin-top:-5px;padding-right:5px;float:left" alt=""><h4>BRIGHTER BEE</h4>

                    <p style="text-align: justify">Education opens up the mind, expands it and allows you to improve your life in so many ways.</p>
                    <!--                        <p>Anyone who has never made a mistake has never tried anything new.</p>-->
                    <form method="post"  action="verify.php">
                        <input type="text" id="ref" name="ref" placeholder="Enter Reference ID">
                        <button class="btn btn-info" type="submit" target="_blank" style="width: 70px">Verify</button>
                    </form>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-md-4">
                <div class="single-footer-widget footer_2">
                    <h4><span class="ti-gift"></span> Follows us</h4>
                    <div class="contact_info">
                        <p><span class="ti-facebook"> Facebook :</span> Brighter.facebook.com</p>
                        <p><span class="ti-instagram"> Instagram :</span> brighter.insta</p>
                        <p><span class="ti-twitter"> Twitter : </span> Brighter.twitter</p>
                        <p><span class="ti-github"> Github : </span> Brighter.git</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-md-4">
                <div class="single-footer-widget footer_2">
                    <h4><span class="ti-announcement"></span> Contact us</h4>
                    <div class="contact_info">
                        <p><span class="ti-map-alt"> Address :</span> 50/A ,abc soc. , XYZ Road, Surat,Gujarat.</p>
                        <p><span class="ti-mobile"> Phone :</span> +91 1234567899</p>
                        <p><span class="ti-email"> Email : </span><a href="mailto:parthb401@gmail.com">brighter.bee@bee.com</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</footer>
<script>
    function check(){
        conts xyz = document.getElementById("ref");
        if(!isNaN(xyz))
        {
            window.alert("Please Enter Valid ref");
        }
        // return false;

        console.log(xyz);
    }
</script>