<?php require('../assets/php/checkauth.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <?php require('../assets/php/head.php'); ?>
    <title>Pro-Book | Profile</title>
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/profile/profile.css">
</head>
<body>
    <?php 
        require("get_users.php");
        require('../assets/php/header.php');
    ?>

    <div class="profile">
        <div class="profile__header blue-dark-background">
            <div class="profile__picture-name">
                <div class="profile__picture ">
                    <img src="<?php echo $users[0]->image?>"/>
                </div>
                <div class="profile__name">
                    <h1 id="profile__name"><?php echo $users[0]->name?></h1>
                </div>
            </div>
            <div class="profile__edit">
                <a href="/profile/editprofile.php">
                    <img src="../assets/img/pencil.png" href="/profile/editprofile.php"/>
                </a>                
            </div>
        </div>
        <div class="profile__info">
            <h1 class="orange">My Profile</h1>
            <div class="profile__username profile__row">
                <div class="profile__left">
                    <div class="profile__icon">
                        <img src="../assets/img/profile.png"/>
                    </div>
                    <p>Username</p>
                </div>
                <div class="profile__right">
                    <p id="profile__username">@<?php echo $users[0]->username?></p>
                </div>
            </div>
            <div class="profile__email profile__row">
                <div class="profile__left">
                    <div class="profile__icon">
                        <img src="../assets/img/email.png"/>
                    </div>
                    <p> Email</p>
                </div>
                <div class="profile__right">
                    <p id="profile__email"><?php echo $users[0]->email?></p>
                </div>
            </div>
            <div class="profile__card profile__row">
                <div class="profile__left">
                    <div class="profile__icon">
                        <img src="../assets/img/card.png"/>
                    </div>
                    <p>Card Number</p>
                </div>
                <div class="profile__right">
                    <p id="profile__card"></p>
                </div>
            </div>
            <div class="profile__address profile__row">
                <div class="profile__left">
                    <div class="profile__icon">
                        <img src="../assets/img/home.png"/>
                    </div>
                    <p>Address</p>
                </div>
                <div class="profile__right">
                    <p id="profile__address"><?php echo $users[0]->address?></p>
                </div>
            </div>
            <div class="profile_phone-number profile__row">
                <div class="profile__left">
                    <div class="profile__icon">
                        <img src="../assets/img/phone.png"/>
                    </div>
                    <p>Phone Number</p>
                </div>
                <div class="profile__right">
                    <p id="profile__phone-number"><?php echo $users[0]->phone?></p>
                </div>

            </div>
        </div>
    </div>
    <script src="../assets/js/validation.js"></script>
    <script src="../profile/index.js"></script>
    <script>
        getUserCardNumber('<?php echo $users[0]->username ?>')
    </script>
</body>
</html>
