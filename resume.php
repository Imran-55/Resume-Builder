<?php
require 'assets/class/database.class.php';
require 'assets/class/function.class.php';
$sludg = $_GET['resume'] ?? '';

$resumes = $db->query("SELECT * FROM resumes WHERE  (sludg = '$sludg')");


$resume = $resumes->fetch_assoc();
// print_r($resume); 
if (!$resume) {
  $fn->redirect('myresumes.php');
}

$exps = $db->query("SELECT * FROM experiences WHERE (resume_id=" . $resume['id'] . ") ");
$exps = $exps->fetch_all(1);

$edus = $db->query("SELECT * FROM educations WHERE (resume_id=" . $resume['id'] . ") ");
$edus = $edus->fetch_all(1);

$skills = $db->query("SELECT * FROM slills WHERE (resume_id=" . $resume['id'] . ") ");
$skills = $skills->fetch_all(1)

  ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Boogaloo&family=Cambay:ital,wght@0,400;0,700;1,400;1,700&family=Ibarra+Real+Nova:ital,wght@0,400..700;1,400..700&family=Ojuju:wght@200..800&display=swap" rel="stylesheet">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="icon" href="assets/images/logo1.png">
    <title><?= $resume['fullName'] .' | '. $resume['resume_title']?></title>
</head>

<body>
<style>
@import url('https://fonts.googleapis.com/css2?family=AR+One+Sans:wght@400..700&family=Cormorant+Upright:wght@300;400;500;600;700&family=Hubballi&family=IM+Fell+DW+Pica:ital@0;1&family=Lovers+Quarrel&family=Ojuju:wght@200..800&family=Radio+Canada:ital,wght@0,300..700;1,300..700&family=Sail&family=Trykker&family=Vibur&display=swap');






        body {
            
            padding: 0;
            background-color: #FAFAFA;
            font-family: 'Poppins', sans-serif;
            font-size: 12pt;

            background: rgb(249, 249, 249);
            background: #2F2F2F;
            /* background-image: url(./tiles/tile23.jpg); */
            background-attachment: fixed;
        }

        * {
            margin: 0px;
        }

        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .page {

            width: 21cm;
            min-height: 29.7cm;
            padding: 0.5cm;
            margin: 0.5cm auto;
            border: 1px #D3D3D3 solid;
            border-radius: 5px;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .subpage {

            margin:0;
            /* height: 256mm; */


        }

        @page {
            size: A4;
            margin: 0;
        }

        @media print {
            .page {
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }
        }

        * {
            transition: all .2s;
        }

        table {
            border-collapse: collapse;
        }

        .pr {
            padding-right: 30px;
        }

        .pd-table td {
            padding-right: 10px;
            padding-bottom: 3px;
            padding-top: 3px;
        }
    </style>

<div class="extra">
<div class=" w-100 py-2 d-flex justify-content-center gap-4" style="background-color:#712cf9">
<button class="btn btn-light btn-sm" id="download"><i class="bi bi-download"></i></i> Download</button>

<button class="btn btn-light btn-sm"><i class="bi bi-whatsapp"></i> Share</button>
<button class="btn btn-light btn-sm" id="print"><i class="bi bi-printer"></i></i> Print</button>
<button class="btn btn-light btn-sm" data-bs-toggle="offcanvas" data-bs-target="#font"><i class="bi bi-file-earmark-font"></i> Fonts</button>


</div>
</div>

<div class="page">
    <div class="subpage">
        <table class="w-100">
            <tbody>
                <tr>
                    <td colspan="2" class="text-center fw-bold fs-4">Resume</td>
                </tr>
                <tr>
                    <td></td>
                    <td class="personal-info zsection">
                        <div class="fw-bold name"><?= $resume['fullName']?></div>
                        <div>Mobile : <span class="mobile">+91-<?= $resume['mobile_no']?></span></div>
                        <div>Email : <span class="email"><?= $resume['email']?></span></div>
                        <div>Address : <span class="address"><?= $resume['address']?></span></div>
                        <hr>
                    </td>
                </tr>

                <tr class="objective-section zsection">
                    <td class="fw-bold align-top text-nowrap pr title">Objective</td>
                    <td class="pb-3 objective">
                    <?= $resume['objective']?>
                    </td>
                </tr>

                <tr class="experience-section zsection">
                    <td class="fw-bold align-top text-nowrap pr title">Experience</td>
                    <td class="pb-3 experiences">

                    <?php    
                    if($exps){
                     foreach($exps as $exp){
                        ?>
                            <div class="experience mb-2">
                            <div class="fw-bold">- <span class="job-role"><?= $exp['position']?>
                            </div>
                            <div class="company"><?= $exp['company']?></div>
                            <div><span class="working-from"><?= $exp['started']?></span> – <span class="working-to"><?= $exp['end']?></span></div>
                            <div class="work-description"><?= $exp['job_desc']?></div>
                        </div>



                        <?php
                     }

                    }else{
                    ?>
                         <div class="experience mb-2">
                            
                            <div class="company">I am Freshers</div>
                            
                        </div>

                    <?php

                    }
                    
                    ?>

                        
                    </td>
                </tr>

                <tr class="education-section zsection">
                    <td class="fw-bold align-top text-nowrap pr title">Education</td>
                    <td class="pb-3 educations">


                    
                    <?php    
                    if($edus){
                     foreach($edus as $exp){
                        ?>
                            <div class="education mb-2">
                            <div class="fw-bold">- <span class="course"><?= $exp['course']?></span></div>
                            <div class="institute"><?= $exp['institute']?></div>
                            <div class="date"><?= $exp['started']?> - <?= $exp['ended']?></div>
                        </div>

                    




                        <?php
                     }

                    }else{
                    ?>
                         <div class="experience mb-2">
                            
                            <div class="company">I Dont have any Education</div>
                            
                        </div>

                    <?php

                    }
                    
                    ?>

                       


                    </td>
                </tr>

                <tr class="skills-section zsection">
                    <td class="fw-bold align-top text-nowrap pr title">Skills</td>
                    <td class="pb-3 skills">

                     
                    <?php    
                    if($skills){
                     foreach($skills as $exp){
                        ?>
                             <div class="skill">-<?= $exp['skill']?> </div>

                    




                        <?php
                     }

                    }else{
                    ?>
                         <div class="experience mb-2">
                            
                            <div class="company">I Dont have any Skill</div>
                            
                        </div>

                    <?php

                    }
                    
                    ?>


                       

                    </td>
                </tr>

                <tr class="personal-details-section zsection">
                    <td class="fw-bold align-top text-nowrap pr title">Personal Details</td>
                    <td class="pb-3">
                        <table class="pd-table">
                            <tr>
                                <td>Date of Birth</td>
                                <td>: <span class="date-of-birth"><?= date('d F Y',strtotime($resume['dob'])) ?></span></td>
                            </tr>
                            <tr>
                                <td>Gender</td>
                                <td>: <span class="gender"><?= $resume['gender']?></span></td>
                            </tr>
                            <tr>
                                <td>Religion</td>
                                <td>: <span class="religion"><?= $resume['religion']?></span></td>
                            </tr>
                            <tr>
                                <td>Nationality</td>
                                <td>: <span class="nationality"><?= $resume['nationality']?></span></td>
                            </tr>
                            <tr>
                                <td>Marital Status</td>
                                <td>: <span class="marital-status"><?= $resume['martial_status']?></span></td>
                            </tr>
                            <tr>
                                <td>Hobbies</td>
                                <td>: <span class="hobbies"> <?= $resume['hobbies']?></span></td>
                            </tr>

                        </table>

                    </td>
                </tr>

                <tr class="languages-known-section zsection">
                    <td class="fw-bold align-top text-nowrap pr title">Languages Known</td>
                    <td class="pb-3 languages">

                    <?= $resume['languages']?>
                    </td>
                </tr>

                <tr class="declaration-section zsection">
                    <td class="fw-bold align-top text-nowrap pr title">Declaration</td>
                    <td class="pb-5 declaration">
                        I hereby declare that above information is correct to the best of my
                        knowledge and can be supported by relevant documents as and when
                        required.
                    </td>
                </tr>
             
            </tbody>
        </table>
        <div d-flex justify-content-between>
                    <div class="px-3">Date : <?= date('d F Y',$resume['updated_at']) ?></div>
                    <div class="px-3 name text-end"> <?= $resume['fullName']?></div>

                </div>
    </div>

</div>


<div class="offcanvas offcanvas-bottom" tabindex="-1" id="font" aria-labelledby="offcanvasBottomLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasBottomLabel">Change Fonts</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body ">
      <select class="form-control" id="font">
        <option value="">"System Font"</option>
        <option value="Hubballi', sans-seri" style="  font-family: 'Boogaloo', sans-serif">"Hubballi', sans-serif"</option>
        <option value="Radio Canada', sans-serif " style=" font-family: 'Cambay', sans-serif">"Radio Canada", sans-serif</option>
        <option value=" 'Cormorant Upright', serif" style="font-family: 'Cormorant Upright', serif">"Cormorant Upright", serif</option>
        <option value="Lovers Quarrel', cursive " style="font-family: 'Lovers Quarrel', cursive">"Lovers Quarrel", cursive</option>
        <option value="Trykker', serif " style="font-family: 'Trykker', serif">"Trykker", serif</option>
        <option value=" AR One Sans', sans-serif" style="font-family: 'AR One Sans', sans-serif">"AR One Sans", sans-serif</option>
        <option value=" Vibur', cursive" style="font-family: 'Vibur', cursive">"Vibur", cursive</option>
        <option value="IM Fell DW Pica', serif " style="font-family: 'IM Fell DW Pica', serif">"IM Fell DW Pica", serif</option>
        <option value="Ojuju', sans-serif " style="font-family: 'Ojuju', sans-serif">"Ojuju", sans-serif</option>
        <option value=" Sail', system-u" style="font-family: 'Sail', system-u">"Sail", system-u</option>
    </select>
 
  </div>
</div>

</body>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

<script>

$("#download").click(function(){

    window.jsPDF = window.jspdf.jsPDF;
    var doc = new jsPDF();
    var page = document.querySelector('.page');
    doc.html(page, {
    callback: function (doc) {
        doc.save('<?= $resume['fullName']?> - <?= $resume['resume_title']?>.pdf');
    },
    margin: [10, 10, 10, 10], // Adjust margins as needed
    x: 10,
    y: 10,
    width: 280 // Adjust width to fit content
    // scale: 1.1 // Scale content down if needed
});

});

    $("#font").change(function(){
    let font = $(this).find(":selected").val();
    $("body").css("font-family", font);
});

$("#print").click(function(){
 $(".extra").hide();
 window.print();
 setTimeout(()=>{
    $(".extra").show();
    }, 100);
});

</script>

</html>