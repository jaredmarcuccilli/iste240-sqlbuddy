<?php
	session_start();
    	$path = './';
    	$page = 'References';
    	require 'assets/inc/header.php';
    	require $path.'../../../dbConnect.inc';
?>

	<div id="right">
		<h2><span class="blue" class="bold">SQL</span><span class="light">Buddy</span></h2>
		<div class="content">
			<table>
                <tr>
                    <td>
                        <a href="https://www.lynda.com/SQL-tutorials/SQL-Essential-Training-2014/139988-2.html">https://www.lynda.com/SQL-tutorials/SQL-Essential-Training-2014/139988-2.html</a>
                    </td>
                    <td>
                        Used for slideshow on index.
                    </td>
                    <td>
                        <img style='height:100px' src="assets/slideshow/main0.png">
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="https://docs.microsoft.com/en-us/azure/sql-database/sql-database-security-overview">https://docs.microsoft.com/en-us/azure/sql-database/sql-database-security-overview</a>
                    </td>
                    <td>
                        Used for slideshow on index.
                    </td>
                    <td>
                        <img style='height:100px' src="assets/slideshow/main1.png">
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="https://365datascience.com/sql-interview-questions/">https://365datascience.com/sql-interview-questions/</a>
                    </td>
                    <td>
                        Used for slideshow on index.
                    </td>
                    <td>
                        <img style='height:100px' src="assets/slideshow/main2.png">
                    </td>
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