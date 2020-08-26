<?php
	session_start();
    	$path = './';
    	$page = 'Lessons';
    	require 'assets/inc/header.php';
    	require $path.'../../../dbConnect.inc';
?>

<div id="right">
	<div class="content">
		<h2><span class="blue bold">SQL</span><span class="light">Buddy</span></h2>
		<h3>Lessons</h3>
		Welcome to your Lessons!
		<table class="lessonPlan" style="width: 100%;">
                <tr>
                    <th>Lesson</th>
                    <th>Subject</th>
                </tr>
                
                <tr>
                    <td><a href="lesson1.php">Lesson 1</a></td>
                    <td><span class="blue bold">SELECT</span> Statement</td>
                </tr>
                            
                <tr>
                    <td><a href="lesson2.php">Lesson 2</a></td>
                    <td><span class="blue bold">WHERE</span> Statement</td>
                </tr>
                
				<tr>
                    <td><a href="lesson3.php">Lesson 3</a></td>
                    <td><span class="blue bold">AND, OR, NOT</span> Conditions</td>
                </tr>
				
				<tr>
                    <td><a href="lesson4.php">Lesson 4</a></td>
                    <td><span class="blue bold">ORDER BY</span> Statement</td>
                </tr>
				
				<tr>
                    <td><a href="lesson5.php">Lesson 5</a></td>
                    <td><span class="blue bold">INSERT</span> Statement</td>
                </tr>
				
				<tr>
                    <td><a href="lesson6.php">Lesson 6</a></td>
                    <td><span class="blue bold">UPDATE</span> Statement</td>
                </tr>
				
				<tr>
                    <td><a href="lesson7.php">Lesson 7</a></td>
                    <td><span class="blue bold">DELETE</span> Statement</td>
                </tr>
                <tr>
                    <td><a href="lesson8.php">Lesson 8</a></td>
                    <td><span class="blue bold">DROP TABLE</span> Statement</td>
                </tr>
                
            </table>
		<?php
			require 'assets/inc/timestamp.php';
		?>		
	</div>
</div>

<?php
    	require 'assets/inc/footer.php';
?>