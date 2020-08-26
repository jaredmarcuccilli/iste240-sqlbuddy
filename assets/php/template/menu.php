<?php
    function addActive($linkname){
        $shortfilename = basename($_SERVER['PHP_SELF']);

        if( $shortfilename == $linkname )
            return "class=\"current\""; 
        return "";
    }
?>

<!-- Vertical Nav Bar -->
<div id="vertnav">
    <div id="MenuHeader"><span class='blue'>SQL</span><span class='light'>Buddy</span></div>

    <!-- Home -->
    <a href="index.php" 
        <?php echo addActive("index.php"); ?>
    >
        Home
    </a>

    <!-- Lessons -->
    <a href="lessons.php"
        <?php echo addActive("lessons.php"); ?>
        <?php echo addActive("lesson.php"); ?>
    >
        Lessons
    </a>

    <!-- Quizes -->
    <a href="quizes.php"
        <?php echo addActive("quizes.php"); ?>
    >
        Quizzes
    </a>

    <!-- GradeBook -->
    <a href="gradebook.php"
        <?php echo addActive("gradebook.php"); ?>
    >
        Gradebook
    </a>

    <div id="copy">Hello, <?php echo $_SESSION['givenName']?>!<br/>
    <a href="assets/php/login/logout.php">Logout</a></div>
</div>


<!-- Horizontal Nav Bar -->
<div id="hornav">
    <a href="index.html"
        <?php echo addActive("index.php"); ?>
    >
    Home
    </a>

    <!-- Lessons -->
    <a href="lessons.php"
        <?php echo addActive("lessons.php"); ?>
        <?php echo addActive("lesson.php"); ?>
    >
        Lessons
    </a>

    <!-- Quizes -->
    <a href="quizes.php"
        <?php echo addActive("quizes.php"); ?>
    >
        Quizzes
    </a>

    <!-- GradeBook -->
    <a href="gradebook.php"
        <?php echo addActive("gradebook.php"); ?>
    >
        Gradebook
    </a>
</div>