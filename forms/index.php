<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles.css">
    <link rel="shortcut icon" href="../assets/images/favicon.png" type="image/png" />

    <!-- NORMALIZE CSS -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css' />

    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,300,400,500,600,700" rel="stylesheet">

    <!-- FONTAWESOME -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' />

    <!-- jQuery Plugins -->

    <!-- TOOLTIPSTER -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/tooltipster/3.3.0/css/tooltipster.min.css' />
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/tooltipster/3.3.0/css/themes/tooltipster-shadow.min.css' />

    <!-- ANIMATE CSS -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css' />

    <!-- CUSTOM CSS -->
    <link rel='stylesheet' href='../styles/style.css' />

    
    <title>Document</title>
</head>
<body>
     <!-- MySQL connector --!>
  <?php
        include "../includes/mysql_connect.php";
        $conn=connect_mysql();
    ?>

  <!-- MAIN CONTAINER -->
    <div class="main-container">

        <!-- NAVBAR_MAIN -->
        <?php include '../includes/navbar-main.php' ?>
        <!-- /NAVBAR_MAIN -->

        <div id="tab-container" class="tab-container">
            <ul class='etabs'>
                <li class='tab'><a href="#step1">STEP 1</a></li>
                <li class='tab'><a href="#step2">STEP 2</a></li>
                <li class='tab'><a href="#step3">STEP 3</a></li>
                <li class='tab'><a href="#step4">STEP 4</a></li>
                <li class='tab'><a href="#step5">STEP 5</a></li>
            </ul>
            <div id="step1">
                <form class="form_form" action="">
                    <div class="myname">
                        <select name="Salutation" class="salutation" required>
                            <option value="Mr.">Mr.</option>
                            <option value="Mrs">Ms.</option>
                            <option value="Ms.">Mrs.</option>
                        </select>
                        <input class="name" type="text" placeholder="Firstname" required>
                        <input class="lastname" type="text" placeholder="Lastname" required>
                    </div>
                    <div class="contact">
                            <input class="input_" type="email" placeholder="email">
                            <input class="input_" type="text" placeholder="Mobile Numbe"/>
                            <input class="input_" type="date" name="bday" max="1979-12-31" min="2001-12-31" placeholder="Date of birth"/>
                    </div>
                    
                    <div class="radio">
                        <div><input type="radio" name="program" value="male" >Certificate Program</div>
                        <div><input type="radio" name="program" value="male" >Diploma Program</div>
                        <div><input type="radio" name="program" value="male" >Post Graduate Diploma Program</div>
                        <div><input type="radio" name="program" value="male" >Executive Program</div>                    
                        
                    </div>
                    <div class="course">
                        <select name="Choose programs" id="">
                            <option value="Choose">Choose Program</option>
                        </select>
                        <select name="Course Info" id="">
                            <option value="Course Info">Course Info</option>
                        </select>
                    </div>
                    
                    <button>Next</button>
                </form>
            </div>
            <div id="step2">
                <form class="form_form" action="">
                    <div class="myname">
                        <select name="Salutation" class="salutation" required>
                            <option value="Mr.">Mr.</option>
                            <option value="Mrs">Ms.</option>
                            <option value="Ms.">Mrs.</option>
                        </select>
                        <input class="name" type="text" placeholder="Firstname" required>
                        <input class="lastname" type="text" placeholder="Lastname" required>
                    </div>
                    <div class="fathers-name">
                        <select name="Salutation" class="salutation" required>
                            <option value="Mr.">Mr.</option>
                            <option value="Mrs">Ms.</option>
                            <option value="Ms.">Mrs.</option>
                        </select>
                        <input class="name" type="text" placeholder="Father's Firstname" required>
                        <input class="lastname" type="text" placeholder="Father's Lastname" required>
                    </div>
                    <div class="mothers-name">
                        <select name="Salutation" class="salutation" required>
                            <option value="Mr.">Mr.</option>
                            <option value="Mrs">Ms.</option>
                            <option value="Ms.">Mrs.</option>
                        </select>
                        <input class="name" type="text" placeholder="Mother's Firstname" required>
                        <input class="lastname" type="text" placeholder="Mother's lastname" required>
                    </div>
                    
                    <div class="marital">
                        <input id="date" type="date" name="bday" max="1979-12-31" min="2001-12-31" placeholder="Date of birth">
                        <select name="Marital" id="marital" required>
                            <option value="married">Married</option>
                            <option value="unmarried">Unmarried</option>
                            <option value="divorced">Divorced</option>
                        </select>
                        <input id="spouse" type="text" placeholder="Spouse Name" required>
                    </div>
                    <div class="gender">
                        <select name="gender" id="gender" required>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="others">Others</option>
                        </select>
                        <input id="adhar" type="text" placeholder="Adharcard Number" required widthh: auto>
                        <select name="Blood Group" id="blood__group" required>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                            <option value="A+">A+</option>
                        </select>
                    </div>
                    <div class="caste">
                        <select name="caste" id="caste" required>
                            <option value="General">General</option>
                            <option value="OBC">OBC</option>
                            <option value="SC">SC</option>
                        </select>
                        <select name="nationality" id="nationality" required>
                            <option value="Indian">Indian</option>
                            <option value="German">German</option>
                            <option value="British">British</option>
                        </select>
                        <select name="domicile" id="domicile" required>
                            <option value="Indian">Indian</option>
                            <option value="German">German</option>
                            <option value="British">British</option>
                        </select>
                    </div>
                    <button class="next">Next</button>
                        
                </form>
            </div>
            <div id="step3">
                <form class="form_form" action="">
                    <h3>Choose a program</h3>
                    <div class="radio">
                        <div><input type="radio" name="program" value="male" >Certificate Program</div>
                        <div><input type="radio" name="program" value="male" >Diploma Program</div>
                        <div><input type="radio" name="program" value="male" >Post Graduate Diploma Program</div>
                        <div><input type="radio" name="program" value="male" >Executive Program</div>                    
                        
                    </div>
                    <div class="course">
                        <select name="Choose programs" id="">
                            <option value="Choose">Choose Program</option>
                        </select>
                        <select name="Course Info" id="">
                            <option value="Course Info">Course Info</option>
                        </select>
                    </div>
                    <div class="locatioon">
                        <select name="Location" id="">
                            <option value="Choose">Kolkata-Camac Street</option>
                        </select>
                        <select name="Self" id="">
                            <option value="Choose">Self Learning Material</option>
                        </select>
                    </div>
                    <div class="defence">
                        <select name="Defence" id="">
                            <option value="Choose">Defence Personal</option>
                        </select>
                    </div>
                    <h3>Are you an existing student with NGA-SCE/Alumni</h3>
                    <div class="radio2">
                        <input type="radio" name="boolean" >Yes</input>
                        <input type="radio" name="boolean" >No</input>
                        
                    </div>
                    <div class="course">
                        <select name="course name" id="">
                            <option value="Choose">Course Name</option>
                        </select>
                        <input id="student-number" type="text" placeholder="Student Number" required>
                    </div>
                    <div class="passingYear">
                        <select name="Year of Passing" id="">
                            <option value="Choose">Year of Passing</option>
                        </select>
                        <select name="Month of Passing" id="">
                            <option value="Choose">Month of Passing</option>
                        </select>
                    </div>
                    <div>
                        <select name="course name" id="">
                            <option value="Choose">Do you want opt for Lateral Admission?</option>
                        </select>
                    </div>
                    <div class="button"></div>
                        <button class="back">Back</button>
                        <button class="next">Next</button>
                    </div>
                    
                </form>
            </div>
        </div>

    </div>
    <script
        src="https://code.jquery.com/jquery-3.3.1.js"
        integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.easytabs/3.2.0/jquery.easytabs.min.js"></script>
    <script src="app.js"></script>

    <!-- jQuery -->
    <!-- TweenMax -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.0/TweenMax.min.js"></script>
    <!-- ToolTipster -->
    <script
        src='https://cdnjs.cloudflare.com/ajax/libs/tooltipster/3.3.0/js/jquery.tooltipster.min.js'>
    </script>
    <!-- WOW JS -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js'></script>
    <script src='../js/navbar.js'></script>
    <script src="../js/preloader.js"></script>
    
</body>
</html>