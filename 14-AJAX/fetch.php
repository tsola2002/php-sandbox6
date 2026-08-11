<?php 

require "database.php";

$query = "SELECT * FROM tbl_student";
$result = mysqli_query($connection, $query);

echo "<table class='table table-bordered table-stripped'>";
echo "<thead class='table-dark'>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Gender</th>
            <th width='160'>Actions</th>
        </tr>
      </thead>
      <tbody>";

        while($row = mysqli_fetch_assoc($result)){
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>
                    <button class='btn btn-sm btn-primary' onclick=\"editStudent(
                    '" . $row['id'] . "',
                    '" . $row['name'] . "',
                    '" . $row['email'] . "',
                    )\">
                    Edit</button>

                    <button class='btn btn-sm btn-danger
                    ' onclick=\"deleteStudent('" . $row['id'] . "')\">
                    Delete</button>
                </td>";
            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";

?>