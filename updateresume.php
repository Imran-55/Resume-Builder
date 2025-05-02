<?php
$title = "My Resumes || Resume Builder";
require './assets/includes/header.php';
require './assets/includes/navbar.php';
$fn->Authpage();
$sludg = $_GET['resume'] ?? '';

$resumes = $db->query("SELECT * FROM resumes WHERE (user_id = " . $fn->Auth()['id'] . ") AND (sludg = '$sludg')");


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

<div class="container">

  <div class="bg-white rounded shadow p-2 mt-4" style="min-height:80vh">
    <div class="d-flex justify-content-between border-bottom">
      <h5>Create Resume</h5>
      <div>
        <a class="text-decoration-none" onclick="history.back()"><i class="bi bi-arrow-left-circle"></i> Back</a>
      </div>
    </div>

    <div>

      <form method="post" action="action/updateresume.action.php" class="row g-3 p-3">
      <input type="hidden" name="id" value="<?= $resume['id'] ?>">
        <input type="hidden" name="sludg" value="<?= $resume['sludg'] ?>">
        <div class="col-md-6">
          <label class="form-label">Resume Title</label>
          <input type="text" placeholder="Imran alam" name="resume_title" value="<?= @$resume['resume_title'] ?>"
            class="form-control" required>
        </div>
        <h5 class="mt-3 text-secondary"><i class="bi bi-person-badge"></i> Personal Information</h5>
        <div class="col-md-6">
          <label class="form-label">Full Name</label>
          <input type="text" value="<?= @$resume['fullName'] ?>" placeholder="Imran alam" name="fullname"
            class="form-control" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Email</label>
          <input type="email" value="<?= @$resume['email'] ?>" placeholder="imran@abc.com" name="email"
            class="form-control" required>
        </div>
        <div class="col-12">
          <label for="inputAddress" class="form-label"> Objective</label>
          <textarea name="objective" class="form-control"><?= @$resume['objective'] ?></textarea>
        </div>
        <div class="col-md-6">
          <label class="form-label">Mobile No</label>
          <input type="number" placeholder="9569569569" name="mobile_no" value="<?= @$resume['mobile_no'] ?>"
            class="form-control" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Date Of Birth</label>
          <input type="date" value="<?= date('d-m-Y' . $resume['dob']) ?>" name="dob" class="form-control" required>
        </div>

        <div class="col-md-6">
          <label class="form-label">Gender</label>
          <select class="form-select" name="gender">
            <option <?= ($resume['gender'] == 'Male') ? 'Selected' : '' ?>>Male</option>
            <option <?= ($resume['gender'] == 'Female') ? 'Selected' : '' ?>>Female</option>
            <option <?= ($resume['gender'] == 'Transgender') ? 'Selected' : '' ?>>Transgender</option>
          </select>
        </div>

        <div class="col-md-6">
          <label class="form-label">Religion</label>
          <select class="form-select" name="religion">
            <option <?= ($resume['religion'] == 'Muslim') ? 'Selected' : '' ?>>Muslim</option>
            <option <?= ($resume['religion'] == 'Hindu') ? 'Selected' : '' ?>>Hindu</option>
            <option <?= ($resume['religion'] == 'Sikh') ? 'Selected' : '' ?>>Sikh</option>
            <option <?= ($resume['religion'] == 'Christian') ? 'Selected' : '' ?>>Christian</option>



          </select>
        </div>

        <div class="col-md-6">
          <label class="form-label">Nationality</label>
          <select class="form-select" name="nationality">
            <option>Indian</option>
            <option>Non Indian</option>


          </select>
        </div>

        <div class="col-md-6">
          <label class="form-label">Marital Status</label>
          <select class="form-select" name="martial_status">
            <option>Married</option>
            <option>Single</option>
            <option>Divorced</option>

          </select>
        </div>

        <div class="col-md-6">
          <label class="form-label">Hobbies</label>
          <input type="text" value="<?= @$resume['hobbies'] ?>" name="hobbies"
            placeholder="Reading Books, Watching Movies" class="form-control" required>
        </div>

        <div class="col-md-6">
          <label class="form-label">Languages Known</label>
          <input type="text" value="<?= @$resume['languages'] ?>" name="languages" placeholder="Hindi,English"
            class="form-control" required>
        </div>

        <div class="col-12">
          <label for="inputAddress" class="form-label"> Address</label>
          <input type="text" name="address" value="<?= @$resume['address'] ?>" class="form-control" id="inputAddress"
            placeholder="1234 Main St" required>
        </div>
        <hr>
        <div class="d-flex justify-content-between">
          <h5 class=" text-secondary"><i class="bi bi-briefcase"></i> Experience</h5>
          <div>
            <a class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#addexp"><i
                class="bi bi-file-earmark-plus"></i> Add New</a>
          </div>
        </div>

        <!-- modal -->
        <!-- Modal -->

        <div class="d-flex flex-wrap">

          <?php
          // echo $exps;
          // print_r($exps);
          if ($exps) {
            foreach ($exps as $exp) {

              ?>

              <div class="col-12 col-md-6 p-2">
                <div class="p-2 border rounded">
                  <div class="d-flex justify-content-between">
                    <h6>
                      <?= $exp['position'] ?>
                    </h6>
                    <a href="action/deleteexp.action.php?id=<?=$exp['id']?>&resume_id=<?=$resume['id']?>&sludg=<?=$resume['sludg']?>"><i class="bi bi-x-lg"></i></a>

                  </div>

                  <p class="small text-secondary m-0" style="">
                    <i class="bi bi-buildings"></i>
                    <?= $exp['company'] ?> (
                    <?= $exp['started'] . '-' . $exp['end'] ?>)
                  </p>
                  <p class="small text-secondary m-0" style="">
                    <?= $exp['job_desc'] ?>
                  </p>

                </div>
              </div>




              <?php
            }


          } else {

            ?>

            <div class="col-12 col-md-6 p-2">
              <div class="p-2 border rounded">
                <div class="d-flex justify-content-between">
                  <h6>I am Fresher</h6>
                  <!-- <a href=""><i class="bi bi-x-lg"></i></a> -->
                </div>


                <p class="small text-secondary m-0" style="">
                  if you have experiences you can add it
                </p>

              </div>
            </div>


            <?php

          }

          ?>

        </div>
        <hr>
        <div class="d-flex justify-content-between">
          <h5 class=" text-secondary"><i class="bi bi-journal-bookmark"></i> Education</h5>
          <div>
            <a class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#addedu"><i
                class="bi bi-file-earmark-plus"></i> Add New</a>
          </div>
        </div>

        <div class="d-flex flex-wrap">


        <?php
          // echo $exps;
          // print_r($exps);
          if ($edus) {
            foreach ($edus as $exp) {

              ?>

              <div class="col-12 col-md-6 p-2">
                <div class="p-2 border rounded">
                  <div class="d-flex justify-content-between">
                    <h6>
                      <?= $exp['course'] ?>
                    </h6>
                    <a href="action/deleteedu.action.php?id=<?=$exp['id']?>&resume_id=<?=$resume['id']?>&sludg=<?=$resume['sludg']?>"><i class="bi bi-x-lg"></i></a>
                  </div>

                  <p class="small text-secondary m-0" style="">
                  <i class="bi bi-book"></i>
                    <?= $exp['institute'] ?> (
                    
                  </p>
                  <p class="small text-secondary m-0" style="">
                  <?= $exp['started'] . '-' . $exp['ended'] ?>)
                  </p>

                </div>
              </div>




              <?php
            }


          } else {

            ?>

            <div class="col-12 col-md-6 p-2">
              <div class="p-2 border rounded">
                <div class="d-flex justify-content-between">
                  <h6>I have no Education</h6>
                  <!-- <a href=""><i class="bi bi-x-lg"></i></a> -->
                </div>


                <p class="small text-secondary m-0" style="">
                  if you have education you can add it
                </p>

              </div>
            </div>


            <?php

          }

          ?>



         


        </div>

        <hr>
        <div class="d-flex justify-content-between">
          <h5 class=" text-secondary"><i class="bi bi-boxes"></i> Skills</h5>
          <div>
            <a class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#addskill"><i
                class="bi bi-file-earmark-plus"></i> Add New</a>
          </div>
        </div>

        <div class="d-flex flex-wrap">

        <?php 
        if($skills){
 
          foreach ($skills as $skill) {

            ?>
<div class="col-12 p-2">
            <div class="p-2 border rounded">
              <div class="d-flex justify-content-between align-items-center">
                <h6><i class="bi bi-caret-right"></i> <?= $skill['skill']?></h6>
                <a href="action/deleteskill.action.php?id=<?=$skill['id']?>&resume_id=<?=$resume['id']?>&sludg=<?=$resume['sludg']?>"><i class="bi bi-x-lg"></i></a>
                  </div>
              </div>
            </div>
          </div>
            <?php
          }
        }else{

          ?>
<div class="col-12 p-2">
            <div class="p-2 border rounded">
              <div class="d-flex justify-content-between align-items-center">
                <h6><i class="bi bi-caret-right"></i> I have no skills</h6>
                <!-- <a href=""><i class="bi bi-x-lg"></i></a> -->
              </div>
            </div>
          </div>
          <?php

        }
        
        ?>




        </div>



        <div class="col-12 text-end">
          <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i> Update
            Resume</button>
        </div>
      </form>
    </div>





  </div>

</div>
<!-- modal exp-->
<div class="modal fade" id="addexp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Experience</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- form -->
        <form method="post" action="action/addexperience.action.php" class="row g-3">
        <input type="hidden" name="resume_id" value="<?= $resume['id'] ?>">
        <input type="hidden" name="sludg" value="<?= $resume['sludg'] ?>">

          <div class="col-12">
            <label for="inputEmail4" class="form-label">Position/Job Role</label>
            <input type="text" name="position" class="form-control" placeholder="Web Developer Consultant (2+ Years)"
              id="inputEmail4" required>
          </div>
          <div class="col-12">
            <label for="inputPassword4" class="form-label">Company</label>
            <input type="text" name="company" placeholder="Dominos,New Delhi" class="form-control" id="inputPassword4"
              required>
          </div>
          <div class="col-md-6">
            <label for="inputPassword4" class="form-label">Joined</label>
            <input type="text" name="started" placeholder="january 2024" class="form-control" id="inputPassword4"
              required>
          </div>
          <div class="col-md-6">
            <label for="inputPassword4" class="form-label">Resigned</label>
            <input type="text" name="ended" placeholder="Currently Pursuing" class="form-control" id="inputPassword4"
              required>
          </div>
          <div class="col-12">
            <label for="inputPassword4" class="form-label">Job Description</label>
            <textarea name="job_desc" placeholder="Handling customers and fulfilling their needs"
              class="form-control"></textarea>
          </div>



          <div class="col-12 text-end">
            <button type="submit" class="btn btn-primary">Add Experience</button>
          </div>
        </form>
        <!-- foem end  -->
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div> -->
    </div>
  </div>
</div>
<!-- modal exp end -->





<!-- modal education  -->

<!-- modal exp-->
<div class="modal fade" id="addedu" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Education</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- form -->
        <form method="post" action="action/addeducation.action.php" class="row g-3">
        <input type="hidden" name="resume_id" value="<?= $resume['id'] ?>">
        <input type="hidden" name="sludg" value="<?= $resume['sludg'] ?>">
          <div class="col-12">
            <label for="inputEmail4" class="form-label">Course / Degree</label>
            <input type="text" name="course" class="form-control" placeholder="12th Class (Arts Stream)"
              id="inputEmail4" required>
          </div>
          <div class="col-12">
            <label for="inputPassword4" class="form-label">Institute</label>
            <input type="text" name="institute" placeholder="Central Board Of Secondary Education, New Delhi"
              class="form-control" id="inputPassword4" required>
          </div>
          <div class="col-md-6">
            <label for="inputPassword4" class="form-label">Started</label>
            <input type="text" name="started" placeholder="january 2024" class="form-control" id="inputPassword4"
              required>
          </div>
          <div class="col-md-6">
            <label for="inputPassword4" class="form-label">ended</label>
            <input type="text" name="ended" placeholder="Completed in 2025" class="form-control" id="inputPassword4"
              required>
          </div>



          <div class="col-12 text-end">
            <button type="submit" class="btn btn-primary">Add Education</button>
          </div>
        </form>
        <!-- foem end  -->
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div> -->
    </div>
  </div>
</div>
<!-- modal -->

<!-- modal education end  -->



<!-- modal skill  -->


<div class="modal fade" id="addskill" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Skills</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- form -->
        <form method="post" action="action/addskill.action.php" class="row g-3">
        <input type="hidden" name="resume_id" value="<?= $resume['id'] ?>">
        <input type="hidden" name="sludg" value="<?= $resume['sludg'] ?>">
          <div class="col-12">
            <label for="inputEmail4" class="form-label">Skill</label>
            <input type="text" name="skill" class="form-control" placeholder=" Basic Knowledge in Computer & Internet"
              id="inputEmail4" required>
          </div>

          <div class="col-12 text-end">
            <button type="submit" class="btn btn-primary">Add Skill</button>
          </div>
        </form>
        <!-- foem end  -->
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div> -->
    </div>
  </div>
</div>
<!-- modal -->

<!-- modal skill end  -->


<?php 
    require './assets/includes/footer.php';
?>