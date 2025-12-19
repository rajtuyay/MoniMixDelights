<?php
    if(!isset($_SESSION['user'])){
        header('location:login.php');
    } else {
        $user_id = $_SESSION['user'];
        $query = "SELECT user_id, firstname, lastname, age, contact_no, gender, birthday
                  FROM tbl_user
                  WHERE user_id = '$user_id'";
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($result);
        $user_id = $row['user_id'];
        $fname = $row['firstname'];
        $lname = $row['lastname'];
        $age = $row['age'];
        $contact = $row['contact_no'];
        $gender = $row['gender'];
        $bday = $row['birthday'];
    }
?>

<div class="gradient-bg">
    <div id="title">
        <div class="img-holder"><img src="../IMG/icon-big-personal-info.png"></div>
        <div id="text-holder">
            <p id="h1">Personal Information</p>
            <p id="p">Personal Information is data that identifies a person, like name, address, phone number, or email.</p>
        </div>
    </div>

    <form id="myForm" method="post">
        <div class="name">
            <div class="col-name">
                <label class="fname">First Name</label>
                <input type="text" class="fname" name="fname" value="<?php echo $fname?>" placeholder="Enter First Name" disabled>
            </div>
            <div class="col-name">
                <label class="lname">Last Name</label>
                <input type="text" class="lname" name="lname" value="<?php echo $lname?>" placeholder="Enter Last Name" disabled>
            </div>
        </div>
        <label for="id">ID</label>
        <input type="text" class="id" name="user_id" style="cursor: default;" placeholder="Enter ID" value="<?php echo $user_id?>" readonly>
        <label for="age">Age</label>
        <input type="number" class="age" name="age" value="<?php echo $age?>"  placeholder="Enter Age" disabled>
        <label for="contact">Contact No.</label>
        <input type="text" class="contact" name="contact" value="<?php echo $contact?>"  placeholder="Enter Contact Number" disabled>
        <label for="gender">Gender</label>
        <select name="gender" class="gender" disabled>
            <option value="" disabled selected>Choose your gender</option>
            <option <?php echo ($gender == 'Male' ? 'selected' : ''); ?>>Male</option>
            <option <?php echo ($gender == 'Female' ? 'selected' : ''); ?>>Female</option>
        </select>
        <label for="birthday">Birthday</label>
        <input type="date" class="bday" name="bday" value="<?php echo date('Y-m-d', strtotime($bday)); ?>" disabled>
        <div class="buttons">
            <button type="button" id="editButton">Edit</button>
            <button type="button" id="cancelButton" style="display:none;">Cancel</button>
            <script src="../JS/edit-profile.js"></script>
        </div>
    </form>
</div>