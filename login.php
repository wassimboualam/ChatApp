<?php
    include_once "header.php";
    if (isset($_SESSION["unique_id"])) {
        header("location: ./users.php");
    }

?>
<body>
    <main class="wrapper">
        <section class="form signup">
            <header>Realtime Chat App</header>
            <form action="#">
                <div class="error-txt">This is an error message</div>
                <div class="field input">
                    <label>Email Address</label>
                    <input type="text" placeholder="enter your email" name="email">
                </div>
                <div class="field input">
                    <label>Password</label>
                    <input type="password" placeholder="enter your password" name="password">
                    <i class="fa fa-eye"></i>
                </div>
                <div class="field">
                    <input type="submit" value="Continue to Chat">
                </div>
            </form>
            <div class="link">Not yet signed up? <a href="index.php">SignUp now</a></div>
        </section>
    </main>
    <script src="javascript/pass-show-hide.js"></script>
    <script src="javascript/login.js"></script>
</body>
</html>