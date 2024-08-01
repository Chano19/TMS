<style>
/* Importing fonts from Google */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

/* Reseting */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    background: linear-gradient(135deg, #00c3ff, #eeef1c);
    background: linear-gradient(135deg, #fc00ff, #00dbde);
    background-image: linear-gradient(135deg, #ff00ba 0%, #fae713 100%);
    background-image: linear-gradient(150deg, #5a00ff 0%, #ff1ff7 100%, #ff1ff7 100%);
    min-height: 93vh;
}

.wrapper {
    max-width: 500px;
    margin: 50px auto;
}

.wrapper .card {
    max-width: 400px;
    min-height: 400px;
    margin: 30px;
    background: rgba(255, 255, 255, 0.1);
    overflow: hidden;
    backdrop-filter: ;
    border: 1px solid rgba(255, 255, 255, 0.5);
    border-radius: 15px;
    cursor: pointer;
    padding: 0.8rem;
}

.wrapper .card a {
    text-decoration: none;
    color: #eee;
}

.wrapper .card a:hover {
    color: #fff;
}

.wrapper .card .input-field {
    border: 1px solid #ddd;
    border-radius: 5px;
    color: #eee;
    padding: 0.3rem;
}

.wrapper .card .input-field input {
    background-color: inherit;
}

.wrapper .card .input-field input.form-control,
.wrapper .card .input-field input.form-control:focus {
    border: none;
    outline: none;
    box-shadow: none;
    color: black;
}

.wrapper .card .input-field button.btn {
    color: #eee;
    padding: 0rem;
    padding-right: 0.5rem;
}

.wrapper .card .input-field button.btn:hover {
    color: #fff;
}

.wrapper .card .input-field button.btn:focus {
    border: none;
    outline: none;
    box-shadow: none;
}

.wrapper .card .input-field input::placeholder {
    color: black;
}

.wrapper .card .option {
    display: block;
    position: relative;
    padding-left: 25px;
    cursor: pointer;
    user-select: none
}

.wrapper .card .option span.text-light-white:hover {
    color: #fff;

}

.wrapper .card .option input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
    height: 0;
    width: 0
}

.checkmark {
    position: absolute;
    top: 3px;
    left: 0;
    height: 18px;
    width: 18px;
    background-color: #fff;
    border-radius: 2px
}

.wrapper .card .option:hover input~.checkmark {
    background-color: #f1f1f1
}

.wrapper .card .option input:checked~.checkmark {
    border: none;
    background-color: #333;
    transition: 300ms ease-in-out all
}

.checkmark:after {
    content: "\2713";
    position: absolute;
    display: none;
    color: #fff;
    font-size: 1rem
}

.wrapper .card .option input:checked~.checkmark:after {
    display: block
}

.wrapper .card .option .checkmark:after {
    left: 3px;
    top: -3px;
    width: 5px;
    height: 10px
}

.wrapper .card .btn.btn-primary {
    border-radius: 20px;
    width: 100px;
    background-color: blue;
    color: white;
    border: none;
}

.wrapper .card .btn.btn-primary:hover {
    color: #fff;
    background: #333;
}

.wrapper .card .btn.btn-primary:focus {
    border: none;
    box-shadow: none;
}

.wrapper .card .text-light-white {
    color: #ddd;
}

.wrapper .card .line span.connect {
    position: absolute;
    top: -12px;
    left: 33%;
    color: #000;
    padding: 0 0.3rem;
    z-index: 100;
    border-radius: 2px;
    background-color: #fff;
}

.wrapper .card .connections a img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;

}


@media(max-width: 370px) {
    .wrapper .card .line:after {
        left: 27%;
    }
}

@media(max-width: 350px) {
    .wrapper {
        margin: 10px auto;
    }

    .wrapper .card {
        margin: 10px;
    }
}
</style>

<html>
<head>
    <title>CRC Tracking App</title>
    <link rel="stylesheet" href="bootstrap-5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="bootstrap-5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v5.7.2/css/all.css"></script>
    <style>
        body {
            background-color: white;
            background-image: url("images/crcbg.jpg");
            background-repeat: no-repeat;
            background-size: auto-sized;
            background-attachment: fixed;
        }
    </style>
</head>
<body>
<?php
    $conn=mysqli_connect('localhost','u320585682_TMS','Crctracking3','u320585682_TMS');
    include_once'navbar.php';
?>
<br><br>

    <div class="wrapper">
        <div class="card shadow">
            <form method="POST" action="login.php" class="d-flex flex-column"><br>
                <div class="h3 text-center fw-bold text-dark">Login</div><br>
                <div class="d-flex align-items-center input-field my-3 mb-4">
                    <span class="far fa-user p-2"></span>
                    <input type="text" placeholder="Email" required class="form-control fw-light" id="email" name="email">
                </div><br>
                <div class="d-flex align-items-center input-field mb-4">
                    <span class="fas fa-lock p-2"></span>
                    <input type="password" placeholder="Password" required class="form-control fw-light" id="password" name="password">
                    <button class="btn" onclick="showPassword()">
                        <span class="fas fa-eye-slash"></span>
                    </button>
                </div>
                <div class="my-3">
                    <input type="submit" value="Login" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>

</body>
</html>

<script>
function showPassword() {
            var password = document.getElementById('password');
            if (password.type === 'password') {
                password.type = "text";
            }
            else {
                password.type = "password";
            }
        }
</script>