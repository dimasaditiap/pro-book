<?php require('../assets/php/checkauth.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <?php require('../assets/php/head.php'); ?>
    <title>Pro-Book | Profile</title>
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/profile/edit_profile.css">
</head>
<body>
    <?php
        require("get_users.php");
        require('../assets/php/header.php');
    ?>

    <div class="edit-profile">
        <div class="edit-profile__title">
            <h1 class="orange">Edit Profile</h1>
        </div>
        <form 
            class="edit-profile__form" id="edit-profile__form" 
            method="POST" action="post_users.php" enctype="multipart/form-data" 
            onsubmit="return validateRegisterForm('<?php echo $users[0]->username ?>')"
        >
            <div class="edit-profile__edit-image">
                <div class="edit-profile__image">
                    <img src="<?php echo $users[0]->image?>"/>
                </div>
                <div class="edit-profile__browse">
                    <p class="edit-profile__desc">Update profile picture</p>
                    <div class="edit-profile__browser-image">
                        <div class="browse-name"></div>
                        <label for="fileToUpload" class="file-label browse-btn">Browse ...</label>
                        <input type="file" name="fileToUpload" id="fileToUpload">
                    </div>
                </div>
            </div>
            <div class="edit-profile__edit-info">
                <div class="edit-profile__edit-name edit-profile-row">
                    <label for="username">Name</label>
                    <input id="edit-profile__name" type="text" name="name" value="<?php echo $users[0]->name?>">
                </div>
                <div class="edit-profile__edit-card edit-profile-row">
                    <label for="username">Card Number</label>
                    <input id="profile__card" type="number" name="card_number" onkeyup="validateCardNumberAjax('<?php echo $users[0]->username ?>')">
                </div>
                <div class="edit-profile__edit-address edit-profile-row">
                    <label for="username">Address</label>
                    <textarea id="edit-profile__address" name="address" rows="5"><?php echo $users[0]->address?></textarea>
                </div>
                <div class="edit-profile__edit-phone-number edit-profile-row">
                    <label for="username">Phone Number</label>
                    <input id="edit-profile__phone" type="text" name="phone" value="<?php echo $users[0]->phone?>">
                </div>
            </div>
            <div class="edit-profile__button">
                <button class="edit-profile__back orange button_up">Back</button>
                <input class="edit-profile__save blue-medium-background button_up" type="submit" value="Save"/>
            </div>
        </form>
    </div>
    <script src="../assets/js/validation.js"></script>
    <script src="../profile/index.js"></script>
    <script>
        function getUserCardNumber(username) {
            fetch(`http://localhost:3000/customers/${username}`)
                .then(res => res.json())
                .then(res => {
                    console.log(res)
                    document.getElementById('profile__card').value = res.card_number
                })
                .catch(err => console.log(err))
        }

        getUserCardNumber('<?php echo $users[0]->username ?>')
    </script>
</body>
</html>
