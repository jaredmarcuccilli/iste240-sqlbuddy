<h3>Practice</h3>
<?php
    function loadLesson($lesson) {
        echo '<script src="assets/js/sqlparser/lessons/lesson'.$lesson.'.js"></script>';
    }
?>


<script src="assets/js/sqlparser/sqlparser/Table.js"></script>
<script src="assets/js/sqlparser/sqlparser/util.js"></script>

<script src="assets/js/sqlparser/sqlparser/Program.js"></script>

<script src="assets/js/sqlparser/sqlparser/Create.js"></script>
<script src="assets/js/sqlparser/sqlparser/Drop.js"></script>
<script src="assets/js/sqlparser/sqlparser/Insert.js"></script>
<script src="assets/js/sqlparser/sqlparser/Select.js"></script>

<script src="assets/js/sqlparser/sqlparser/parser.js"></script>

<script>
    let program = new Program();

    function send(){
        let text = document.getElementById("InputField").value;
        let tokenStream = new Parser(text);
        program.run(tokenStream);
        program.execute();
    }

</script>


<div id="LessonInterpreter">
<div id="OutputView"></div>
<br />

<table class='sqlTable'>
    <tr>
        <th style="text-align: center;">
            <button onclick="return send()">Run</button>
        </th>
    </tr>
    <tr>
        <td style="text-align: center;">
            <textarea id="InputField" rows="10"></textarea>
        </td>
    </tr>
</table>

<div id="Tables"></div>
</div>