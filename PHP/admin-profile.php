<style>
    #container #profile {
        width: 80%;
        height: 90vh;
        top: 10%;
        color: #B91EB3;
        position: relative;
    }

    #container #profile h4 {
        margin: 0 0 2vh 1vh;
    }

    #container #profile #profile-container {
        width: 100%;
        height: 92%;
        display: flex;
        align-items: center;
        justify-content: space-evenly;
        flex-wrap: wrap;
        background-color: #e333dd20;
        border-radius: 3vh;
        border: 1px solid #f9afdd;
        padding: 2vh 0 1vh 0;
    }

    #container #profile #profile-container #left {
        width: 45%;
        height: 90%;
        display: flex;
        align-items: start;
        justify-content: space-between;
        flex-direction: column;
        flex-wrap: wrap;
    }

    #container #profile #profile-container #left input {
        width: 100%;
        border: 1px solid #f95cba;
        padding: 1vh;
        border-radius: 1vh;
        color: #B91EB3;
    }

    #container #profile #profile-container #left label {
        font-size: 0.9rem;
    }

    #container #profile #profile-container #right {
        width: 45%;
        height: 90%;
        display: flex;
        align-items: start;
        justify-content: space-between;
        flex-direction: column;
        flex-wrap: wrap;
    }

    #container #profile #profile-container #right input {
        width: 100%;
        border: 1px solid #f95cba;
        padding: 1vh;
        border-radius: 1vh;
        color: #B91EB3;
    }

    #container #profile #profile-container #right label {
        font-size: 0.9rem;
    }

    #container #profile #profile-container #btn-edit {
        width: 10vw;
        background-color: #f95cba;
        color: white;
        padding: 1vh;
        border: none;
        border-radius: 1vh;
        cursor: pointer;
    }

    #container #profile #profile-container #btn-edit:hover{
        background-color: #d23a96;
    }
</style>
<div id="profile">
    <h4>Admin Profile</h4>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (isset($_POST['edit'])){
            $fname = $_POST['firstname'];
            $mname = $_POST['middlename'];
            $lname = $_POST['lastname'];
            $age = $_POST['age'];
            $birthday = $_POST['birthday'];
            $gender = $_POST['gender'];
            $contact = $_POST['contact'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $province = $_POST['province'];
            $city = $_POST['city'];
            $barangay = $_POST['barangay'];
            $street = $_POST['street'];
        
            $query = "UPDATE tbl_admin
                      SET firstname = ?, 
                          middlename = ?, 
                          lastname = ?, 
                          age = ?, 
                          birthday = ?, 
                          gender = ?, 
                          contact_no = ?, 
                          username = ?, 
                          email = ?, 
                          password = ?, 
                          province = ?, 
                          city = ?, 
                          barangay = ?, 
                          street = ? 
                      WHERE admin_id = ?";
        
            $stmt = $connection->prepare($query);
        
            // Bind parameters to the statement
            $stmt->bind_param(
                'sssissssssssssi',
                $fname,
                $mname,
                $lname,
                $age,
                $birthday,
                $gender,
                $contact,
                $username,
                $email,
                $password,
                $province,
                $city,
                $barangay,
                $street,
                $admin_id
            );
            // Execute the statement
            if ($stmt->execute()) {
                echo "<script>
                        alert('Profile updated successfully!');
                        window.location.href = 'admin-index.php?page=admin-profile';
                      </script>";
            }
        }
    }

    $query = "SELECT * FROM tbl_admin WHERE admin_id = $admin_id";
    $result = mysqli_query($connection,$query);

    $row = mysqli_fetch_assoc($result);
    ?>

    <form id="profile-container" action="" method="POST" onsubmit="return confirm('Are you sure you want to update your information?');">
        <div id="left">
            <label>First Name</label>
            <input type="text" name="firstname" value="<?php echo $row['firstname'] ?>">
            <label>Middle Name</label>
            <input type="text" name="middlename" value="<?php echo $row['middlename'] ?>">
            <label>Last Name</label>
            <input type="text" name="lastname" value="<?php echo $row['lastname'] ?>">
            <label>Age</label>
            <input type="number" name="age" value="<?php echo $row['age'] ?>">
            <label>Birthday</label>
            <input type="date" name="birthday" value="<?php echo $row['birthday'] ?>">
            <label>Gender</label>
            <input type="text" name="gender" value="<?php echo $row['gender'] ?>">
            <label>Contact No.</label>
            <input type="number" name="contact" value="<?php echo $row['contact_no'] ?>">
        </div>

        <div id="right">
            <label>Username</label>
            <input type="text" name="username" value="<?php echo $row['username'] ?>">
            <label>Email</label>
            <input type="email" name="email" value="<?php echo $row['email'] ?>">
            <label>Password</label>
            <input type="password" name="password" value="<?php echo $row['password'] ?>" placeholder="Enter Password">
            <label>Province</label>
            <input type="text" name="province" value="<?php echo $row['province'] ?>">
            <label>City/Municipality</label>
            <input type="text" name="city" value="<?php echo $row['city'] ?>">
            <label>Barangay</label>
            <input type="text" name="barangay" value="<?php echo $row['barangay'] ?>">
            <label>Street</label>
            <input type="text" name="street" value="<?php echo $row['street'] ?>">
        </div>

        <button id="btn-edit" type="submit" name="edit">
            EDIT
        </button>
    </form>
</div>